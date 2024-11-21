@extends('layouts.admin')

@section('content')
           
<div class="container-fluid px-4">
    <h1 class="mt-4">Administrar Robô</h1>
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
                        <th>URL </th>
                        <th>Página</th>
                        <th>Mensagem</th>
                        <th>Log</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>URL </th>
                        <th>Página</th>
                        <th>Mensagem </th>
                        <th>Log</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach($log_scraper as $log_scrapers) 

                    <tr>
                        <td><a href="{{ $log_scrapers->url }}" target="_blank">{{ $log_scrapers->url }}</a></td>
                        <td>{{ $log_scrapers->pagina }}</td>
                        <td>{{ $log_scrapers->mensagem }}</td>
                        <td>{{ $log_scrapers->created_at }}</td>
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
