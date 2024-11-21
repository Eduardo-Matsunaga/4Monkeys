@extends('layouts.userpremium')

@section('content premium')

@php
    $icones = [
    'fas fa-microchip',
    'fas fa-video',
    'fas fa-memory',
    'fas fa-thumbs-up',
    'fas fa-video',
    'fas fa-hdd',
    ];
@endphp

<body class="bg-gray-50 p-8 font-sans">

<h1 class="text-4xl font-bold text-gray-800 mb-8 flex items-center space-x-2">
    <i class="fas fa-tachometer-alt text-indigo-600"></i>
    <span>Histórico</span>
</h1>
@if (empty($historico) || count($historico) === 0)
    <!-- Mensagem quando não há histórico -->
    <div class="bg-white border border-gray-300 rounded-lg shadow-md p-4 mb-10 text-center">
        <p class="text-lg font-semibold">Você não possui histórico de setups gerados.</p>
        <a href="{{ route('dashboard') }}" class="bg-purple-600 text-white px-4 py-2 rounded hover:bg-purple-700 mt-4 inline-block">Clique aqui para gerar um Desktop</a>
    </div>
@else
<div class="space-y-6">
    @foreach ($historico as $item)
        <div class="bg-white border border-gray-200 rounded-xl shadow-lg p-6">
            <h2 class="text-2xl font-semibold text-gray-700 border-b pb-2 mb-4">Data: {{ $item['data'] }}</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-4">
                @foreach ($item['conjuntos'] as $conjunto)
                    @php
                        // Remover a palavra "Conjunto" do nome e definir uma cor específica
                        $nomeConjunto = str_replace('Conjunto ', '', $conjunto['nome']);
                        $nomeClasse = match($nomeConjunto) {
                            'Gold' => 'text-yellow-500',
                            'Silver' => 'text-gray-800',
                            'Bronze' => 'text-orange-800',
                            default => 'text-gray-800',
                        };
                    @endphp
                    <div class="bg-gray-100 border border-gray-200 p-6 rounded-lg shadow-md hover:shadow-xl transition-shadow duration-300">
                        <h3 class="text-2xl font-extrabold {{ $nomeClasse }} text-center mb-4">{{ $nomeConjunto }}</h3>
                        <p class="text-lg text-indigo-600 font-semibold text-center mb-4">Total: R$ {{ number_format($conjunto['total'], 2, ',', '.') }}</p>

                        <h4 class="text-md font-semibold text-gray-600 mt-4 mb-2">Softwares:</h4>
                        <ul class="list-disc ml-4 text-gray-700">
                            @foreach ($conjunto['softwares'] as $software)
                                <li class="flex items-center mb-2">
                                    <i class="fas fa-gamepad mr-2 text-purple-500"></i>
                                    <span>{{ $software['nome'] }}</span>
                                </li>
                            @endforeach
                        </ul>

                        <h4 class="text-md font-semibold text-gray-600 mt-4 mb-2">Acesse os produtos:</h4>
                        <ul class="list-none space-y-2">
                            @foreach ($conjunto['produtos'] as $index => $produto)
                                <li class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <i class="{{ $icones[$index % count($icones)] }} mr-3 text-black"></i>
                                        <div>
                                            <span class="text-gray-800 font-medium">{{ $produto['nome'] }}</span>
                                            <p class="text-sm text-black">Valor: R$ {{ number_format($produto['valor'], 2, ',', '.') }}</p>
                                        </div>
                                    </div>
                                    <a href="{{ $produto['url'] }}" target="_blank" class="bg-indigo-500 text-white px-3 py-1 rounded-lg hover:bg-indigo-600 transition-colors duration-200 ml-2">Acessar</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endforeach
            </div>
        </div>
    @endforeach
    @endif
</div>
</body>

@endsection
