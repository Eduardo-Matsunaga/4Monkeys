@extends('layouts.admin')

@section('titulo', 'Avaliacoes')

@section('content')
    <div class="panel-header bg-dark-gradient">
        <div class="page-inner py-5">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                <div>
                    <h2 class="text-dark pb-2 fw-bold">Avaliações</h2>
                    <h5 class="text-dark op-7 mb-2">Gerenciamento de Avaliações</h5>
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
                            <h4 class="card-title">Lista de Avaliações</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="datatablesSimple" class="display table table-striped table-hover">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nome</th>
                                    <th>Nota</th>
                                    <th>Comentário</th>
                                    <th>Criado Em</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>Nome</th>
                                    <th>Nota</th>
                                    <th>Comentário</th>
                                    <th>Criado Em</th>
                                </tr>
                                </tfoot>
                                <tbody>
                                @foreach($avaliacoes as $avaliacao)
                                    <tr>
                                        <td>{{ $avaliacao->id }}</td>
                                        <td>{{ $avaliacao->user->name }}</td>
                                        <td>{{ $avaliacao->rating}}</td>
                                        <td>{{ $avaliacao->comentario}}</td>
                                        <td>{{ $avaliacao->created_at->format('d/m/Y H:i') }}</td>
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
