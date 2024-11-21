@extends('layouts.userpremium')

@section('content premium')

@php
    $icones = [
        'fas fa-microchip',  
        'fas fa-video',       
        'fas fa-memory',     
        'fas fa-plug',   
        'fas fa-video',       
        'fas fa-hdd',         
    ];
@endphp

<body class="bg-gray-100 p-6">
    <h1 class="text-3xl mt-4 text-1xl font-bold mb-2 text-center text-transparent concert-one-regular bg-gradient-to-r from-orange-500 via-pink-400 to-blue-300 bg-clip-text animate-fade-in">
         Configurações geradas com base nos Softwares selecionados
    </h1>
    <div class="flex space-x-4 mt-4"> <!-- Flex aplicado aqui para os conjuntos -->
        @foreach ($conjuntos as $conjunto)
            <div class="bg-white border border-gray-300 rounded-lg shadow-md p-4 mb-4 w-1/3"> <!-- Cada conjunto ocupa 1/3 da largura -->
                @php
                    // Definindo a classe de cor baseada na categoria
                    $corCategoria = '';
                    if ($conjunto['categoria'] == 'gold') {
                        $corCategoria = 'text-yellow-500'; // Cor dourada para categoria gold
                    } elseif ($conjunto['categoria'] == 'silver') {
                        $corCategoria = 'text-gray-400'; // Cor prata para categoria prata
                    } elseif ($conjunto['categoria'] == 'bronze') {
                        $corCategoria = 'text-orange-600'; // Cor bronze para categoria bronze
                    }
                @endphp

                <h2 class="text-xl font-bold border-b pb-2 {{ $corCategoria }}">
                    {{ ucfirst($conjunto['categoria']) }}
                </h2>
                <h3 class="text-lg font-bold text-gray-700 mb-4">Total: R$ {{ number_format($conjunto['total'], 2, ',', '.') }}</h3>

                <div class="space-y-4"> <!-- Flex não é necessário aqui, as peças serão empilhadas verticalmente -->
                @foreach ($conjunto['componentes'] as $index => $componente)
                    <div class="flex items-center mb-4">
                        <ul class="list-disc flex-1"> <!-- Flex-1 permite que os itens ocupem o restante do espaço -->
                            <li class="flex items-center mb-2">
                                <!-- Exibindo o ícone -->
                                <span class="mr-2">
                                    <!-- Verificando o ícone a ser mostrado para o componente -->
                                    <i class="{{ $icones[$loop->index % count($icones)] }}"></i>
                                </span>
                                <!-- Nome do componente -->
                                <span class="mr-2">{{ substr($componente['nome'], 0, 47) }}...</span>
                            </li>
                            <p>Preço: R$ {{ number_format($componente['preco'], 2, ',', '.') }}</p>
                        </ul>
                        <!-- Botão fixo à direita -->
                        <a href="{{ $componente['url'] }}" target="_blank" class="bg-purple-600 text-white px-2 py-1 rounded hover:bg-purple-600 ml-auto">
                            Acessar
                        </a>
                    </div>
                @endforeach
                </div>
            </div>
        @endforeach
    </div>
</body>

@endsection
