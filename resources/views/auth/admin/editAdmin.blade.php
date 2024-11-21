@extends('layouts.admin')

@section('titulo', 'Editar Administrador')

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
            <a href="/create-admin">Voltar</a>
        </button>

        <div class="page-inner mt--5">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header text-center">
                            <h4 class="card-title">Editar Administrador</h4>
                        </div>
                        <form action="{{ url("/create-admin/$admin->id") }}" method="POST" class="user p-4">
                            @method("PUT")
                            @csrf
                            <h1 class="text-xl font-bold mb-4 text-center">Editar Administrador</h1>

                            <div class="form-group mb-4">
                                <label for="name" class="block text-sm font-medium text-gray-700">Nome</label>
                                <input type="text" name="name" id="name" value="{{ $admin->name }}" required class="form-control form-control-user">
                            </div>

                            <div class="form-group mb-4">
                                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                                <input type="email" name="email" id="email" value="{{ $admin->email }}" required class="form-control form-control-user">
                            </div>

                            <div class="form-group mb-4">
                                <label for="password" class="block text-sm font-medium text-gray-700">Nova Senha</label>
                                <input type="password" name="password" id="password" class="form-control form-control-user" placeholder="Deixe vazio para manter a senha atual">
                            </div>

                            <div class="form-group mb-4">
                                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirmar Nova Senha</label>
                                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control form-control-user">
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
