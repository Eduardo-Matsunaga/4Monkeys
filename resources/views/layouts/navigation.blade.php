<nav x-data="{ open: false }" class="bg-zinc-900  border-b border-zinc-400 text-white">
    <!-- Primary Navigation Menu -->
    <div class="max-w-8xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center text-white">
                    <a href="{{ route('dashboard') }}">
                    <text>FOR MONKEYS SETUP</text>
                    </a>
                </div>

            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6 bg-purple-700 rounded-sm">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-zinc-150 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>
                            <img src="{{ asset('images/opcoes (1).png') }}" alt="Descrição da imagem" class="w-8 h-8 object-cover ">
                        </button>
                        
                    </x-slot>
                    <x-slot name="content" >
                        
                        <x-dropdown-link :href="route('profile.edit')" >
                            {{ __('Meu Perfil') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                         
                        <x-dropdown-link :href="route('logout')" 
                            onclick="event.preventDefault();
                                        this.closest('form').submit();" class="flex items-center">
                            <span>{{ __('Sair') }}</span>
                            <img src="{{ asset('images/esboco-de-logout.png') }}" alt="Descrição da imagem" class="w-6 h-6 object-cover ml-[115px]">
                        </x-dropdown-link>
                        </form>
                    </x-slot>
                    </div>
                </x-dropdown>
            </div>   
        </div>
    </div>
</nav>
