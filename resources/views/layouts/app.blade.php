<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JP-Jardines - Diseño de Jardines con Inteligencia Artificial</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        html {
            scroll-behavior: smooth;
        }
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="text-gray-800" style="
    background: 
        linear-gradient(rgba(255, 255, 255, 0.2), rgba(255, 255, 255, 0.2)),
        url('{{ asset('images/fondojardin.png') }}');
    background-size: cover; 
    background-attachment: fixed; 
    background-position: center; 
    background-repeat: no-repeat;">

    <header class="w-full bg-white/70 backdrop-blur-sm shadow-md z-50">
        <div class="container mx-auto p-3">
            <div class="flex flex-col md:flex-row md:justify-between md:items-center text-center md:text-left">
                
                <div class="flex items-center justify-center md:justify-start gap-3 mb-4 md:mb-0">
                    <div class="p-2 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-emerald-500" viewBox="0 0 20 20" fill="currentColor"><path d="M10 3.5a1.5 1.5 0 013 0V4a1 1 0 001 1h3a1 1 0 011 1v3a1 1 0 01-1 1h-.5a1.5 1.5 0 000 3h.5a1 1 0 011 1v3a1 1 0 01-1 1h-3a1 1 0 01-1-1v-.5a1.5 1.5 0 00-3 0v.5a1 1 0 01-1 1H6a1 1 0 01-1-1v-3a1 1 0 00-1-1h-.5a1.5 1.5 0 010-3H4a1 1 0 001-1V6a1 1 0 011-1h3a1 1 0 001-1v-.5z" /></svg>
                    </div>
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900">JP<span class="text-emerald-500">Jardines</span></h1>
                        <p class="text-sm text-gray-600 hidden md:block">Transforma tus espacios con la ayuda de la Inteligencia Artificial.</p>
                    </div>
                </div>

                <nav>
                    <ul class="flex justify-center gap-6 md:gap-8">
                        <li><a href="{{ url('/#designer') }}" class="text-gray-600 hover:text-emerald-500 font-medium transition">Diseñador AI</a></li>
                        <li><a href="{{ url('/#catalog') }}" class="text-gray-600 hover:text-emerald-500 font-medium transition">Catálogo</a></li>
                        <li><a href="{{ url('/#contact') }}" class="text-gray-600 hover:text-emerald-500 font-medium transition">Contacto</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>

    <div class="container mx-auto p-4 md:p-8">
        <main>
            @yield('content')
        </main>

        <footer class="text-center mt-8 md:mt-12 p-4">
            <p class="text-gray-600">&copy; {{ date('Y') }} JP Jardines. Todos los derechos reservados.</p>
        </footer>
    </div>

    @stack('scripts')
</body>
</html>