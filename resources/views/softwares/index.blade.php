@extends('layouts.admin')

@section('titulo', 'Softwares')

@section('content')
    <div class="panel-header bg-dark-gradient">
        <div class="page-inner py-5">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                <div>
                    <h2 class="text-dark pb-2 fw-bold">Softwares</h2>
                    <h5 class="text-dark op-7 mb-2">Gerenciamento de Softwares</h5>
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
                            <h4 class="card-title">Lista de Softwares</h4>
                            <div>
                                <a href="{{ route('softwares.create') }}" class="btn btn-primary btn-round">
                                    <i class="fa fa-plus"></i>
                                    Cadastrar Novo Software
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
                                        <th>Tipo</th>
                                        <th>Nome</th>
                                        <th>Descrição</th>
                                        <th>Peso</th>
                                        <th>Imagem</th>
                                        <th>Criado Em</th>
                                        <th class="text-center" style="width: 10%">Ações</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>ID</th>
                                        <th>Tipo</th>
                                        <th>Nome</th>
                                        <th>Descrição</th>
                                        <th>Peso</th>
                                        <th>Imagem</th>
                                        <th>Criado Em</th>
                                        <th class="text-center" style="width: 10%">Ações</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    
                                    @foreach($softwares as $software)
                                        <tr>
                                            <td>{{ $software->id }}</td>
                                            <td>{{ $software->tipo }}</td>
                                            <td>{{ $software->nome }}</td>
                                            <td>{{ $software->descricao }}</td>
                                            <td>{{ $software->peso }}</td>
                                            <td>
                                                @if($software->imagem)
                                                    <img src="{{ asset('storage/' . $software->imagem) }}" alt="Imagem do Software" width="100">
                                                @else
                                                    <span>Sem imagem</span>
                                                @endif
                                            </td>
                                            <td>{{ $software->created_at->format('d/m/Y H:i') }}</td>
                                            <td>
                                                <div class="form-button-action">
                                                    <a href="{{ route('softwares.edit', $software->id) }}"
                                                       class="btn btn-link btn-primary btn-lg"
                                                       data-toggle="tooltip" data-original-title="Editar">
                                                       <i class="fa fa-edit"></i>
                                                    </a>
                                                    <form action="{{ route('softwares.destroy', $software->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-link btn-danger btn-lg "
                                                                data-toggle="tooltip" data-original-title="Excluir"
                                                                onclick="return confirm('Tem certeza que deseja excluir {{ $software->nome }}?')">
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