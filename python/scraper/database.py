import sqlite3
import logging
from .settings import DB_NAME

# Configuração do logger
logging.basicConfig(level=logging.INFO, format='%(asctime)s - %(levelname)s - %(message)s')

def connect_db():
    """Conecta ao banco de dados SQLite e retorna a conexão."""
    try:
        return sqlite3.connect(DB_NAME)
    except sqlite3.Error as e:
        logging.error(f"Erro ao conectar ao banco de dados: {e}")
        return None

def identificar_tipo_produto(nome_produto):
    """Identifica o tipo do produto com base em palavras-chave no nome."""
    tipos = {
        "Fonte": ["Fonte", "Fonte Cooler"],
        "Cooler": ["Cooler", "Water Cooler", "Cooler para Processador"],
        "GPU": ["Placa de Vídeo", "Placa de Video"],
        "CPU": ["Processador"],
        "Placa Mãe": ["Placa Mãe", "Placa MAE"],
        "RAM": ["Memória", "Memoria"],
        "HD/SSD": ["SSD"],
    }

    for tipo, palavras_chave in tipos.items():
        if any(palavra in nome_produto for palavra in palavras_chave):
            return tipo

    return "Outros"  # Retorno padrão caso não encontre correspondência


def salvar_produtos_no_banco(produtos):
    """Insere produtos no banco de dados, incluindo o tipo do produto."""
    if not produtos:
        logging.info("Nenhum produto para salvar.")
        return

    conn = connect_db()
    if not conn:
        logging.error("Falha ao conectar ao banco. Operação abortada.")
        return

    try:
        cursor = conn.cursor()

        for produto in produtos:
            try:
                # Identificar o tipo do produto
                tipo = identificar_tipo_produto(produto['nome'])

                # Verifica se o produto já existe na tabela loja_online
                cursor.execute('''
                    SELECT id FROM loja_online WHERE urlLoja = ?
                ''', (produto['link'],))
                loja_online_result = cursor.fetchone()

                if loja_online_result:
                    logging.info(f"Produto com o link {produto['link']} já existe. Ignorado.")
                    continue

                # Insere na tabela loja_online
                cursor.execute('''
                    INSERT INTO loja_online (urlLoja, valor, moeda, created_at, updated_at)
                    VALUES (?, ?, ?, datetime('now'), datetime('now'))
                ''', (produto['link'], produto['preco'], produto['moeda']))
                loja_online_id = cursor.lastrowid

                # Insere na tabela produtos com o tipo identificado
                cursor.execute('''
                    INSERT INTO produtos (nome, tipo, loja_online_id, disponibilidade, created_at, updated_at)
                    VALUES (?, ?, ?, ?, datetime('now'), datetime('now'))
                ''', (produto['nome'], tipo, loja_online_id, produto['disponibilidade']))
                produto_id = cursor.lastrowid

                # Se o produto estiver disponível, insere no estoque
                if produto['disponibilidade'] == 1:
                    cursor.execute('''
                        INSERT INTO estoque (produto_id, created_at, updated_at)
                        VALUES (?, datetime('now'), datetime('now'))
                    ''', (produto_id,))

                conn.commit()
                logging.info(f"Produto {produto['nome']} inserido com sucesso como {tipo}.")
            except sqlite3.Error as e:
                logging.error(f"Erro ao inserir produto {produto['nome']}: {e}")
                conn.rollback()
    finally:
        conn.close()
        logging.info("Conexão com o banco de dados encerrada.")


def salvar_log_no_banco(url, pagina, mensagem):
    conexao = sqlite3.connect(DB_NAME)

    cursor = conexao.cursor()
    cursor.execute(
        "INSERT INTO logs_scraper (url, pagina, mensagem, created_at) VALUES (?, ?, ?, CURRENT_TIMESTAMP)",
        (url, pagina, mensagem),
    )
    conexao.commit()
    conexao.close()
