@extends('layouts.admin')

@section('titulo', 'Produtos')

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
                    <h2 class="text-dark pb-2 fw-bold">Hardwares</h2>
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
                        <h4 class="card-title text-center">Editar Produto</h4>
                    </div>
                    <form action="{{ url("/produtos/$produto->id") }}" method="POST" class="user p-4">
                        @method("PUT")
                        @csrf
                        <h1 class="text-xl font-bold mb-4 text-center">Editar Produto</h1>

                        <div class="form-group">
                            <label for="nome" class="block text-sm font-medium text-gray-700">Nome</label>
                            <input type="text" name="nome" id="nome" value="{{ $produto->nome }}" required class="form-control form-control-user">
                        </div>
                        <hr>

                        <div class="form-group">
                            <label for="disponibilidade" class="block text-sm font-medium text-gray-700">Disponibilidade</label>
                            <input type="number" name="disponibilidade" id="disponibilidade" value="{{ $produto->disponibilidade }}" required class="form-control form-control-user">
                        </div>
                        <hr>

                        <h3 class="text-lg font-semibold mb-2">Preço</h3>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="preco_valor" class="block text-sm font-medium text-gray-700">Valor</label>
                                <input type="text" name="preco_valor" id="preco_valor" value="{{ $produto->lojaOnline->valor }}" required class="form-control form-control-user">
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="preco_moeda" class="block text-sm font-medium text-gray-700">Moeda</label>
                                <input type="text" name="preco_moeda" id="preco_moeda" value="{{ $produto->lojaOnline->moeda }}" required class="form-control form-control-user">
                            </div>
                        </div>
                        <hr>

                        <div class="form-group">
                            <label for="urlLojaOnline" class="block text-sm font-medium text-gray-700">URL da Loja Online</label>
                            <input type="text" name="urlLojaOnline" id="urlLojaOnline" value="{{ $produto->lojaOnline->urlLoja }}" required class="form-control form-control-user">
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
