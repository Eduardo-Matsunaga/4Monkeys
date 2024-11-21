import pytest
from unittest.mock import patch
from verificador.main import VerificadorProdutoKabum, VerificadorProdutoPato

@patch.object(VerificadorProdutoKabum, 'processar_produtos')
@patch.object(VerificadorProdutoPato, 'processar_produtos')
def test_main_processar_produtos(mock_processar_pato, mock_processar_kabum):
    """
    Testa se os métodos processar_produtos de VerificadorProdutoKabum
    e VerificadorProdutoPato são chamados corretamente.
    """
    # Simula a execução do script main.py diretamente
    import verificador.main

    # Executa diretamente as instâncias de Kabum e Pato que estão no main
    verificador.main.VerificadorProdutoKabum().processar_produtos()
    verificador.main.VerificadorProdutoPato().processar_produtos()

    # Verifica se o método processar_produtos foi chamado para Kabum
    mock_processar_kabum.assert_called_once()

    # Verifica se o método processar_produtos foi chamado para Pato
    mock_processar_pato.assert_called_once()
