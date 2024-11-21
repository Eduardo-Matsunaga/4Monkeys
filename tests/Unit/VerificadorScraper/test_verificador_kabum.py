import pytest
from unittest.mock import patch, MagicMock
from verificador.verificador_kabum import VerificadorProdutoKabum

# Mock de uma página de produto disponível
mock_html_produto_disponivel = '''
<html>
    <body>
        <div class="col-purchase">
            <h1>Produto Teste Kabum</h1>
        </div>
        <h4 class="finalPrice">R$ 199,99</h4>
    </body>
</html>
'''

# Mock de uma página de produto indisponível
mock_html_produto_indisponivel = '''
<html>
    <body>
        <svg class="IconUnavailable"></svg>
        <div id="main-content">
            <span>Ops... Produto indisponível!</span>
        </div>
    </body>
</html>
'''

# Mock de uma página com erro
mock_html_erro = '''
<html>
    <body>
        <div class="error-page">
            <h1>Erro ao carregar a página</h1>
        </div>
    </body>
</html>
'''

@pytest.fixture
def verificador_kabum():
    return VerificadorProdutoKabum()

@patch('verificador.verificador_kabum.requests.get')
def test_verificar_disponibilidade_produto_disponivel(mock_get, verificador_kabum):
    # Simula uma página de produto disponível
    mock_response = MagicMock()
    mock_response.content = mock_html_produto_disponivel
    mock_get.return_value = mock_response

    assert verificador_kabum.verificar_disponibilidade_produto('https://www.kabum.com.br/produto/123456') == True

@patch('verificador.verificador_kabum.requests.get')
def test_verificar_disponibilidade_produto_indisponivel(mock_get, verificador_kabum):
    # Simula uma página de produto indisponível
    mock_response = MagicMock()
    mock_response.content = mock_html_produto_indisponivel
    mock_get.return_value = mock_response

    assert verificador_kabum.verificar_disponibilidade_produto('https://www.kabum.com.br/produto/123456') == False

@patch('verificador.verificador_kabum.requests.get')
def test_coletar_dados_produto(mock_get, verificador_kabum):
    # Simula uma página com um produto e preço
    mock_response = MagicMock()
    mock_response.content = mock_html_produto_disponivel
    mock_get.return_value = mock_response

    dados_produto = verificador_kabum.coletar_dados_produto_pagina('https://www.kabum.com.br/produto/123456')

    assert dados_produto is not None
    assert dados_produto['nome'] == 'Produto Teste Kabum'
    assert dados_produto['preco'] == 199.99

@patch('verificador.verificador_kabum.requests.get')
def test_coletar_dados_produto_sem_preco(mock_get, verificador_kabum):
    # Simula uma página de produto sem preço
    mock_html_sem_preco = '''
    <html>
        <body>
            <div class="col-purchase">
                <h1>Produto Sem Preço Kabum</h1>
            </div>
        </body>
    </html>
    '''
    mock_response = MagicMock()
    mock_response.content = mock_html_sem_preco
    mock_get.return_value = mock_response

    dados_produto = verificador_kabum.coletar_dados_produto_pagina('https://www.kabum.com.br/produto/123456')

    assert dados_produto is not None
    assert dados_produto['nome'] == 'Produto Sem Preço Kabum'
    assert dados_produto['preco'] is None
