<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VerdeAI - Diseño de Jardines con Inteligencia Artificial</title>
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
        .gradient-bg {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        }
        /* Puedes añadir aquí estilos globales que se apliquen a todo el sitio */
    </style>
</head>
<body class="gradient-bg text-gray-800">

    <!-- El header ahora es un elemento principal, es "sticky" y ocupa todo el ancho -->
    <header class="sticky top-0 z-50 w-full bg-white/95 backdrop-blur-sm shadow-md">
        <!-- Contenedor interno para mantener el contenido centrado y hacerlo más delgado -->
        <div class="container mx-auto p-3">
            <!-- Flex container for a horizontal layout on medium screens and up -->
            <div class="flex flex-col md:flex-row md:justify-between md:items-center text-center md:text-left">
                
                <!-- Parte izquierda: Logo y Título -->
                <div class="flex items-center justify-center md:justify-start gap-3 mb-4 md:mb-0">
                    <div class="p-2 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-emerald-500" viewBox="0 0 20 20" fill="currentColor">
                          <path d="M10 3.5a1.5 1.5 0 013 0V4a1 1 0 001 1h3a1 1 0 011 1v3a1 1 0 01-1 1h-.5a1.5 1.5 0 000 3h.5a1 1 0 011 1v3a1 1 0 01-1 1h-3a1 1 0 01-1-1v-.5a1.5 1.5 0 00-3 0v.5a1 1 0 01-1 1H6a1 1 0 01-1-1v-3a1 1 0 00-1-1h-.5a1.5 1.5 0 010-3H4a1 1 0 001-1V6a1 1 0 011-1h3a1 1 0 001-1v-.5z" />
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900">Verde<span class="text-emerald-500">AI</span></h1>
                        <p class="text-sm text-gray-600 hidden md:block">Transforma tus espacios con IA.</p>
                    </div>
                </div>

                <!-- Parte derecha: Navegación -->
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

    <!-- El resto del contenido de la página va dentro de su propio contenedor -->
    <div class="container mx-auto p-4 md:p-8">
        <main>
            @yield('content')
        </main>

        <footer class="text-center mt-8 md:mt-12 p-4">
            <p class="text-gray-600">&copy; 2025 VerdeAI. Todos los derechos reservados.</p>
        </footer>
    </div>

    <!-- Esta sección es para scripts específicos de cada página -->
    @stack('scripts')
</body>
</html>

