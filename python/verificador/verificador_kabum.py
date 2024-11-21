import requests
from bs4 import BeautifulSoup
from .verificador_base import VerificadorProdutos
from scraper.settings import DB_NAME
from scraper.database import salvar_log_no_banco  # Importa a função de logging

class VerificadorProdutoKabum(VerificadorProdutos):
    def verificar_disponibilidade_produto(self, url):
        headers = {
            'User-Agent': 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.3'
        }

        # Faz a requisição HTTP à página do produto com User-Agent para evitar bloqueios
        response = requests.get(url, headers=headers)
        soup = BeautifulSoup(response.content, 'html.parser')

        # Verifica se o produto está marcado como indisponível na página
        produto_indisponivel_svg = soup.select_one('svg.IconUnavailable')
        produto_indisponivel_texto = soup.select_one(
            'div#main-content div.sc-4e2d4867-0.kfefWY div.sc-4e2d4867-1.dPPiZL span.sc-4e2d4867-2.ccbyaK'
        )

        # Condição para produto indisponível
        if produto_indisponivel_svg or (
            produto_indisponivel_texto and "Ops... Produto indisponível!" in produto_indisponivel_texto.get_text(strip=True)
        ):
            return False

        return True

    def coletar_dados_produto_pagina(self, url):
        headers = {
            'User-Agent': 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.3'
        }

        # Faz a requisição HTTP à página do produto com User-Agent para evitar bloqueios
        response = requests.get(url, headers=headers)
        soup = BeautifulSoup(response.content, 'html.parser')

        try:
            # Coleta o nome do produto
            nome = soup.select_one('div.col-purchase h1').get_text(strip=True)

            # Coleta o preço do produto, tratando separadores de milhar e decimais brasileiros
            preco_element = soup.select_one('h4.finalPrice')
            preco = float(preco_element.get_text(strip=True)
                          .replace('R$', '')
                          .replace('.', '')
                          .replace(',', '.')
                          .strip()) if preco_element else None

            return {'nome': nome, 'preco': preco}
        except Exception as e:
            print(f"Erro ao coletar dados da página {url}: {e}")
            return None

    def filtrar_urls(self, produtos):
        # Filtra URLs que começam com "https://www.kabum.com.br"
        return [produto for produto in produtos if produto[3].startswith('https://www.kabum.com.br')]
