<div class="d-flex justify-content-center my-4">
    <div id="imageCarousel" class="carousel slide" data-bs-ride="carousel" style="width: 70%;">
        <div class="carousel-inner">
            <!-- Cada slide contém 3 imagens, divididas em colunas -->
            <div class="carousel-item active">
                <div class="row">
                    <div class="col-md-4">
                        <img src="{{ asset('images/csgo2.png') }}" class="d-block w-100" alt="Imagem 1">
                    </div>
                    <div class="col-md-4">
                        <img src="{{ asset('images/pubg.jpg') }}" class="d-block w-100" alt="Imagem 2">
                    </div>
                    <div class="col-md-4">
                        <img src="{{ asset('images/valorant.png') }}" class="d-block w-100" alt="Imagem 3">
                    </div>
                </div>
            </div>

            <!-- Slide 2 -->
            <div class="carousel-item">
                <div class="row">
                    <div class="col-md-4">
                        <img src="{{ asset('images/vs-code-logo.png') }}" class="d-block w-100" alt="Imagem 4">
                    </div>
                    <div class="col-md-4">
                        <img src="{{ asset('images/minecraft.jpg') }}" class="d-block w-100" alt="Imagem 5">
                    </div>
                    <div class="col-md-4">
                        <img src="{{ asset('images/monkey.png') }}" class="d-block w-100" alt="Imagem 6">
                    </div>
                </div>
            </div>

            <!-- Adicione mais slides conforme necessário -->
        </div>

        <!-- Controles de navegação -->
        <button class="carousel-control-prev" type="button" data-bs-target="#imageCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#imageCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>

<!-- Script personalizado para avançar uma imagem de cada vez -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
    const carouselElement = document.querySelector('#imageCarousel');
    const items = Array.from(carouselElement.querySelectorAll('.carousel-item'));
    let currentIndex = 0;

    // Função para atualizar a exibição do carrossel
    function updateCarousel(direction) {
        // Remove a classe 'active' de todos os itens
        items.forEach(item => item.classList.remove('active'));

        // Atualiza o índice com base na direção do clique
        if (direction === 'next') {
            currentIndex = (currentIndex + 1) % items.length;
        } else if (direction === 'prev') {
            currentIndex = (currentIndex - 1 + items.length) % items.length;
        }

        // Adiciona a classe 'active' aos três itens a partir do índice atual
        for (let i = 0; i < 3; i++) {
            items[(currentIndex + i) % items.length].classList.add('active');
        }
    }

    // Eventos para os botões de navegação
    document.querySelector('.carousel-control-next').addEventListener('click', function () {
        updateCarousel('next');
    });

    document.querySelector('.carousel-control-prev').addEventListener('click', function () {
        updateCarousel('prev');
    });

    // Inicializa os três primeiros itens como ativos
    updateCarousel();
});

</script>
