<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Bahan Makanan</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 min-h-screen">
    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded relative mx-auto mt-4 max-w-4xl"
            role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif


    <main class="container mx-auto px-4 py-6">
        @yield('content')
    </main>

    @yield('scripts')
</body>


</html>
