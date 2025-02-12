<!-- resources/views/layouts/app.blade.php -->

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Aplicación</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <!-- Barra de navegación -->
        <x-navbar />

        <!-- Contenido principal -->
        <main>
            @yield('content') <!-- El contenido de la vista que se pasa al layout -->
        </main>
    </div>
</body>
</html>
