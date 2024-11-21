@extends('layouts.admin')

@section('content')

    <h1 class="mt-4">Dashboard</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard</li>
    </ol>
    <div class="row">
        <div class="col-xl-3 col-md-6">
            <div class="card bg-primary text-white mb-4">
                <div class="card-body text-black">Administradores: {{ $adminCount }}</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-warning text-white mb-4">
                <div class="card-body text-black">Usuários Registrados: {{ $userCount }}</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-success text-white mb-4">
                <div class="card-body text-black">Conjuntos Criados: {{ $createConjuntoCount }}</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-danger text-white mb-4">
                <div class="card-body text-black">Erros Registrados: {{ $errorCount }}</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-xl-6">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-chart-area me-1"></i>
                    Desktops gerados por dia
                </div>
                <div class="card-body"><canvas id="myAreaChart" width="100%" height="40"></canvas></div>
            </div>
        </div>
        <div class="col-xl-6">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-chart-bar me-1"></i>
                    Receita de usuarios por mês
                </div>
                <div class="card-body"><canvas id="myBarChart" width="100%" height="40"></canvas></div>
            </div>
        </div>
    </div>
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between">
            <div>
                <i class="fas fa-table me-1"></i>
                Tabela de Logs Gemini
            </div>
            <a href="{{ route('logs.export') }}" class="btn btn-sm btn-primary">Exportar CSV</a>
        </div>
        <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                <tr>
                    <th>ID do Usuário</th>
                    <th>Descrição</th>
                    <th>Operação</th>
                    <th>Status</th>
                    <th>Data Criação</th>
                    <th>Data Alteração</th>
                </tr>
                </thead>
                <tfoot>
                <tr>
                    <th>ID do Usuário</th>
                    <th>Descrição</th>
                    <th>Operação</th>
                    <th>Status</th>
                    <th>Data Criação</th>
                    <th>Data Alteração</th>
                </tr>
                </tfoot>
                <tbody>
                @foreach ($logs as $log)
                    <tr>
                        <td>{{ $log->user_id }}</td>
                        <td>{{ $log->descricao }}</td>
                        <td>{{ $log->operacao }}</td>
                        <td>{{ $log->status }}</td>
                        <td>{{ $log->created_at ? $log->created_at->format('d/m/Y H:i') : '-' }}</td>
                        <td>{{ $log->updated_at ? $log->updated_at->format('d/m/Y H:i') : '-' }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
@endsection
