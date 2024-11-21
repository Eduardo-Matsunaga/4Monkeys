import sqlite3
from abc import ABC, abstractmethod
from scraper.settings import DB_NAME  # Importa o caminho do banco de dados
from scraper.database import salvar_log_no_banco  # Importa a função de logging

class VerificadorProdutos(ABC):
    def processar_produtos(self):
        self.verificar_e_atualizar_disponibilidade_no_banco()

    def verificar_e_atualizar_disponibilidade_no_banco(self):
        # Use a variável DB_NAME para conectar ao banco de dados
        conn = sqlite3.connect(DB_NAME)
        cursor = conn.cursor()

        cursor.execute('''
            SELECT produtos.id, produtos.nome, loja_online.valor, loja_online.urlLoja, produtos.disponibilidade
            FROM produtos
            JOIN loja_online ON produtos.loja_online_id = loja_online.id
        ''')
        produtos_no_banco = cursor.fetchall()

        produtos_no_banco = self.filtrar_urls(produtos_no_banco)

        for produto_banco in produtos_no_banco:
            produto_id, nome_banco, preco_banco, url, disponibilidade_atual = produto_banco
            print(f"Verificando produto com URL: {url}")
            salvar_log_no_banco(url, 0, f"Verificando produto com URL: {url}")
            dados_produto_pagina = self.coletar_dados_produto_pagina(url)
            disponivel = self.verificar_disponibilidade_produto(url)

            if not disponivel:
                print(f"Produto com URL {url} está indisponível. Alterando disponibilidade para 0.")
                cursor.execute('UPDATE produtos SET disponibilidade = 0 WHERE id = ?', (produto_id,))
                conn.commit()
                salvar_log_no_banco(url, produto_id, f"Produto com URL {url} está indisponível.")

                cursor.execute('SELECT id FROM estoque WHERE produto_id = ?', (produto_id,))
                estoque_item = cursor.fetchone()
                if estoque_item:
                    print(f"Removendo produto com ID {produto_id} da tabela estoque.")
                    cursor.execute('DELETE FROM estoque WHERE produto_id = ?', (produto_id,))
                    conn.commit()
                    salvar_log_no_banco(url, produto_id, f"Produto com ID {produto_id} removido do estoque.")
            else:
                if dados_produto_pagina:
                    nome_atualizado = dados_produto_pagina['nome']
                    preco_atualizado = dados_produto_pagina['preco']

                    if nome_atualizado != nome_banco:
                        print(f"Nome diferente encontrado. Atualizando de '{nome_banco}' para '{nome_atualizado}'")
                        cursor.execute('''
                            UPDATE produtos
                            SET nome = ?
                            WHERE id = ?
                        ''', (nome_atualizado, produto_id))
                        conn.commit()
                        salvar_log_no_banco(url, produto_id, f"Nome atualizado de '{nome_banco}' para '{nome_atualizado}'")

                    if preco_atualizado != preco_banco:
                        print(f"Preço diferente encontrado. Atualizando de {preco_banco} para {preco_atualizado}")
                        cursor.execute('''
                            UPDATE loja_online
                            SET valor = ?
                            WHERE id = (SELECT loja_online_id FROM produtos WHERE id = ?)
                        ''', (preco_atualizado, produto_id))
                        conn.commit()
                        salvar_log_no_banco(url, produto_id, f"Preço atualizado de {preco_banco} para {preco_atualizado}")

                    if disponibilidade_atual == 0:
                        print(f"Produto com URL {url} está disponível, mas marcado como indisponível no banco.")
                        cursor.execute('UPDATE produtos SET disponibilidade = 1 WHERE id = ?', (produto_id,))
                        conn.commit()
                        salvar_log_no_banco(url, produto_id, f"Produto com URL {url} marcado como disponível.")

                        cursor.execute('SELECT id FROM estoque WHERE produto_id = ?', (produto_id,))
                        estoque_item = cursor.fetchone()
                        if not estoque_item:
                            print(f"Adicionando produto com ID {produto_id} de volta ao estoque.")
                            cursor.execute('''
                                INSERT INTO estoque (produto_id, created_at, updated_at)
                                VALUES (?, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)
                            ''', (produto_id,))
                            conn.commit()
                            salvar_log_no_banco(url, produto_id, f"Produto com ID {produto_id} adicionado de volta ao estoque.")
                else:
                    print(f"Não foi possível coletar os dados do produto com URL: {url}. Removendo do banco.")
                    salvar_log_no_banco(url, produto_id, f"Dados do produto não coletados, removendo do banco.")

                    # Primeiro, remova o produto do estoque baseado no produto_id
                    cursor.execute('DELETE FROM estoque WHERE produto_id = ?', (produto_id,))

                    # Depois, remova as informações da loja_online e do produto
                    cursor.execute('DELETE FROM loja_online WHERE id = (SELECT loja_online_id FROM produtos WHERE id = ?)', (produto_id,))
                    cursor.execute('DELETE FROM produtos WHERE id = ?', (produto_id,))

                    # Commit das alterações no banco
                    conn.commit()

        conn.close()

    @abstractmethod
    def verificar_disponibilidade_produto(self, url):
        pass

    @abstractmethod
    def coletar_dados_produto_pagina(self, url):
        pass

    @abstractmethod
    def filtrar_urls(self, produtos):
        pass
