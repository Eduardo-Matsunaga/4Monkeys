import os
import sys
from unittest.mock import patch, MagicMock

import pytest

# Adiciona o caminho do scraper apenas se ainda não estiver no sys.path, para evitar duplicações.
scraper_path = os.path.abspath("C:/Projetos/4Monkey/python/scraper")
if scraper_path not in sys.path:
    sys.path.append(scraper_path)

import kabum_scraper  # Importação do módulo completo, se necessário
from kabum_scraper import KabumScraper  # Importação direta da classe para uso específico

from urllib.parse import urlencode

# Lista de URLs com seus filtros correspondentes
urls_para_testar = [
    {"url": "https://www.kabum.com.br/hardware/processadores",
     "filters": {
         "facet_filters": "eyJrYWJ1bV9wcm9kdWN0IjpbInRydWUiXSwiY2F0ZWdvcnkiOlsiSGFyZHdhcmUiXSwiVsOtZGVvIEludGVncmFkbyI6WyJOw6NvIl19",
         "sort": "most_searched"
     }},
    {"url": "https://www.kabum.com.br/hardware/ssd-2-5/ssd-sata",
     "filters": {
         "facet_filters": "eyJrYWJ1bV9wcm9kdWN0IjpbInRydWUiXSwiY2F0ZWdvcnkiOlsiSGFyZHdhcmUiXSwiaGFzX29mZmVyIjpbInRydWUiXX0=",
         "sort": "most_searched"
     }},
    {"url": "https://www.kabum.com.br/hardware/coolers/water-cooler",
     "filters": {
         "facet_filters": "eyJrYWJ1bV9wcm9kdWN0IjpbInRydWUiXSwiY2F0ZWdvcnkiOlsiSGFyZHdhcmUiXX0=",
         "sort": "most_searched"
     }},
    {"url": "https://www.kabum.com.br/hardware/coolers/air-cooler",
     "filters": {
         "facet_filters": "eyJrYWJ1bV9wcm9kdWN0IjpbInRydWUiXSwiY2F0ZWdvcnkiOlsiSGFyZHdhcmUiXX0=",
         "sort": "most_searched"
     }},
    {"url": "https://www.kabum.com.br/hardware/fontes",
     "filters": {
         "facet_filters": "eyJrYWJ1bV9wcm9kdWN0IjpbInRydWUiXSwiY2F0ZWdvcnkiOlsiSGFyZHdhcmUiXX0=",
         "sort": "most_searched"
     }},
    {"url": "https://www.kabum.com.br/hardware/memoria-ram",
     "filters": {
         "facet_filters": "eyJrYWJ1bV9wcm9kdWN0IjpbInRydWUiXSwiY2F0ZWdvcnkiOlsiSGFyZHdhcmUiXSwiQ29tcGF0aWJpbGlkYWRlIjpbIkRlc2t0b3AiXSwiaGFzX29mZmVyIjpbInRydWUiXX0=",
         "sort": "most_searched"
     }},
    {"url": "https://www.kabum.com.br/hardware/placas-mae",
     "filters": {
         "facet_filters": "eyJrYWJ1bV9wcm9kdWN0IjpbInRydWUiXSwiaGFzX29mZmVyIjpbInRydWUiXX0=",
         "sort": "most_searched"
     }},
]

@pytest.mark.parametrize("item", urls_para_testar)
def test_coleta_produtos_todas_urls(item):
    # Adiciona os filtros à URL
       url_with_filters = f"{item['url']}?{urlencode(item['filters'])}"

       # Instancia o scraper
       scraper = KabumScraper()

       # Executa a função collect_products usando a URL real
       resultados = scraper.collect_products(url_with_filters)

       # Verifica se algum produto foi coletado
       assert len(resultados) > 0, f"Nenhum produto foi coletado da URL: {url_with_filters}"

       # Verifica os primeiros 5 resultados e verifica se os atributos foram coletados corretamente
       for produto in resultados[:5]:
           # Verifica se os campos estão presentes e são válidos
           assert 'nome' in produto and isinstance(produto['nome'], str) and produto['nome'], "Nome inválido ou ausente"
           assert 'preco' in produto and isinstance(produto['preco'], (float, int)) and produto['preco'] > 0, "Preço inválido ou ausente"
           assert 'moeda' in produto and produto['moeda'] == 'BRL', "Moeda inválida ou ausente"
           assert 'link' in produto and isinstance(produto['link'], str) and produto['link'].startswith("https://"), "Link inválido ou ausente"
           assert 'disponibilidade' in produto and isinstance(produto['disponibilidade'], int), "Disponibilidade inválida ou ausente"

           # Exibe os resultados coletados para verificação manual (opcional)
           print(f"Produto: {produto['nome']} - Preço: {produto['preco']} {produto['moeda']} - Link: {produto['link']} - Disponibilidade: {produto['disponibilidade']}")

# Teste quando o script __NEXT_DATA__ está ausente no HTML
@patch('kabum_scraper.requests.get')
def test_collect_products_no_next_data(mock_get):
    # Simula a resposta sem o script __NEXT_DATA__
    mock_response = MagicMock()
    mock_response.content = '<html><body><div>No products here!</div></body></html>'
    mock_get.return_value = mock_response

    scraper = KabumScraper()
    url = 'https://www.kabum.com.br/produtos'
    resultados = scraper.collect_products(url)

    # Deve retornar uma lista vazia já que o script não está presente
    assert resultados == []



