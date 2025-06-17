<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Bahan Makanan</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 min-h-screen">

    <main class="container mx-auto px-4 py-6">
        @yield('content')
    </main>

    @yield('scripts')
</body>
</html>
