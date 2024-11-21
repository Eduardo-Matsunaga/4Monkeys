import requests
from bs4 import BeautifulSoup
import logging

class PatoScraper:
    def collect_products(self, url):
        response = requests.get(url)
        soup = BeautifulSoup(response.content, 'html.parser')
        produtos = soup.select('article.product')
        resultados = []

        if not produtos:
            return resultados

        for produto in produtos:
            try:
                nome = produto.select_one('h3.tit').get_text(strip=True)
                link = produto.select_one('a')['href']
                preco_element = produto.select_one('span.h1.text-success')

                if preco_element:
                    preco_texto = preco_element.get_text(strip=True)
                    preco = float(preco_texto.replace('R$', '').replace('.', '').replace(',', '.').strip())
                    moeda = 'BRL'
                else:
                    preco = None

                if preco:
                    resultados.append({
                        'nome': nome,
                        'preco': preco,
                        'moeda': moeda,
                        'link': link,
                        'disponibilidade': 1
                    })
            except Exception as e:
                continue

        return resultados
