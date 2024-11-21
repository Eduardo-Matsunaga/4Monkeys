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
                <h2 class="text-dark pb-2 fw-bold">Criar Usuário Premium</h2>
                <h5 class="text-dark op-7 mb-2">Formulário para criar um novo usuário premium</h5>
            </div>
        </div>
    </div>
</div>
<div class="card mb-4">
</div>
<button class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-xs px-3 py-1.5 mb-4 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
    <a href="/softwares">Voltar</a>
</button>
<div class="page-inner mt--5">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title text-center">Cadastro de Softwares</h4>
                </div>
                <div class="card-body">
                    <form action="/softwares" method="POST" enctype="multipart/form-data" class="space-y-4">
                        @csrf
                        <h1 class="text-xl font-bold mb-4 ml-4">Adicionar Software</h1>

                        <div class="form-group">
                            <label for="tipo">Tipo do Software: 1 - Jogo, 2 - Trabalho, 3 - Utilitários</label>
                            <input class="form-control" type="text" name="tipo" id="tipo" required>
                        </div>

                        <div class="form-group">
                            <label for="nome">Nome</label>
                            <input class="form-control" type="text" name="nome" id="nome" required>
                        </div>

                        <div class="form-group">
                            <label for="descricao">Descrição</label>
                            <input class="form-control" type="text" name="descricao" id="descricao">
                        </div>

                        <div class="form-group">
                            <label for="peso">Peso</label>
                            <input class="form-control" type="number" name="peso" id="peso">
                        </div>

                        <div class="form-group">
                            <label for="software_imagem">Upload de Imagem</label>
                            <input class="form-control" type="file" name="software_imagem" id="software_imagem" required>
                            @error('software_imagem')
                            <div class="text-sm text-red-400">{{ $message }}</div>
                            @enderror
                        </div>

                        <h3>Requisitos Mínimos</h3>
                        @foreach(['cpu_min' => 'CPU', 'gpu_min' => 'GPU', 'ram_min' => 'RAM', 'placa_mae_min' => 'Placa Mãe', 'ssd_min' => 'SSD', 'cooler_min' => 'Cooler', 'fonte_min' => 'Fonte'] as $field => $label)
                            <div class="form-group">
                                <label for="{{ $field }}">{{ $label }}</label>
                                <input class="form-control" type="text" name="{{ $field }}" id="{{ $field }}" @if(in_array($field, ['cpu_min', 'gpu_min', 'ram_min'])) required @endif>
                            </div>
                        @endforeach

                        <h3>Requisitos Médios</h3>
                        @foreach(['cpu_med' => 'CPU', 'gpu_med' => 'GPU', 'ram_med' => 'RAM', 'placa_mae_med' => 'Placa Mãe', 'ssd_med' => 'SSD', 'cooler_med' => 'Cooler', 'fonte_med' => 'Fonte'] as $field => $label)
                            <div class="form-group">
                                <label for="{{ $field }}">{{ $label }}</label>
                                <input class="form-control" type="text" name="{{ $field }}" id="{{ $field }}" @if(in_array($field, ['cpu_med', 'gpu_med', 'ram_med'])) required @endif>
                            </div>
                        @endforeach

                        <h3>Requisitos Recomendados</h3>
                        @foreach(['cpu_rec' => 'CPU', 'gpu_rec' => 'GPU', 'ram_rec' => 'RAM', 'placa_mae_rec' => 'Placa Mãe', 'ssd_rec' => 'SSD', 'cooler_rec' => 'Cooler', 'fonte_rec' => 'Fonte'] as $field => $label)
                            <div class="form-group">
                                <label for="{{ $field }}">{{ $label }}</label>
                                <input class="form-control" type="text" name="{{ $field }}" id="{{ $field }}" @if(in_array($field, ['cpu_rec', 'gpu_rec', 'ram_rec'])) required @endif>
                            </div>
                        @endforeach

                        <div class="form-group text-center">
                            <input type="submit" value="Enviar" class="btn btn-primary">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
