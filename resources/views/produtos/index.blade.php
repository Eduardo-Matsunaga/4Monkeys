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
                    <h2 class="text-dark pb-2 fw-bold">Lista de Hardwares</h2>
                    <h5 class="text-dark op-7 mb-2">Gerenciamento de Hardwares</h5>
                </div>
            </div>
        </div>
    </div>
    <div class="card mb-4">
    </div> 

    <div class="page-inner mt--5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="card-title">Lista de Produtos</h4>
                            <a href="{{ route('produtos.create') }}" class="btn btn-primary btn-round ml-auto">
                                <i class="fa fa-plus"></i>
                                Cadastrar Novo Produto
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="datatablesSimple" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nome</th>
                                        <th>Valor</th>
                                        <th>Moeda</th>
                                        <th>URL Loja Online</th>
                                        <th>Disponibilidade</th>
                                        <th>Criado Em</th>
                                        <th>Atualizado Em</th>
                                        <th class="text-center" style="width: 10%">Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($produtos as $produto)
                                        <tr>
                                            <td>{{ $produto->id }}</td>
                                            <td>{{ $produto->nome }}</td>
                                            <td>{{ $produto->lojaOnline->valor }}</td>
                                            <td>{{ $produto->lojaOnline->moeda }}</td>
                                            <td class="max-w-xs truncate">{{ $produto->lojaOnline->urlLoja }}</td>
                                            <td>{{ $produto->disponibilidade }}</td>
                                            <td>{{ $produto->created_at->format('d/m/Y H:i') }}</td>
                                            <td>{{ $produto->updated_at->format('d/m/Y H:i') }}</td>
                                            <td class="text-center">
                                                <div class="form-button-action">
                                                    <a href="{{ route('produtos.edit', $produto->id) }}" class="btn btn-link btn-primary btn-lg"
                                                    data-toggle="tooltip" data-original-title="Editar"
                                                    >
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <form method="POST" action="{{ route('produtos.destroy', $produto->id) }}" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-link btn-danger btn-lg" onclick="return confirm('Tem certeza que deseja excluir {{ $produto->nome }}?')">
                                                            <i class="fa fa-times"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
