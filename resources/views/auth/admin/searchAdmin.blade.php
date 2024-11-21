<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>Busca de Administradores</title>
</head>
<body class="font-sans antialiased dark:bg-black dark:text-white/50">
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4 text-center">Busca de Administradores</h1>

    <div class="mb-4 flex justify-between items-center">
        <form action="{{ url('/create-admin/search') }}" method="GET" class="flex items-center">
            <input type="text" name="search" placeholder="Procurar administrador" class="border rounded-l py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-r focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">Search</button>
        </form>

        <a href="/create-admin/create" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">Cadastrar Novo Admin</a>
    </div>

    <div class="overflow-x-auto">
        @if ($results->count() > 0)
            <table class="min-w-full border border-solid text-sm">
                <thead>
                <tr class="bg-gray-200">
                    <th class="py-2 px-3">ID</th>
                    <th class="py-2 px-3">Nome</th>
                    <th class="py-2 px-3">Email</th>
                    <th class="py-2 px-3">Criado Em</th>
                    <th class="py-2 px-3">Atualizado Em</th>
                    <th class="py-2 px-3">Ações</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($results as $admin)
                    <tr>
                        <td class="py-2 px-3">{{ $admin->id }}</td>
                        <td class="py-2 px-3">{{ $admin->name }}</td>
                        <td class="py-2 px-3">{{ $admin->email }}</td>
                        <td class="py-2 px-3">{{ $admin->created_at }}</td>
                        <td class="py-2 px-3">{{ $admin->updated_at }}</td>
                        <td class="py-2 px-3">
                            <div class="border-blue-600 rounded mb-1">
                                <a href="{{ url("admin/$admin->id/edit") }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">Editar</a>
                            </div>
                            <form method="POST" action="{{ url("create-admin/$admin->id") }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="bg-red-500 hover:bg-red-700 text-white mt-2
                                            font-bold py-2 px-3.5 rounded focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm"
                                        onclick="return confirm('Tem certeza que deseja excluir? {{ $admin->name }} ?')">Excluir</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            <p class="text-center mt-4">Nenhum administrador encontrado.</p>
        @endif
    </div>

    <div class="mt-4">
        {{ $results->appends(['search' => request('search')])->links() }}
    </div>

    <div class="mt-4 flex justify-center">
        <a href="/create-admin" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:ring-2 focus:ring-gray-500 text-sm">Administradores</a>
    </div>
</div>
</body>
</html>
