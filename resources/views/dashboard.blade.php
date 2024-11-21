@extends('layouts.userpremium')

@section('content premium')
    <!-- dashboard.blade.php -->
    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

<div class="flex min-h-screen">
    <div class="flex-1">
        <div class="mt-10">
            <div id="loading-spinner" class="hidden absolute inset-0 flex items-center justify-center bg-opacity-50  z-50">
                <div class="flex flex-col items-center">
                    <div class="w-16 h-16 border-4 border-t-transparent border-purple-500 rounded-full animate-spin"></div>
                    <p class="mt-4 text-2xl text-purple-500">Seu Desktop está sendo gerado...</p>
                </div>
            </div>
            <form id="software-selection-form" action="{{ auth()->check() ? route('home.selecionar') : route('free.selecionar') }}" method="POST" class="relative p-6 bg-white border border-gray-800 rounded-lg shadow" onsubmit="showSpinner(event)">
                @csrf
                <h2 class="mb-6 text-4xl font-bold text-center text-transparent concert-one-regular bg-gradient-to-r from-orange-500 via-pink-400 to-blue-300 bg-clip-text animate-fade-in">
                    Selecionar Softwares
                </h2>
                <div id="software-selection-content" class="flex justify-between space-x-4 min-h-[400px] relative">
                    <!-- Spinner dentro da div dos softwares (oculto inicialmente) -->

                    <!-- Coluna de Jogos -->
                    <div class="flex-1">
                        <h3 class="mb-6 text-4xl font-bold text-center text-transparent concert-one-regular bg-gradient-to-r from-orange-500 via-pink-400 to-blue-300 bg-clip-text animate-fade-in">
                            Jogos
                        </h3>
                        @foreach($softwares as $software)
                            @if($software->tipo == 1)
                                <div id="checkboxDiv{{ $software->id }}" class="flex items-center p-3 mb-4 transition-shadow duration-300 transform bg-transparent border-2 border-purple-700 rounded-lg shadow-none cursor-pointer hover:shadow-lg hover:scale-105" onclick="toggleFillAndDetails({{ $software->id }}, '{{ addslashes($software->descricao) }}')">
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
                                <div id="checkboxDiv{{ $software->id }}" class="flex items-center p-3 mb-4 transition-shadow duration-300 transform bg-transparent border-2 border-purple-700 rounded-lg shadow-none cursor-pointer hover:shadow-lg hover:scale-105" onclick="toggleFillAndDetails({{ $software->id }}, '{{ addslashes($software->descricao) }}')">
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
                                <div id="checkboxDiv{{ $software->id }}" class="flex items-center p-3 mb-4 transition-shadow duration-300 transform bg-transparent border-2 border-purple-700 rounded-lg shadow-none cursor-pointer hover:shadow-lg hover:scale-105" onclick="toggleFillAndDetails({{ $software->id }}, '{{ addslashes($software->descricao) }}')">
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
                <div id="submit-button-container" class="flex justify-center mt-6">
                    <button type="submit" class="px-8 py-4 text-2xl text-white transition duration-300 ease-in-out transform rounded-lg shadow-lg concert-one-regular bg-gradient-to-r from-purple-700 via-pink-600 to-rose-600 hover:bg-gradient-to-r hover:from-purple-600 hover:via-pink-500 hover:to-rose-500 hover:scale-105 focus:outline-none focus:ring-4 focus:ring-purple-300 flex items-center" id="submitButton">
                        <span id="buttonText">Selecionar Softwares</span>
                        <!-- Spinner -->
                        <div id="spinner" class="hidden w-6 h-6 ml-2 border-4 border-t-transparent border-white rounded-full animate-spin"></div>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function showSpinner(event) {
    event.preventDefault(); // Impede o envio imediato do formulário

    // Exibe o spinner
    document.getElementById('loading-spinner').classList.remove('hidden');

    // Esconde o conteúdo do formulário, incluindo o título e a div
    document.getElementById('software-selection-content').classList.add('hidden');
    document.querySelector('.relative').classList.add('hidden'); // Esconde a div do título e do conteúdo

    // Esconde o botão de envio
    document.getElementById('submit-button-container').classList.add('hidden');

    // Envia o formulário após o tempo do spinner (simulação de envio)
    setTimeout(() => {
        event.target.submit(); // Submete o formulário após a animação do spinner
    }, 2000); // Tempo de exibição do spinner em milissegundos
}

</script>

@endsection
