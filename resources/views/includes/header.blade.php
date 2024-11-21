<!-- resources/views/includes/header.blade.php -->
<header class="bg-blue-600 shadow-md h-20">
    <div class="container mx-auto px-6 py-3 flex justify-between items-center h-full">
        <!-- Logo -->
        <a href="{{ url('/') }}" class="text-2xl font-semibold text-white hover:text-gray-200">
            Administrador
        </a>

        <!-- Navegação -->
        <nav class="flex items-center space-x-6">
            <a href="{{ url('/admin') }}" class="text-white hover:text-gray-200 px-4 py-2 bg-blue-500 rounded-md hover:bg-blue-700">Home</a>
            <a href="{{ url('/softwares') }}" class="text-white hover:text-gray-200 px-4 py-2 bg-blue-500 rounded-md hover:bg-blue-700">Softwares</a>
            <a href="{{ url('/sobre') }}" class="text-white hover:text-gray-200 px-4 py-2 bg-blue-500 rounded-md hover:bg-blue-700">Sobre</a>
            <a href="{{ url('/contato') }}" class="text-white hover:text-gray-200 px-4 py-2 bg-blue-500 rounded-md hover:bg-blue-700">Contato</a>

            <!-- User Dropdown -->
            <div class="relative">
                @if(Auth::check())
                    <button class="flex items-center text-white hover:text-gray-200 px-4 py-2 bg-blue-500 rounded-md hover:bg-blue-700 focus:outline-none">
                        <span>{{ Auth::user()->name }}</span>
                        <svg class="w-5 h-5 ml-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg z-20 hidden group-hover:block">
                        <a href="{{ url('/profile') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Perfil</a>
                        <a href="{{ url('/dashboard') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Dashboard</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100">
                                Sair
                            </button>
                        </form>
                    </div>
                @else
                @endif
            </div>
        </nav>
    </div>
</header>
