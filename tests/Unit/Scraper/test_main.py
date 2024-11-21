import pytest
from unittest.mock import patch, MagicMock
import sys
import os

# Caminho do módulo 'scraper'
scraper_path = os.path.abspath("C:/Projetos/4Monkey/python")
if scraper_path not in sys.path:
    sys.path.append(scraper_path)

from scraper.main import processar_paginas  # Importe a função necessária


# Dados simulados de produtos para os scrapers
produtos_mock_kabum = [
    {'nome': 'Produto Kabum 1', 'preco': 100.00, 'moeda': 'BRL', 'link': 'https://kabum.com.br/produto/1', 'disponibilidade': 1},
    {'nome': 'Produto Kabum 2', 'preco': 200.00, 'moeda': 'BRL', 'link': 'https://kabum.com.br/produto/2', 'disponibilidade': 1}
]

produtos_mock_pato = [
    {'nome': 'Produto Pato 1', 'preco': 300.00, 'moeda': 'BRL', 'link': 'https://patoloco.com.br/produto/1', 'disponibilidade': 1},
    {'nome': 'Produto Pato 2', 'preco': 400.00, 'moeda': 'BRL', 'link': 'https://patoloco.com.br/produto/2', 'disponibilidade': 1}
]

@pytest.fixture
def mock_kabum_scraper():
    with patch('scraper.main.KabumScraper') as MockScraper:
        instance = MockScraper.return_value
        yield instance

@pytest.fixture
def mock_salvar_produtos():
    with patch('scraper.main.salvar_produtos_no_banco') as mock_salvar:
        yield mock_salvar

# Testando o scraping para Kabum
def test_processar_paginas_kabum(mock_kabum_scraper, mock_salvar_produtos):
    url = "https://www.kabum.com.br/produtos"

    # Simulando que o scraper retorna produtos em cada chamada
    mock_kabum_scraper.collect_products.side_effect = [produtos_mock_kabum] * 10  # Retorna os mesmos produtos para 10 páginas

    processar_paginas(url)

    # Verifica se o scraper foi chamado 10 vezes
    assert mock_kabum_scraper.collect_products.call_count == 10
    # Verifica se salvar_produtos_no_banco foi chamado apenas uma vez com a lista completa
    mock_salvar_produtos.assert_called_once_with(produtos_mock_kabum * 10)  # Deverá ser a lista acumulada de produtos

# Testando o scraping para PatoLoco
@patch("scraper.main.salvar_produtos_no_banco")
@patch("scraper.main.PatoScraper")
def test_processar_paginas_pato(mock_pato_scraper_class, mock_salvar_produtos):
    # Configura o mock para o scraper
    mock_scraper_instance = MagicMock()
    mock_pato_scraper_class.return_value = mock_scraper_instance
    mock_scraper_instance.collect_products.side_effect = [produtos_mock_pato] * 10  # Retorna os mesmos produtos para 10 páginas

    url = "https://patoloco.com.br/produtos"
    processar_paginas(url)

    # Verifica se o método collect_products foi chamado 10 vezes
    assert mock_scraper_instance.collect_products.call_count == 10
    # Verifica se salvar_produtos_no_banco foi chamado apenas uma vez com a lista completa
    mock_salvar_produtos.assert_called_once_with(produtos_mock_pato * 10)

# Testando quando não há produtos retornados
def test_processar_paginas_sem_produtos(mock_kabum_scraper, mock_salvar_produtos):
    mock_kabum_scraper.collect_products.return_value = []

    url = "https://www.kabum.com.br/produtos"
    processar_paginas(url)

    # Verifica que a função salvar_produtos_no_banco não foi chamada
    mock_salvar_produtos.assert_not_called()

# Testando o limite máximo de páginas
def test_processar_paginas_limite_paginas(mock_kabum_scraper, mock_salvar_produtos):
    # Simulando o comportamento de várias páginas
    mock_kabum_scraper.collect_products.side_effect = [produtos_mock_kabum] * 2  # Retorna produtos para 2 páginas

    url = "https://www.kabum.com.br/produtos"
    processar_paginas(url, max_paginas=2)

    # Verifica se o scraper foi chamado apenas duas vezes
    assert mock_kabum_scraper.collect_products.call_count == 2

    # Verifica se os produtos da primeira página foram salvos
    mock_salvar_produtos.assert_called_once_with(produtos_mock_kabum * 2)  # Deve ser a lista acumulada

# Testando o encerramento após páginas sem produtos
def test_processar_paginas_max_paginas_sem_produtos(mock_kabum_scraper, mock_salvar_produtos):
    # Simulando que nenhuma página retorna produtos
    mock_kabum_scraper.collect_products.return_value = []

    url = "https://www.kabum.com.br/produtos"
    processar_paginas(url, max_paginas_sem_produtos=3)

    # Verifica que a função salvar_produtos_no_banco não foi chamada
    mock_salvar_produtos.assert_not_called()
    # Confirma que o loop foi interrompido após três páginas sem produtos
    assert mock_kabum_scraper.collect_products.call_count == 3
