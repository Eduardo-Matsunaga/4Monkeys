import pytest
from unittest.mock import patch, MagicMock, call
import sqlite3
from verificador.verificador_base import VerificadorProdutos

# Criação de uma classe mock para testar a classe abstrata VerificadorProdutos
class MockVerificadorProdutos(VerificadorProdutos):
    def verificar_disponibilidade_produto(self, url):
        return True

    def coletar_dados_produto_pagina(self, url):
        return {'nome': 'Produto Atualizado', 'preco': 199.99}

    def filtrar_urls(self, produtos):
        return produtos

@pytest.fixture
def mock_verificador():
    return MockVerificadorProdutos()


@patch('sqlite3.connect')
def test_verificar_produto_indisponivel(mock_connect, mock_verificador):
    # Mock da conexão do banco de dados
    mock_conn = MagicMock()
    mock_cursor = MagicMock()
    mock_connect.return_value = mock_conn
    mock_conn.cursor.return_value = mock_cursor

    # Simulando um produto indisponível no banco
    mock_cursor.fetchall.return_value = [
        (1, 'Produto Teste', 150.0, 'https://www.kabum.com.br/produto/123456', 1)
    ]

    # Sobrescreve a função para retornar que o produto está indisponível
    mock_verificador.verificar_disponibilidade_produto = MagicMock(return_value=False)

    mock_verificador.verificar_e_atualizar_disponibilidade_no_banco()

    # Verifica se a disponibilidade foi atualizada para indisponível (0)
    mock_cursor.execute.assert_any_call('UPDATE produtos SET disponibilidade = 0 WHERE id = ?', (1,))
    mock_cursor.execute.assert_any_call('DELETE FROM estoque WHERE produto_id = ?', (1,))

@patch('sqlite3.connect')
def test_remover_produto_sem_dados(mock_connect, mock_verificador):
    # Mock da conexão do banco de dados
    mock_conn = MagicMock()
    mock_cursor = MagicMock()
    mock_connect.return_value = mock_conn
    mock_conn.cursor.return_value = mock_cursor

    # Simulando produtos no banco de dados
    mock_cursor.fetchall.return_value = [
        (1, 'Produto Teste', 150.0, 'https://www.kabum.com.br/produto/123456', 1)
    ]

    # Simulando a falha ao coletar dados da página
    mock_verificador.coletar_dados_produto_pagina = MagicMock(return_value=None)

    mock_verificador.verificar_e_atualizar_disponibilidade_no_banco()

    # Verifica se o produto foi removido do banco e estoque
    mock_cursor.execute.assert_any_call('DELETE FROM estoque WHERE produto_id = ?', (1,))
    mock_cursor.execute.assert_any_call('DELETE FROM loja_online WHERE id = (SELECT loja_online_id FROM produtos WHERE id = ?)', (1,))
    mock_cursor.execute.assert_any_call('DELETE FROM produtos WHERE id = ?', (1,))
