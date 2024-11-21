import requests
from bs4 import BeautifulSoup
import json

class KabumScraper:
    def collect_products(self, url):
        headers = {
            'User-Agent': 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.3'
        }

        # Faz a requisição HTTP à página do Kabum com um User-Agent comum para evitar bloqueios
        response = requests.get(url, headers=headers)

        # Verifica se a requisição foi bem-sucedida
        if response.status_code != 200:
            print(f"Erro ao acessar a página, status code: {response.status_code}")
            return []

        soup = BeautifulSoup(response.content, 'html.parser')

        # Encontra o script com os dados JSON embutidos
        script_tag = soup.find('script', id='__NEXT_DATA__')

        # Verifica se o script com id '__NEXT_DATA__' foi encontrado
        if not script_tag:
            print("O script '__NEXT_DATA__' não foi encontrado.")
            return []

        # Exibe o conteúdo do script para garantir que ele foi corretamente extraído
        print("Conteúdo bruto do script __NEXT_DATA__:", script_tag.string[:500], '...')  # Limite para evitar muita impressão

        try:
            # Decodifica o conteúdo do script JSON
            data = json.loads(script_tag.string)
        except json.JSONDecodeError as e:
            print(f"Erro ao decodificar JSON: {e}")
            return []

        # Verifica a estrutura do JSON carregado
        if 'props' not in data or 'pageProps' not in data['props']:
            print("A estrutura do JSON não é a esperada.")
            return []

        # Acessa o campo 'data' que está dentro de 'pageProps' e faz a segunda decodificação
        raw_data_string = data['props']['pageProps'].get('data', '{}')
        if raw_data_string == '{}':
            print("O campo 'data' em 'pageProps' está vazio ou ausente.")
            return []

        try:
            catalog_data = json.loads(raw_data_string)
        except json.JSONDecodeError as e:
            print(f"Erro ao decodificar o campo 'data': {e}")
            return []

        # Acessa os produtos dentro de 'catalogServer'
        catalog_data_inner = catalog_data.get('catalogServer', {}).get('data', [])

        if not catalog_data_inner:
            print("Nenhum produto encontrado dentro do campo 'data'.")
            return []

        resultados = []

        # Itera sobre cada produto e coleta informações relevantes
        for item in catalog_data_inner:
            name = item.get('name')
            price_with_discount = item.get('priceWithDiscount')
            image_url = item.get('image')
            currency = "BRL"

            if image_url:
                parts = image_url.split('/')
                if len(parts) >= 8:
                    product_id = parts[6]
                else:
                    product_id = parts[-2] if len(parts) > 2 else None

                if product_id:
                    product_url = f"https://www.kabum.com.br/produto/{product_id}"
                    if price_with_discount:
                        resultados.append({
                            'nome': name,
                            'preco': price_with_discount,
                            'moeda': currency,
                            'link': product_url,
                            'disponibilidade': 1
                        })

        return resultados
