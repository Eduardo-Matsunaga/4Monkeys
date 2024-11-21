import requests
from bs4 import BeautifulSoup
from .verificador_base import VerificadorProdutos

class VerificadorProdutoPato(VerificadorProdutos):
    def verificar_disponibilidade_produto(self, url):

        response = requests.get(url)
        soup = BeautifulSoup(response.content, 'html.parser')
        produto_indisponivel = soup.select_one('div.alert span.alert.alert-danger')

        if produto_indisponivel and "indisponível" in produto_indisponivel.get_text(strip=True).lower():
            return False

        pagina_erro_404 = soup.select_one('div.text-center h1')
        if pagina_erro_404 and pagina_erro_404.get_text(strip=True) == "404":
            return False

        return True

    def coletar_dados_produto_pagina(self, url):
        response = requests.get(url)
        soup = BeautifulSoup(response.content, 'html.parser')

        try:
            nome = soup.select_one('h1.h4.product-name span[itemprop="name"]').get_text(strip=True)
            preco_element = soup.select_one('span[itemprop="price"]')
            preco = float(preco_element.get_text(strip=True).replace('R$', '').replace('.', '').replace(',', '.').strip()) if preco_element else None
            return {'nome': nome, 'preco': preco}
        except Exception as e:
            print(f"Erro ao coletar dados da página {url}: {e}")
            return None

    def filtrar_urls(self, produtos):
        return [produto for produto in produtos if produto[3].startswith('https://patoloco.com.br')]
