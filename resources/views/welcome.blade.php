<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel Designer') }}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
    <!-- Header -->
    <header class="bg-dark text-white text-center py-3">
        <h1>Rediseñador con IA</h1>
    </header>

    <!-- Contenido dinámico -->
    <main class="container my-4">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-light text-center py-3 mt-5 border-top">
        <p>&copy; {{ date('Y') }} - Proyecto con Laravel + IA</p>
    </footer>
</body>
</html>
