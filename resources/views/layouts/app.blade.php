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
        /* La clase .gradient-bg se puede eliminar ya que no se usa */
    </style>
</head>
<body class="text-gray-800" style="background-image: url('{{ asset('images/fondojardin.png') }}'); background-size: cover; background-attachment: fixed; background-position: center; background-repeat: no-repeat;">

    <header class="w-full bg-white/70 backdrop-blur-sm shadow-md z-50">
    <div class="container mx-auto p-1">
        <div class="flex flex-col md:flex-row md:justify-between md:items-center text-center md:text-left">
            
            <div class="flex items-center justify-center md:justify-start gap-4 mb-4 md:mb-0">
                
                <img src="{{ Vite::asset('resources/images/logoFi.png') }}" alt="Logo de JPJardines" class="h-14 w-auto rounded-lg">

                <div>
  <h1 class="text-3xl font-bold text-gray-900" style="font-family: 'Playfair Display', serif;">
    Arbor<span class="text-green-500">ea</span>
  </h1>
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