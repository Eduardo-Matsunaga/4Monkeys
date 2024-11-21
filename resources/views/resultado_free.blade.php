<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Resultados dos Produtos Finais - Visitante</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 text-gray-900">
<div class="container mx-auto py-8">
    <h1 class="text-3xl font-bold mb-8 text-center">Recomendações de Desktops</h1>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @foreach ($desktops as $desktop)
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-2xl font-semibold mb-4">Categoria: {{ ucfirst($desktop['categoria']) }}</h2>

                <h3 class="text-xl font-semibold mt-4 mb-2">Componentes</h3>
                <ul class="list-disc list-inside">
                    @foreach ($desktop['componentes'] as $componente => $nome)
                        <li class="text-lg mb-1">
                            <span class="font-semibold">{{ ucfirst($componente) }}:</span> {{ $nome }}
                        </li>
                    @endforeach
                </ul>
            </div>
        @endforeach
    </div>
</div>
</body>
</html>
