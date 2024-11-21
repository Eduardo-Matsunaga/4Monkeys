@extends('layouts.admin')

@section('titulo', 'Criar Usuário Premium')

@section('content')

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="panel-header bg-dark-gradient">
        <div class="page-inner py-5">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                <div>
                    <h2 class="text-dark pb-2 fw-bold">Criar Usuário Premium</h2>
                    <h5 class="text-dark op-7 mb-2">Formulário para criar um novo usuário premium</h5>
                </div>
            </div>
        </div>
    </div>
    <div class="card mb-4"></div>
    <button class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-xs px-3 py-1.5 mb-4 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
        <a href="/usuario-premium">Voltar</a>
    </button>
    <div class="page-inner mt--5">
        <div class="row">
            <div class="col-md-5 mx-auto">
                <div class="card">

                    <div class="d-flex align-items-center">
                        <h4 class="card-title">Criar Conta de Usuário Premium</h4>
                    </div>
                    <form method="POST" action="/usuario-premium" class="user p-4">
                        @csrf

                        <div class="form-group">
                            <input type="text" class="form-control form-control-user" id="nome" name="nome" required placeholder="Nome" value="{{ old('nome') }}">
                            @error('nome')
                            <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>
                        <hr>

                        <div class="form-group">
                            <input type="email" class="form-control form-control-user" id="email" name="email" required placeholder="E-mail" value="{{ old('email') }}">
                            @error('email')
                            <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>
                        <hr>

                        <div class="form-group">
                            <input type="number" class="form-control form-control-user" id="situacao" name="situacao" required placeholder="Situação" value="{{ old('situacao') }}">
                            @error('situacao')
                            <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>
                        <hr>

                        <div class="form-group">
                            <input type="password" class="form-control form-control-user" id="password" name="password" required placeholder="Senha">
                            @error('password')
                            <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>
                        <hr>

                        <div class="form-group">
                            <input type="password" class="form-control form-control-user" id="password_confirmation" name="password_confirmation" required placeholder="Confirme a Senha">
                        </div>
                        <hr>

                        <div class="text-center">
                            <button type="submit" class="btn btn-primary btn-user btn-block">
                                Registrar
                            </button>
                        </div>
                        <hr>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
