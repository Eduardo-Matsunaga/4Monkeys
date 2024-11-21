@extends('layouts.admin')

@section('titulo', 'Usuários Premium')

@section('content')
    <div class="panel-header bg-dark-gradient">
        <div class="page-inner py-5">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                <div>
                    <h2 class="text-dark pb-2 fw-bold">Usuários Premium</h2>
                    <h5 class="text-dark op-7 mb-2">Gerenciamento de Usuários Premium</h5>
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
                            <h4 class="card-title">Lista de Usuários Premium</h4>
                            <div>
                                <a href="{{ url('/usuario-premium/create') }}" class="btn btn-primary btn-round">
                                    <i class="fa fa-plus"></i>
                                    Cadastrar Novo Usuário Premium
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="datatablesSimple" class="display table table-striped table-hover">
                                <thead>
                                <tr class="bg-gray-200">
                                    <th class="py-2 px-3">ID</th>
                                    <th class="py-2 px-3">Nome</th>
                                    <th class="py-2 px-3">E-mail</th>
                                    <th class="py-2 px-3">Situação</th>
                                    <th class="py-2 px-3">Criado Em</th>
                                    <th class="py-2 px-3">Atualizado Em</th>
                                    <th class="text-center" style="width: 10%">Ações</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($usuarios as $usuario)
                                    <tr>
                                        <td class="py-2 px-3">{{ $usuario->id }}</td>
                                        <td class="py-2 px-3">{{ $usuario->name }}</td>
                                        <td class="py-2 px-3">{{ $usuario->email }}</td>
                                        <td class="py-2 px-3">{{ $usuario->situacao }}</td>
                                        <td class="py-2 px-3">{{ $usuario->created_at->format('d/m/Y H:i') }}</td>
                                        <td class="py-2 px-3">{{ $usuario->updated_at->format('d/m/Y H:i') }}</td>
                                        <td class="py-2 px-3">
                                            <div class="form-button-action d-flex justify-content-center">
                                                <a href="{{ url("usuario-premium/$usuario->id/edit") }}" class="btn btn-link btn-primary btn-lg mr-2" data-toggle="tooltip" data-original-title="Editar">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <form method="POST" action="{{ url("usuario-premium/$usuario->id") }}" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-link btn-danger btn-lg" data-toggle="tooltip" data-original-title="Excluir" onclick="return confirm('Tem certeza que deseja excluir {{ $usuario->name }}?')">
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
                    <div class="card-footer d-flex justify-content-end">
                        {{ $usuarios->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
