import pytest
from unittest.mock import patch, MagicMock
from verificador.verificador_pato import VerificadorProdutoPato

# Mock de uma página de produto disponível
mock_html_produto_disponivel = '''
<html>
    <body>
        <h1 class="h4 product-name"><span itemprop="name">Produto Teste Pato</span></h1>
        <span itemprop="price">R$ 199,99</span>
    </body>
</html>
'''

# Mock de uma página de produto indisponível
mock_html_produto_indisponivel = '''
<html>
    <body>
        <div class="alert">
            <span class="alert alert-danger">Produto indisponível</span>
        </div>
    </body>
</html>
'''

# Mock de uma página de erro 404
mock_html_erro_404 = '''
<html>
    <body>
        <div class="text-center">
            <h1>404</h1>
        </div>
    </body>
</html>
'''

@pytest.fixture
def verificador_pato():
    return VerificadorProdutoPato()

@patch('verificador.verificador_pato.requests.get')
def test_verificar_disponibilidade_produto_disponivel(mock_get, verificador_pato):
    # Simula uma página de produto disponível
    mock_response = MagicMock()
    mock_response.content = mock_html_produto_disponivel
    mock_get.return_value = mock_response

    assert verificador_pato.verificar_disponibilidade_produto('https://patoloco.com.br/produtos/placa-de-video') == True

@patch('verificador.verificador_pato.requests.get')
def test_verificar_disponibilidade_produto_indisponivel(mock_get, verificador_pato):
    # Simula uma página de produto indisponível
    mock_response = MagicMock()
    mock_response.content = mock_html_produto_indisponivel
    mock_get.return_value = mock_response

    assert verificador_pato.verificar_disponibilidade_produto('https://patoloco.com.br/produtos/placa-de-video') == False

@patch('verificador.verificador_pato.requests.get')
def test_verificar_disponibilidade_produto_erro_404(mock_get, verificador_pato):
    # Simula uma página de erro 404
    mock_response = MagicMock()
    mock_response.content = mock_html_erro_404
    mock_get.return_value = mock_response

    assert verificador_pato.verificar_disponibilidade_produto('https://patoloco.com.br/produtos/placa-de-video') == False

@patch('verificador.verificador_pato.requests.get')
def test_coletar_dados_produto(mock_get, verificador_pato):
    # Simula uma página com um produto e preço
    mock_response = MagicMock()
    mock_response.content = mock_html_produto_disponivel
    mock_get.return_value = mock_response

    dados_produto = verificador_pato.coletar_dados_produto_pagina('https://patoloco.com.br/produtos/placa-de-video')

    assert dados_produto is not None
    assert dados_produto['nome'] == 'Produto Teste Pato'
    assert dados_produto['preco'] == 199.99

@patch('verificador.verificador_pato.requests.get')
def test_coletar_dados_produto_sem_preco(mock_get, verificador_pato):
    # Simula uma página de produto sem preço
    mock_html_sem_preco = '''
    <html>
        <body>
            <h1 class="h4 product-name"><span itemprop="name">Produto Sem Preço</span></h1>
        </body>
    </html>
    '''
    mock_response = MagicMock()
    mock_response.content = mock_html_sem_preco
    mock_get.return_value = mock_response

    dados_produto = verificador_pato.coletar_dados_produto_pagina('https://patoloco.com.br/produtos/placa-de-video')

    assert dados_produto is not None
    assert dados_produto['nome'] == 'Produto Sem Preço'
    assert dados_produto['preco'] is None
