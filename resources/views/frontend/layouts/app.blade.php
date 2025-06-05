<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <!-- SEO Meta Tags -->
    <title>@yield('title', 'K Tech Valves - Industrial Valve Manufacturer')</title>
    <meta name="description" content="@yield('meta_description', 'K Tech Valves is a leading manufacturer of industrial valves, providing high-quality valve solutions for various industries.')">
    <meta name="keywords" content="@yield('meta_keywords', 'industrial valves, valve manufacturer, ball valves, gate valves, butterfly valves, check valves')">
    <meta name="author" content="K Tech Valves">
    
    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="@yield('title', 'K Tech Valves - Industrial Valve Manufacturer')">
    <meta property="og:description" content="@yield('meta_description', 'K Tech Valves is a leading manufacturer of industrial valves, providing high-quality valve solutions for various industries.')">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="{{ asset('images/og-image.jpg') }}">
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- CSS -->
    @vite('resources/css/app.css')
    
    <!-- Additional CSS -->
    @stack('styles')
</head>
<body class="antialiased">
    <!-- Header/Navbar -->
    @include('frontend.partials.navbar')
    
    <!-- Main Content -->
    <main>
        @yield('content')
    </main>
    
    <!-- Footer -->
    @include('frontend.partials.footer')
    
    <!-- JavaScript -->
    @vite('resources/js/app.js')
    
    <!-- Additional JavaScript -->
    @stack('scripts')
</body>
</html>