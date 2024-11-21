@extends('layouts.userfree')

@section('content free')

<body class="bg-gray-100 p-6 flex flex-col min-h-screen">

    <!-- Conteúdo principal -->
    <div class="container mx-auto p-4 flex-1">
        <h1 class="text-1xl font-bold mb-4 text-center text-transparent concert-one-regular bg-gradient-to-r from-orange-500 via-pink-400 to-blue-300 bg-clip-text animate-fade-in">
            Requisitos dos Softwares
        </h1>
    
        <!-- Exibir os requisitos -->
        <div class="flex space-x-6">
            @foreach (['Minimo', 'Medio', 'Recomendado'] as $nivel)
                @if (isset($requisitos[$nivel]) && count($requisitos[$nivel]) > 0)
                    <div class="bg-white p-4 border rounded-lg shadow-md flex-1">
                        <h3 class="border-b pb-2 mb-6 text-4xl font-bold text-center text-transparent concert-one-regular bg-gradient-to-r from-orange-500 via-pink-400 to-blue-300 bg-clip-text animate-fade-in">
                            Requisitos {{ $nivel }}
                        </h3>
                        <div class="space-y-4">
                            @foreach ($requisitos[$nivel] as $requisito)
                                <ul>
                                    <li><strong>CPU:</strong> {{ $requisito['cpu'] }}</li>
                                    <li><strong>GPU:</strong> {{ $requisito['gpu'] }}</li>
                                    <li><strong>RAM:</strong> {{ $requisito['ram'] }}</li>
                                    <li><strong>Placa Mãe:</strong> {{ $requisito['placa_mae'] }}</li>
                                    <li><strong>SSD:</strong> {{ $requisito['ssd'] }}</li>
                                    <li><strong>Cooler:</strong> {{ $requisito['cooler'] }}</li>
                                    <li><strong>Fonte:</strong> {{ $requisito['fonte'] }}</li>
                                </ul>
                            @endforeach
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>

    
</body>

@endsection
