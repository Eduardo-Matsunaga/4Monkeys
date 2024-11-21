@extends('layouts.admin')

@section('titulo', 'Editar Usuário')

@section('content')

    <div class="container mx-auto p-4">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <button class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-xs px-3 py-1.5 mb-4 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
            <a href="/usuario-premium">Voltar</a>
        </button>

        <div class="page-inner mt--5">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header text-center">
                            <h4 class="card-title">Editar Usuário</h4>
                        </div>
                        <form action="{{ url("/usuario-premium/$usuarios->id") }}" method="POST" class="user p-4">
                            @method("PUT")
                            @csrf
                            <h1 class="text-xl font-bold mb-4 text-center">Editar Usuário</h1>

                            <div class="form-group mb-4">
                                <label for="nome" class="block text-sm font-medium text-gray-700">Nome</label>
                                <input type="text" name="nome" id="nome" value="{{ $usuarios->name }}" required class="form-control form-control-user">
                            </div>

                            <div class="form-group mb-4">
                                <label for="email" class="block text-sm font-medium text-gray-700">E-mail</label>
                                <input type="email" name="email" id="email" value="{{ $usuarios->email }}" required class="form-control form-control-user">
                            </div>

                            <div class="form-group mb-4">
                                <label for="situacao" class="block text-sm font-medium text-gray-700">Situação</label>
                                <input type="text" name="situacao" id="situacao" value="{{ $usuarios->situacao }}" required class="form-control form-control-user">
                            </div>

                            <div class="form-group mb-4">
                                <label for="password" class="block text-sm font-medium text-gray-700">Senha</label>
                                <input type="password" name="password" id="password" required class="form-control form-control-user" placeholder="Deixe vazio para manter a senha atual">
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-primary btn-user btn-block">
                                    Editar
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
