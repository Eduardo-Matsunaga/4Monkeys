import time
from urllib.parse import urlencode
from scraper.database import salvar_produtos_no_banco, salvar_log_no_banco
from scraper.pato_scraper import PatoScraper
from scraper.kabum_scraper import KabumScraper
from scraper.gkinfostore_scraper import GKInfoStoreScraper
from scraper.settings import urls_para_processar

def processar_paginas(url_base, max_paginas=2, filters=None, max_paginas_sem_produtos=3):
    if "kabum.com.br" in url_base:
        scraper = KabumScraper()
        base_url_with_filters = f"{url_base}?{urlencode(filters)}" if filters else url_base
        pagina_formatada = "&page_number={}"
    elif "patoloco.com.br" in url_base:
        scraper = PatoScraper()
        base_url_with_filters = url_base
        pagina_formatada = "/{}"

    elif "gkinfostore.com.br" in url_base:
        scraper = GKInfoStoreScraper()
        base_url_with_filters = url_base
        pagina_formatada = "?pagina={}"
    else:
        mensagem = f"Site não suportado: {url_base}"
        print(mensagem)
        salvar_log_no_banco(url_base, 0, mensagem)
        return

    pagina = 1
    todos_produtos = []
    paginas_sem_produtos = 0

    while True:
        url = f"{base_url_with_filters}{pagina_formatada.format(pagina)}"
        produtos_da_pagina = scraper.collect_products(url)

        if not produtos_da_pagina:
            paginas_sem_produtos += 1
            mensagem = f"Nenhum produto encontrado na página {pagina}. {paginas_sem_produtos} páginas sem produtos."
            print(mensagem)
            salvar_log_no_banco(url_base, pagina, mensagem)
            if paginas_sem_produtos >= max_paginas_sem_produtos:
                mensagem = f"Encerrando scraping para {url_base} após {paginas_sem_produtos} páginas sem produtos."
                print(mensagem)
                salvar_log_no_banco(url_base, pagina, mensagem)
                break
        else:
            paginas_sem_produtos = 0
            todos_produtos.extend(produtos_da_pagina)
            mensagem = f"Página {pagina} processada para URL: {url_base}"
            print(mensagem)
            salvar_log_no_banco(url_base, pagina, mensagem)

        if pagina >= max_paginas:
            mensagem = f"Limite máximo de páginas ({max_paginas}) atingido para {url_base}."
            print(mensagem)
            salvar_log_no_banco(url_base, pagina, mensagem)
            break

        pagina += 1
        time.sleep(2)

    if todos_produtos:
        salvar_produtos_no_banco(todos_produtos)
        mensagem = f"Total de produtos coletados e salvos para {url_base}: {len(todos_produtos)}"
    else:
        mensagem = f"Nenhum produto foi coletado para a URL {url_base}."

    print(mensagem)
    salvar_log_no_banco(url_base, pagina, mensagem)

# Processar todas as URLs com seus filtros
for item in urls_para_processar:
    processar_paginas(item["url"], filters=item["filters"])
