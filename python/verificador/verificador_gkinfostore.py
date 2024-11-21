import requests
from bs4 import BeautifulSoup
from .verificador_base import VerificadorProdutos
from scraper.settings import DB_NAME
from scraper.database import salvar_log_no_banco

class VerificadorProdutoGKInfoStore(VerificadorProdutos):
    def verificar_disponibilidade_produto(self, url):
        headers = {
            'User-Agent': 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.3'
        }

        response = requests.get(url, headers=headers)
        soup = BeautifulSoup(response.content, 'html.parser')

        # Verifica se a página do produto foi encontrada
        pagina_nao_encontrada = soup.select_one('div.box-destaque h1.titulo')
        if pagina_nao_encontrada and "Página não encontrada" in pagina_nao_encontrada.get_text(strip=True):
            print(f"Página não encontrada para URL: {url}")
            salvar_log_no_banco(url, 0, "Página não encontrada")
            return False

        # Verifica se o produto está indisponível pela meta tag 'twitter:data2'
        meta_indisponivel = soup.find('meta', {'name': 'twitter:data2'})
        if meta_indisponivel and meta_indisponivel.get('content') == "Indisponível":
            print(f"Produto indisponível: {url}")
            salvar_log_no_banco(url, 0, "Produto indisponível")
            return False

        # Se a meta tag de indisponibilidade não for encontrada ou não marcar como "Indisponível",
        # assume que o produto está disponível
        return True

    def coletar_dados_produto_pagina(self, url):
        # Verifica se o produto está disponível antes de tentar coletar os dados
        if not self.verificar_disponibilidade_produto(url):
            print(f"Produto indisponível na URL: {url}")
            salvar_log_no_banco(url, 0, "Produto indisponível")
            return None

        headers = {
            'User-Agent': 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.3'
        }

        response = requests.get(url, headers=headers)
        soup = BeautifulSoup(response.content, 'html.parser')

        try:
            # Coleta o nome do produto a partir do <h1> com a classe 'nome-produto titulo cor-secundaria'
            nome_tag = soup.select_one('h1.nome-produto.titulo.cor-secundaria')
            nome = nome_tag.get_text(strip=True) if nome_tag else "Nome não encontrado"

            # Coleta o preço do produto, tratando separadores de milhar e decimais brasileiros
            preco_vista_tag = soup.find('span', class_='desconto-a-vista')
            preco_vista_text = preco_vista_tag.find('strong', class_='cor-principal titulo').get_text(strip=True) if preco_vista_tag else "0"
            preco = float(preco_vista_text.replace('R$', '').replace('.', '').replace(',', '.').strip())

            return {'nome': nome, 'preco': preco}
        except Exception as e:
            print(f"Erro ao coletar dados da página {url}: {e}")
            salvar_log_no_banco(url, 0, f"Erro ao coletar dados: {e}")
            return None

    def filtrar_urls(self, produtos):
        # Filtra URLs que começam com "https://www.gkinfostore.com.br"
        return [produto for produto in produtos if produto[3].startswith('https://www.gkinfostore.com.br')]
