@extends('layouts.admin')

@section('titulo', 'Softwares')

@section('content')

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        <br/>
    @endif

    <div class="panel-header bg-dark-gradient">
        <div class="page-inner py-5">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                <div>
                    <h2 class="text-dark pb-2 fw-bold">Lista de Hardwares</h2>
                    <h5 class="text-dark op-7 mb-2">Gerenciamento de Hardwares</h5>
                </div>
            </div>
        </div>
    </div>

    <div class="card mb-4"></div>
    <button class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-xs px-3 py-1.5 mb-4 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
        <a href="/produtos">Voltar</a>
    </button>
    <div class="page-inner mt--5">
        <div class="row justify-content-center"> <!-- Linha centralizada -->
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">Cadastro de Hardwares</h4>
                        </div>
                    </div>

                    <form action="/produtos/" method="POST" enctype="multipart/form-data" class="user p-4">
                        @csrf
                        <div class="form-group">
                            <label for="nome">Nome</label>
                            <input type="text" name="nome" id="nome" required class="form-control form-control-user">
                        </div>
                        <hr>

                        <div class="form-group">
                            <label for="disponibilidade">Disponibilidade</label>
                            <input type="number" name="disponibilidade" id="disponibilidade" required class="form-control form-control-user">
                        </div>
                        <hr>

                        <h3 class="text-lg font-semibold mt-4">Preço</h3>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="preco_valor">Valor</label>
                                <input type="number" name="preco_valor" id="preco_valor" required class="form-control form-control-user">
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="preco_moeda">Moeda</label>
                                <input type="text" name="preco_moeda" id="preco_moeda" required class="form-control form-control-user">
                            </div>
                        </div>
                        <hr>

                        <h3 class="text-lg font-semibold mt-4">Loja Online</h3>
                        <div class="form-group">
                            <label for="urlLojaOnline">URL da Loja Online</label>
                            <input type="text" name="urlLojaOnline" id="urlLojaOnline" required class="form-control form-control-user">
                        </div>
                        <hr>

                        <div class="text-center">
                            <button type="submit" class="btn btn-primary btn-user btn-block">
                                Enviar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
