<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proyectos PA/PIA - @yield('title')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    @stack('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-50 font-roboto text-gray-800">
    <!-- Barra de navegación -->
    <nav class="bg-indigo-800 text-white shadow-lg">
        <div class="container mx-auto px-4 py-3 flex justify-between items-center">
            <a href="{{ route('dashboard') }}" class="text-xl font-bold flex items-center">
                <i class="fas fa-project-diagram mr-2"></i>
                Gestionador de Proyectos
            </a>
            
            <div class="flex items-center space-x-4">
                @auth
                    <!-- Menú desplegable usuario -->
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" class="flex items-center space-x-2 focus:outline-none">
                            <div class="w-8 h-8 rounded-full bg-indigo-600 flex items-center justify-center">
                                <i class="fas fa-user text-white"></i>
                            </div>
                            <span class="hidden md:inline">{{ Auth::user()->username }}</span>
                            <i class="fas fa-chevron-down text-xs transition-transform duration-200" :class="{ 'transform rotate-180': open }"></i>
                        </button>
                        
                        <!-- Dropdown menu -->
                        <div x-show="open" @click.away="open = false" 
                             x-transition:enter="transition ease-out duration-100"
                             x-transition:enter-start="opacity-0 scale-95"
                             x-transition:enter-end="opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-75"
                             x-transition:leave-start="opacity-100 scale-100"
                             x-transition:leave-end="opacity-0 scale-95"
                             class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50">
                            <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                <i class="fas fa-user-circle mr-2 text-indigo-600"></i> Mi Perfil
                            </a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full text-left block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    <i class="fas fa-sign-out-alt mr-2 text-red-500"></i> Cerrar Sesión
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="hover:bg-indigo-700 px-3 py-2 rounded transition">
                        <i class="fas fa-sign-in-alt mr-1"></i> Iniciar Sesión
                    </a>
                    <a href="{{ route('register') }}" class="bg-white text-indigo-800 hover:bg-gray-200 px-3 py-2 rounded font-medium transition">
                        <i class="fas fa-user-plus mr-1"></i> Registrarse
                    </a>
                @endauth
            </div>
        </div>
    </nav>

    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4" role="alert">
            <div class="flex items-center">
                <div class="py-1">
                    <i class="fas fa-check-circle text-green-500 mr-3"></i>
                </div>
                <div>
                    <p class="font-bold">Éxito</p>
                    <p>{{ session('success') }}</p>
                </div>
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4" role="alert">
            <div class="flex items-center">
                <div class="py-1">
                    <i class="fas fa-exclamation-circle text-red-500 mr-3"></i>
                </div>
                <div>
                    <p class="font-bold">Error</p>
                    <p>{{ session('error') }}</p>
                </div>
            </div>
        </div>
    @endif

    <!-- Contenido principal -->
    <main class="container mx-auto px-4 py-8">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-6 mt-12">
        <div class="container mx-auto px-4 text-center">
            <p>© {{ date('Y') }} Sistema de Gestión de Proyectos PA/PIA</p>
        </div>
    </footer>

    <!-- Alpine JS para interactividad -->
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.2/dist/alpine.min.js" defer></script>
    @stack('scripts')
</body>
</html>