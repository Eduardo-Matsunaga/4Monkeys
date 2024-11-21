import schedule
import time
from .verificador_kabum import VerificadorProdutoKabum
from .verificador_pato import VerificadorProdutoPato
from .verificador_gkinfostore import VerificadorProdutoGKInfoStore

def executar_verificadores():
    verificador_kabum = VerificadorProdutoKabum()
    verificador_kabum.processar_produtos()

    verificador_pato = VerificadorProdutoPato()
    verificador_pato.processar_produtos()

    verificador_gkinfostore = VerificadorProdutoGKInfoStore()
    verificador_gkinfostore.processar_produtos()

if __name__ == "__main__":
    # Agenda a execução a cada 1 minuto
    schedule.every(0.08).minutes.do(executar_verificadores)
    schedule.every(0.08).minutes.do(executar_verificadores)

    # Mantém o script rodando indefinidamente
    while True:
        schedule.run_pending()
        time.sleep(1)  # Aguarda 1 segundo antes de verificar novamente
