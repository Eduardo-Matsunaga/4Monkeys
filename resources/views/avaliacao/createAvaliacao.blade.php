@extends('layouts.userpremium')

@section('content premium')


    <body></body>
    <div class="flex min-h-screen flex-col">

        <div class="flex-grow">
            <div class="bg-white rounded p-2 mt-3">
                <div class="">
                    <!-- Conteúdo Principal -->
                    <div class="flex-grow">
                        <h5 class="text-2xl font-semibold mb-4">Avaliar</h5>

                        <form action="{{ route('avaliar.store') }}" method="POST" class="space-y-4">
                            @csrf

                            <!-- Rating Section -->
                            <div class="flex items-center space-x-2">
                                <div id="rating" class="flex">
                                    @for($i = 1; $i <= 5; $i++)
                                        <!-- Radio buttons (hidden, but still functional) -->
                                        <input type="radio" id="star{{ $i }}" name="rating" value="{{ $i }}" class="hidden star-radio">

                                        <!-- Labels styled as stars -->
                                        <label for="star{{ $i }}" title="{{ $i }} estrela{{ $i > 1 ? 's' : '' }}"
                                               class="cursor-pointer text-4xl text-gray-400 hover:text-yellow-400 transition-colors star-label"
                                               data-index="{{ $i }}">
                                            &#9733;
                                        </label>
                                    @endfor
                                </div>
                            </div>

                            <!-- Comentário Section -->
                            <div>
                                <label for="comentario" class="block text-lg font-medium text-gray-700">Comentário (opcional)</label>
                                <textarea name="comentario" id="comentario" rows="4" class="mt-2 p-3 w-full border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-400 transition-colors" placeholder="Escreva aqui seu comentário..."></textarea>
                            </div>

                            <!-- Submit Button -->
                            <button type="submit" class="w-full py-2 px-4 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition-colors">Enviar Avaliação</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection
