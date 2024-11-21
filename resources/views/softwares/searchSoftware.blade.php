@extends('layouts.appSoftware')

@section('title', 'Lista de Softwares')

@section('content')

<div class="p-4 bg-white rounded-lg shadow-md">
    <h1 class="text-xl font-bold mb-4">Busca</h1>
    <div class="mb-4">
        <a href="/softwares/create" class="text-blue-500 hover:underline">Cadastrar Novo Software</a>
        <br>
        <br>
        <button class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
            <a href="/softwares" class="text-white">Home</a>
        </button>
    </div>

    <form action="{{ url('softwares/search') }}" method="GET" class="mb-4">
        <input type="text" name="search" placeholder="Procurar Software" class="border border-gray-300 p-2 w-full rounded">
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Search</button>
    </form>

    @if ($results->count() > 0)
        <table class="min-w-full border-collapse border border-gray-200">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border border-gray-200 px-4 py-2">ID</th>
                    <th class="border border-gray-200 px-4 py-2">Tipo</th>
                    <th class="border border-gray-200 px-4 py-2">Nome</th>
                    <th class="border border-gray-200 px-4 py-2">Descrição</th>
                    <th class="border border-gray-200 px-4 py-2">Requisitos</th>
                    <th class="border border-gray-200 px-4 py-2">Criado Em</th>
                    <th class="border border-gray-200 px-4 py-2">Ações</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($results as $software)
                <tr>
                    <td class="border border-gray-200 px-4 py-2">{{ $software->id }}</td>
                    <td class="border border-gray-200 px-4 py-2">{{ $software->tipo }}</td>
                    <td class="border border-gray-200 px-4 py-2">{{ $software->nome }}</td>
                    <td class="border border-gray-200 px-4 py-2">{{ $software->descricao }}</td>
                    <td class="border border-gray-200 px-4 py-2">{{ $software->requisitos }}</td>
                    <td class="border border-gray-200 px-4 py-2">{{ $software->created_at }}</td>
                    <td class="border border-gray-200 px-4 py-2">
                        <a href="{{ url("softwares/$software->id/edit") }}" class="text-blue-500 hover:underline">Editar</a>
                        <br>
                        <form method="POST" action="{{url("softwares/$software->id")}}" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Tem certeza que deseja excluir? {{$software->nome}} ?')" class="text-red-500 hover:underline">Excluir</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @else
        <p class="text-red-500 mt-4">Nenhum software encontrado.</p>
    @endif
</div>

</body>
@endsection
