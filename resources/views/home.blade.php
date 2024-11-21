@extends('layouts.userfree')

@section('content free')

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const checkboxes = document.querySelectorAll('input[name="softwares[]"]');

            // Desmarcar todos os checkboxes ao carregar a página
            checkboxes.forEach(checkbox => {
                checkbox.checked = false;
            });

            // Adicionar um listener para impedir a seleção de mais de 3
            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    const checkedCount = document.querySelectorAll('input[name="softwares[]"]:checked').length;

                    if (checkedCount > 3) {
                        alert('Você só pode selecionar no máximo 3 softwares.');
                        checkbox.checked = false;  // Desmarca o checkbox que ultrapassou o limite
                    }
                });
            });
        });

        // Função para alternar o estado do card e o checkbox, mas impedindo ação se já houver 3 selecionados
        function toggleFillAndDetails(id, description) {
            const checkedCount = document.querySelectorAll('input[name="softwares[]"]:checked').length;

            // Verifica se já existem 3 selecionados antes de permitir preencher o card
            const checkbox = document.getElementById(`software${id}`);
            if (!checkbox.checked && checkedCount >= 3) {
                alert('Você só pode selecionar no máximo 3 softwares.');
                return;  // Sai da função sem preencher o card ou exibir detalhes
            }

            // Lógica de preenchimento do card
            toggleFillCard(id);

            // Lógica para exibir/ocultar detalhes do software com efeito de digitação
            toggleDetails(id, description);

            // Alterna o checkbox para marcado/desmarcado
            toggleCheckbox(id);
        }

        function toggleFillCard(id) {
            const card = document.getElementById(`checkboxDiv${id}`);
            card.classList.toggle('filled-card');
        }

        function toggleDetails(id, description) {
            const details = document.getElementById('details-' + id);
            if (details.style.display === 'none') {
                details.style.display = 'block';
                typeWriterEffect(`description-${id}`, description);
            } else {
                details.style.display = 'none';
            }
        }

        // Função para alternar o estado do checkbox
        function toggleCheckbox(id) {
            const checkbox = document.getElementById(`software${id}`);
            checkbox.checked = !checkbox.checked;  // Inverte o estado do checkbox
        }

        // Função para o efeito de digitação
        function typeWriterEffect(elementId, text, speed = 50) {
            const element = document.getElementById(elementId);
            element.innerHTML = '';  // Limpa o conteúdo existente antes de iniciar o efeito
            let i = 0;

            function type() {
                if (i < text.length) {
                    element.innerHTML += text.charAt(i);
                    i++;
                    setTimeout(type, speed);  // Define a velocidade de digitação
                }
            }

            type();  // Inicia a função de digitação
        }



        document.addEventListener("DOMContentLoaded", function () {
            const form = document.getElementById("software-selection-form");
            const loadingSpinner = document.getElementById("loading-spinner");

            form.addEventListener("submit", function (event) {
                // Previne o envio imediato do formulário
                event.preventDefault();

                // Esconde todos os elementos do formulário e exibe apenas o spinner
                form.classList.add("hidden"); // Esconde o formulário completo
                loadingSpinner.classList.remove("hidden"); // Exibe o spinner

                // Atraso de 3 segundos antes de enviar o formulário
                setTimeout(function () {
                    form.submit(); // Envia o formulário após o atraso
                }, 3000);
            });
        });

    </script>

