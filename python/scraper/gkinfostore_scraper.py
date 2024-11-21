import requests
from bs4 import BeautifulSoup

class GKInfoStoreScraper:
    def collect_products(self, url):
        headers = {
            'User-Agent': 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.3'
        }

        response = requests.get(url, headers=headers)

        if response.status_code != 200:
            print(f"Erro ao acessar a página, status code: {response.status_code}")
            return []

        soup = BeautifulSoup(response.content, 'html.parser')

        listagem_produtos = soup.find('div', id='listagemProdutos')
        if not listagem_produtos:
            print("A div 'listagemProdutos' não foi encontrada.")
            return []

        resultados = []

        produtos = listagem_produtos.find_all('li', class_='span3')
        for produto in produtos:
            # Verifica se o produto está indisponível
            if 'indisponivel' in produto.get('class', []):
                continue

            nome_tag = produto.find('a', class_='nome-produto cor-secundaria')
            nome = nome_tag.text.strip() if nome_tag else "Produto sem nome"

            link = nome_tag['href'] if nome_tag else "#"

            # Preço à vista
            preco_vista_tag = produto.find('span', class_='desconto-a-vista')
            if not preco_vista_tag:
                continue  # Ignora se não há preço à vista

            preco_vista_text = preco_vista_tag.find('strong', class_='cor-principal titulo').text.strip() if preco_vista_tag else "0"

            # Remove "R$" e converte o preço para float
            preco_vista = float(preco_vista_text.replace("R$", "").replace(".", "").replace(",", ".").strip())

            resultados.append({
                'nome': nome,
                'preco': preco_vista,
                'moeda': 'BRL',
                'link': link,
                'disponibilidade': 1  # Presumindo que está disponível se chegou até aqui
            })

        return resultados
