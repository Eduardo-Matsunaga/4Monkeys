@extends('layouts.admin')

@section('titulo', 'Softwares')

@section('content')

    <div class="panel-header bg-dark-gradient">
        <div class="page-inner py-5">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                <div>
                    <h2 class="text-dark pb-2 fw-bold">Administradores</h2>
                    <h5 class="text-dark op-7 mb-2">Gerenciamento de Administradores</h5>
                </div>
            </div>
        </div>
    </div>
    <div class="card mb-4"></div>
    <button class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-xs px-3 py-1.5 mb-4 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
        <a href="/create-admin">Voltar</a>
    </button>
    <div class="page-inner mt--5">
        <div class="row justify-content-center"> <!-- Linha centralizada -->
            <div class="col-md-5">
                <div class="card">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">Criar Conta de Administrador</h4>
                    </div>
                    <form method="POST" action="/create-admin" class="user p-4">
                        @csrf
                        <div class="form-group">
                            <input type="text" class="form-control form-control-user" id="name" name="name" required placeholder="Nome">
                        </div>
                        <hr>
                        <div class="form-group">
                            <input type="email" class="form-control form-control-user" id="email" name="email" required placeholder="Email">
                        </div>
                        <hr>
                        <div class="form-group">
                            <input type="password" class="form-control form-control-user" id="password" name="password" required placeholder="Senha">
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
