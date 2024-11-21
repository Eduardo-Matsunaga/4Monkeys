@php use App\Helpers\NumberHelper; @endphp
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultados dos Produtos Finais</title>
    <!-- Adicione o CSS do Tailwind -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 text-gray-900">

<h1 class="text-3xl font-bold mb-8 text-center">Resultados dos Produtos Finais</h1>
<div class="container mx-auto py-8 grid grid-cols-3 gap-4">

    @foreach ($conjuntos as $conjunto)
        <div class="bg-white rounded-lg shadow p-6 mb-6">
            <h2 class="text-2xl font-semibold mb-4">Categoria: {{ ucfirst($conjunto['conjunto']->categoria->nome) }}</h2>
            <p class="text-lg mb-2">
                <span class="font-semibold">Preço Total:</span>
                R$ {{ number_format($conjunto['total'], 2, ',', '.') }}
            </p>

            <h3 class="text-xl font-semibold mt-4 mb-2">Componentes</h3>
            <ul class="list-disc list-inside">
                @foreach ($conjunto['conjunto']->produtos as $produto)
                    <li class="text-lg mb-1">
                        <span class="font-semibold">{{ $produto->nome }}</span>
                    </li>
                    <li class="text-sm text-blue-500 mb-2">
                        <a href="{{ $produto->lojaOnline->urlLoja }}" target="_blank">{{ $produto->lojaOnline->urlLoja }}</a>
                    </li>
                @endforeach
            </ul>
        </div>
    @endforeach

</div>

</body>
</html>
