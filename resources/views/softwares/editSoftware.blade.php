@extends('layouts.admin')

@section('titulo', 'Clientes')

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
                    <h2 class="text-dark pb-2 fw-bold">Softwares</h2>
                    <h5 class="text-dark op-7 mb-2">Gerenciamento de Softwares</h5>
                </div>
            </div>
        </div>
    </div>
    <div class="card mb-4"></div>
    <button class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-xs px-3 py-1.5 mb-4 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
        <a href="/softwares">Voltar</a>
    </button>
    <div class="page-inner mt--5">
        <div class="row justify-content-center"> <!-- Linha centralizada -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">Atualização de cadastro de Softwares</h4>

                        </div>
                    </div>
                    <form action="{{ url("/softwares/$software->id") }}" method="POST" enctype="multipart/form-data" class="user p-4">
                        @method("PUT")
                        @csrf
                        <h1 class="text-xl font-bold mb-4 text-center">Editar Software</h1>

                        <div class="form-group">
                            <label for="tipo">Tipo do Software: 1 - Jogo, 2 - Trabalho, 3 - Utilitários</label>
                            <input type="text" name="tipo" id="tipo" value="{{ $software->tipo }}" required class="form-control form-control-user">
                        </div>
                        <hr>

                        <div class="form-group">
                            <label for="nome">Nome</label>
                            <input type="text" name="nome" id="nome" value="{{ $software->nome }}" required class="form-control form-control-user">
                        </div>
                        <hr>

                        <div class="form-group">
                            <label for="descricao">Descrição</label>
                            <input type="text" name="descricao" id="descricao" value="{{ $software->descricao }}" class="form-control form-control-user">
                        </div>
                        <hr>

                        <div class="form-group">
                            <label for="peso">Peso</label>
                            <input type="number" name="peso" id="peso" value="{{ $software->peso }}" class="form-control form-control-user">
                        </div>
                        <hr>

                        <div class="form-group">
                            <label for="software_imagem">Upload da Nova Imagem (opcional)</label>
                            <input type="file" name="software_imagem" id="software_imagem" class="form-control form-control-user">
                        </div>

                        @if($software->imagem)
                            <div class="form-group">
                                <input type="checkbox" name="remover_imagem" id="remover_imagem">
                                <label for="remover_imagem">Remover imagem atual</label>
                            </div>
                        @endif
                        <hr>

                        <h3>Requisitos Mínimos</h3>
                        @foreach(['cpu' => 'CPU', 'gpu' => 'GPU', 'ram' => 'RAM', 'placa_mae' => 'Placa Mãe', 'ssd' => 'SSD', 'cooler' => 'Cooler', 'fonte' => 'Fonte'] as $field => $label)
                            <div class="form-group">
                                <label for="{{ $field }}_min">{{ $label }}</label>
                                <input type="text" name="{{ $field }}_min" id="{{ $field }}_min" value="{{ $requisitos['Minimo'][$field] }}" class="form-control form-control-user" @if(in_array($field, ['cpu', 'gpu', 'ram'])) required @endif>
                            </div>
                        @endforeach
                        <hr>

                        <h3>Requisitos Médios</h3>
                        @foreach(['cpu' => 'CPU', 'gpu' => 'GPU', 'ram' => 'RAM', 'placa_mae' => 'Placa Mãe', 'ssd' => 'SSD', 'cooler' => 'Cooler', 'fonte' => 'Fonte'] as $field => $label)
                            <div class="form-group">
                                <label for="{{ $field }}_med">{{ $label }}</label>
                                <input type="text" name="{{ $field }}_med" id="{{ $field }}_med" value="{{ $requisitos['Medio'][$field] }}" class="form-control form-control-user" @if(in_array($field, ['cpu', 'gpu', 'ram'])) required @endif>
                            </div>
                        @endforeach
                        <hr>

                        <h3>Requisitos Recomendados</h3>
                        @foreach(['cpu' => 'CPU', 'gpu' => 'GPU', 'ram' => 'RAM', 'placa_mae' => 'Placa Mãe', 'ssd' => 'SSD', 'cooler' => 'Cooler', 'fonte' => 'Fonte'] as $field => $label)
                            <div class="form-group">
                                <label for="{{ $field }}_rec">{{ $label }}</label>
                                <input type="text" name="{{ $field }}_rec" id="{{ $field }}_rec" value="{{ $requisitos['Recomendado'][$field] }}" class="form-control form-control-user" @if(in_array($field, ['cpu', 'gpu', 'ram'])) required @endif>
                            </div>
                        @endforeach
                        <hr>

                        <div class="text-center">
                            <button type="submit" class="btn btn-primary btn-user btn-block">
                                Editar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
