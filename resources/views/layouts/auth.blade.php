<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Fresh Soy')</title>
    
    {{-- Vite (Tailwind CSS) --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50">
    
    {{-- Content Only (No Navbar, No Footer) --}}
    @yield('content')
    
</body>
</html>