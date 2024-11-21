@extends('layouts.admin')

@section('titulo', 'Administradores')

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
    <div class="card mb-4">
    </div>   
    <div class="page-inner mt--5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="card-title">Lista de Administradores</h4>
                            <div>
                                
                                <a href="{{ route('create-admin.create') }}" class="btn btn-primary btn-round ml-3">
                                    <i class="fa fa-plus"></i> Cadastrar Novo Admin
                                </a>
                            </div>
                        </div>
                    </div>               
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="datatablesSimple" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nome</th>
                                        <th>Email</th>
                                        <th>Criado Em</th>
                                        <th>Atualizado Em</th>
                                        <th class="text-center" style="width: 10%">Ações</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nome</th>
                                        <th>Email</th>
                                        <th>Criado Em</th>
                                        <th>Atualizado Em</th>
                                        <th class="text-center" style="width: 10%">Ações</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @foreach($admins as $admin)
                                        <tr>
                                            <td>{{ $admin->id }}</td>
                                            <td>{{ $admin->name }}</td>
                                            <td>{{ $admin->email }}</td>
                                            <td>{{ $admin->created_at->format('d/m/Y H:i') }}</td>
                                            <td>{{ $admin->updated_at->format('d/m/Y H:i') }}</td>
                                            <td class="text-center">
                                                <div class="form-button-action">
                                                    <a href="{{ route('create-admin.edit', $admin->id) }}" class="btn btn-link btn-primary btn-lg" data-toggle="tooltip" data-original-title="Editar">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <form action="{{ route('create-admin.destroy', $admin->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-link btn-danger btn-lg" data-toggle="tooltip" data-original-title="Excluir" onclick="return confirm('Tem certeza que deseja excluir {{ $admin->name }}?')">
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