<div class="mt-10">
    <div id="loading-spinner" class="hidden absolute inset-0 flex items-center justify-center bg-opacity-50  z-50">
        <div class="flex flex-col items-center">
            <div class="w-16 h-16 border-4 border-t-transparent border-purple-500 rounded-full animate-spin"></div>
            <p class="mt-4 text-2xl text-purple-500">Seu Desktop está sendo gerado...</p>
        </div>
    </div>
    <!-- Formulário Principal -->
    <form id="software-selection-form" action="{{ auth()->check() ? route('free.selecionar') : route('free.selecionar') }}" method="POST" class="relative p-6 bg-white border border-gray-800 rounded-lg shadow">
        @csrf
        <h2 class="mb-6 text-4xl font-bold text-center text-transparent concert-one-regular bg-gradient-to-r from-orange-500 via-pink-400 to-blue-300 bg-clip-text animate-fade-in">
            Selecionar Softwares
        </h2>

        <div class="flex justify-between space-x-4">
            <!-- Coluna de Jogos -->
            <div class="flex-1">
                <h3 class="mb-6 text-4xl font-bold text-center text-transparent concert-one-regular bg-gradient-to-r from-orange-500 via-pink-400 to-blue-300 bg-clip-text animate-fade-in">
                    Jogos
                </h3>
                @foreach($softwares as $software)
                    @if($software->tipo == 1)
                        <div id="checkboxDiv{{ $software->id }}" class="flex items-center p-3 mb-4 transition-shadow duration-300 transform bg-transparent border-2 border-purple-700 rounded-lg shadow-none cursor-pointer hover:shadow-lg hover:scale-105"
                             onclick="toggleFillAndDetails({{ $software->id }}, '{{ addslashes($software->descricao) }}')">
                            <img src="{{ asset('storage/' . $software->imagem) }}" alt="Imagem de {{ $software->nome }}" class="object-cover w-16 h-12 transition-transform duration-300 rounded-md hover:scale-110">
                            <div class="relative ml-4">
                                <input type="checkbox" id="software{{ $software->id }}" name="softwares[]" value="{{ $software->id }}" class="hidden">
                                <label for="software{{ $software->id }}" class="flex items-center block space-x-2 text-lg font-semibold">
                                    <span>{{ $software->nome }}</span>
                                </label>
                            </div>
                        </div>
                        <div id="details-{{ $software->id }}" class="mt-2 details" style="display: none;">
                            <p id="description-{{ $software->id }}" class="text-1xl description"></p>
                        </div>
                    @endif
                @endforeach
            </div>

            <!-- Coluna de Trabalho -->
            <div class="flex-1">
                <h3 class="mb-6 text-4xl font-bold text-center text-transparent concert-one-regular bg-gradient-to-r from-orange-500 via-pink-400 to-blue-300 bg-clip-text animate-fade-in">
                    Trabalho
                </h3>
                @foreach($softwares as $software)
                    @if($software->tipo == 2)
                        <div id="checkboxDiv{{ $software->id }}" class="flex items-center p-3 mb-4 transition-shadow duration-300 transform bg-transparent border-2 border-purple-700 rounded-lg shadow-none cursor-pointer hover:shadow-lg hover:scale-105"
                             onclick="toggleFillAndDetails({{ $software->id }}, '{{ addslashes($software->descricao) }}')">
                            <img src="{{ asset('storage/' . $software->imagem) }}" alt="Imagem de {{ $software->nome }}" class="object-cover w-16 h-12 transition-transform duration-300 rounded-md hover:scale-110">
                            <div class="relative ml-4">
                                <input type="checkbox" id="software{{ $software->id }}" name="softwares[]" value="{{ $software->id }}" class="hidden">
                                <label for="software{{ $software->id }}" class="flex items-center block space-x-2 text-lg font-semibold">
                                    <span>{{ $software->nome }}</span>
                                </label>
                            </div>
                        </div>
                        <div id="details-{{ $software->id }}" class="mt-2 details" style="display: none;">
                            <p id="description-{{ $software->id }}" class="text-1xl description"></p>
                        </div>
                    @endif
                @endforeach
            </div>

            <!-- Coluna de Dispositivos -->
            <div class="flex-1">
                <h3 class="mb-6 text-4xl font-bold text-center text-transparent concert-one-regular bg-gradient-to-r from-orange-500 via-pink-400 to-blue-300 bg-clip-text animate-fade-in">
                    Dispositivos
                </h3>
                @foreach($softwares as $software)
                    @if($software->tipo == 3)
                        <div id="checkboxDiv{{ $software->id }}" class="flex items-center p-3 mb-4 transition-shadow duration-300 transform bg-transparent border-2 border-purple-700 rounded-lg shadow-none cursor-pointer hover:shadow-lg hover:scale-105"
                             onclick="toggleFillAndDetails({{ $software->id }}, '{{ addslashes($software->descricao) }}')">
                            <img src="{{ asset('storage/' . $software->imagem) }}" alt="Imagem de {{ $software->nome }}" class="object-cover w-16 h-12 transition-transform duration-300 rounded-md hover:scale-110">
                            <div class="relative ml-4">
                                <input type="checkbox" id="software{{ $software->id }}" name="softwares[]" value="{{ $software->id }}" class="hidden">
                                <label for="software{{ $software->id }}" class="flex items-center block space-x-2 text-lg font-semibold">
                                    <span>{{ $software->nome }}</span>
                                </label>
                            </div>
                        </div>
                        <div id="details-{{ $software->id }}" class="mt-2 details" style="display: none;">
                            <p id="description-{{ $software->id }}" class="text-1xl description"></p>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
        <!-- Botão de Submissão -->
        <div class="flex justify-center mt-6">
            <button type="submit" class="px-8 py-4 text-2xl text-white transition duration-300 ease-in-out transform rounded-lg shadow-lg concert-one-regular bg-gradient-to-r from-purple-700 via-pink-600 to-rose-600 hover:bg-gradient-to-r hover:from-purple-600 hover:via-pink-500 hover:to-rose-500 hover:scale-105 focus:outline-none focus:ring-4 focus:ring-purple-300 flex items-center" id="submitButton">
                <span id="buttonText">Selecionar Softwares</span>
                <!-- Spinner -->
                <div id="spinner" class="hidden w-6 h-6 ml-2 border-4 border-t-transparent border-white rounded-full animate-spin"></div>
            </button>
        </div>
    </form>
</div>

@endsection
