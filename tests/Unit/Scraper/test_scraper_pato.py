import pytest
import sys
import os

sys.path.append(os.path.abspath("C:/Projetos/4Monkey/python/scraper"))
from pato_scraper import PatoScraper

# Lista de URLs fornecidas para testar o PatoScraper
urls_para_testar = [
    {"url": "https://patoloco.com.br/produtos/placa-de-video", "filters": None},
    {"url": "https://patoloco.com.br/produtos/processadores", "filters": None},
    {"url": "https://patoloco.com.br/produtos/placas-mae", "filters": None},
    {"url": "https://patoloco.com.br/produtos/memorias", "filters": None},
    {"url": "https://patoloco.com.br/produtos/ssd", "filters": None},
    {"url": "https://patoloco.com.br/produtos/ssd-m2", "filters": None},
    {"url": "https://patoloco.com.br/produtos/coolers-e-watercoolers", "filters": None},
    {"url": "https://patoloco.com.br/produtos/fontes", "filters": None},
]

@pytest.mark.parametrize("item", urls_para_testar)
def test_coleta_produtos_todas_urls(item):
    url = item["url"]

    # Instancia o scraper
    scraper = PatoScraper()

    # Executa a função collect_products usando a URL real
    resultados = scraper.collect_products(url)

    # Verifica se algum produto foi coletado
    assert len(resultados) > 0, f"Nenhum produto foi coletado da URL: {url}"

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
