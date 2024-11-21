@extends('layouts.admin')

@section('content')
           
<div class="container-fluid px-4">
    <h1 class="mt-4">Tables</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{url('dashboard-admin')}}">Dashboard</a></li>
        <li class="breadcrumb-item active">Tables</li>
    </ol>
    <div class="card mb-4">
    </div>
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Tabela de Logs 
        </div>
        <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th>ID do usuario</th>
                        <th>Descrição</th>
                        <th>operação</th>
                        <th>Data Criação</th>
                        <th>Data Alteração</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>ID do usuario</th>
                        <th>Descrição</th>
                        <th>operação</th>
                        <th>Data Criação</th>
                        <th>Data Alteração</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach($custom_log as $custom_logs) 

                    <tr>
                        <td>{{ $custom_logs->admin_id }}</td>
                        <td>{{ $custom_logs->descricao }}</td>
                        <td>{{ $custom_logs->operacao }}</td>
                        <td>{{ $custom_logs->created_at }}</td>
                        <td>{{ $custom_logs->updated_at }}</td> 
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-header">
        <a href="{{ route('logs.export') }}" class="btn btn-success float-end">
            Exportar CSV
        </a>
    </div>
</div>

@endsection
