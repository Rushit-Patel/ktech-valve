<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }} - Industrial Valve Solutions</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:300,400,500,600,700&display=swap" rel="stylesheet" />
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gradient-to-br from-slate-50 via-white to-slate-100 dark:from-slate-900 dark:via-slate-800 dark:to-slate-900">
    <!-- Navigation -->
    <nav class="sticky top-0 z-50 border-b border-slate-200/80 bg-white/70 backdrop-blur-xl dark:border-slate-700/80 dark:bg-slate-900/70">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex h-16 items-center justify-between">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <img class="h-8 w-auto" src="/images/logo.svg" alt="{{ config('app.name') }}">
                    </div>
                    <div class="hidden md:block">
                        <div class="ml-10 flex items-baseline space-x-4">
                            <a href="#" class="px-3 py-2 text-sm font-medium text-slate-900 hover:text-blue-600 dark:text-slate-100 dark:hover:text-blue-400">Products</a>
                            <a href="#" class="px-3 py-2 text-sm font-medium text-slate-500 hover:text-slate-900 dark:text-slate-400 dark:hover:text-slate-100">Solutions</a>
                            <a href="#" class="px-3 py-2 text-sm font-medium text-slate-500 hover:text-slate-900 dark:text-slate-400 dark:hover:text-slate-100">About</a>
                            <a href="#" class="px-3 py-2 text-sm font-medium text-slate-500 hover:text-slate-900 dark:text-slate-400 dark:hover:text-slate-100">Contact</a>
                        </div>
                    </div>
                </div>
                <div class="hidden md:block">
                    <div class="ml-4 flex items-center md:ml-6">
                        @auth
                            <a href="{{ route('dashboard') }}" class="inline-flex items-center rounded-lg bg-blue-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                                Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="text-slate-500 hover:text-slate-900 dark:text-slate-400 dark:hover:text-slate-100 px-3 py-2 text-sm font-medium">Sign in</a>
                            <a href="{{ route('register') }}" class="ml-3 inline-flex items-center rounded-lg bg-blue-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                                Get Started
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="relative overflow-hidden">
        <div class="mx-auto max-w-7xl px-4 pb-16 pt-16 sm:px-6 sm:pb-24 sm:pt-24 lg:px-8">
            <div class="text-center">
                <h1 class="mx-auto max-w-4xl text-4xl font-bold tracking-tight text-slate-900 dark:text-slate-100 sm:text-6xl">
                    Industrial Valve 
                    <span class="bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">Solutions</span>
                    for Modern Industry
                </h1>
                <p class="mx-auto mt-6 max-w-2xl text-lg leading-8 text-slate-600 dark:text-slate-400">
                    K Tech Valves provides cutting-edge valve solutions for industrial applications. 
                    Engineered for reliability, performance, and efficiency.
                </p>
                <div class="mt-10 flex items-center justify-center gap-x-6">
                    <a href="#products" class="rounded-lg bg-blue-600 px-6 py-3 text-base font-semibold text-white shadow-sm hover:bg-blue-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600">
                        View Products
                    </a>
                    <a href="#contact" class="text-base font-semibold leading-6 text-slate-900 dark:text-slate-100">
                        Learn more <span aria-hidden="true">→</span>
                    </a>
                </div>
            </div>
        </div>
        
        <!-- Background decoration -->
        <div class="absolute inset-x-0 top-[calc(100%-13rem)] -z-10 transform-gpu overflow-hidden blur-3xl sm:top-[calc(100%-30rem)]">
            <div class="relative left-[calc(50%+3rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 bg-gradient-to-tr from-blue-600 to-purple-600 opacity-20 sm:left-[calc(50%+36rem)] sm:w-[72.1875rem]" style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)"></div>
        </div>
    </div>

    <!-- Product Categories Section -->
    <div id="products" class="py-16 sm:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h2 class="text-3xl font-bold tracking-tight text-slate-900 dark:text-slate-100 sm:text-4xl">
                    Our Product Categories
                </h2>
                <p class="mt-4 text-lg text-slate-600 dark:text-slate-400">
                    Comprehensive valve solutions for every industrial need
                </p>
            </div>
            
            <div class="mt-16 grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
                @foreach($productCategories as $category)
                <div class="group relative overflow-hidden rounded-2xl bg-white dark:bg-slate-800 shadow-lg transition-all duration-300 hover:shadow-xl hover:-translate-y-1">
                    @if($category->image)
                        <div class="aspect-[16/9] overflow-hidden">
                            <img src="{{ Storage::url($category->image) }}" 
                                 alt="{{ $category->name }}" 
                                 class="h-full w-full object-cover transition-transform duration-300 group-hover:scale-105">
                        </div>
                    @else
                        <div class="aspect-[16/9] bg-gradient-to-br from-blue-50 to-blue-100 dark:from-slate-700 dark:to-slate-600 flex items-center justify-center">
                            <svg class="h-16 w-16 text-blue-600 dark:text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-4.5A1.125 1.125 0 0110.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H5.25m0 0h4.125c1.243 0 2.25 1.007 2.25 2.25v1.5c0 .621.504 1.125 1.125 1.125H15m-6.75-7.5h2.25c1.243 0 2.25 1.007 2.25 2.25v4.875c0 1.243-1.007 2.25-2.25 2.25h-9A1.125 1.125 0 012.25 15.75v-7.5A1.125 1.125 0 013.375 7.125h4.5z" />
                            </svg>
                        </div>
                    @endif
                    
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-slate-900 dark:text-slate-100 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors">
                            {{ $category->name }}
                        </h3>
                        @if($category->description)
                            <p class="mt-2 text-slate-600 dark:text-slate-400 line-clamp-3">
                                {{ $category->description }}
                            </p>
                        @endif
                        <div class="mt-4 flex items-center justify-between">
                            <span class="text-sm text-slate-500 dark:text-slate-400">
                                {{ $category->products->count() }} Products
                            </span>
                            <a href="{{ route('products.category', $category->slug) }}" 
                               class="inline-flex items-center text-sm font-medium text-blue-600 dark:text-blue-400 hover:text-blue-700 dark:hover:text-blue-300">
                                View Products
                                <svg class="ml-1 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Stats Section -->
    <div class="bg-blue-600 dark:bg-blue-700 py-16 sm:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-4">
                <div class="text-center">
                    <div class="text-3xl font-bold text-white sm:text-4xl">{{ $totalProducts ?? '500+' }}</div>
                    <div class="mt-2 text-blue-100">Products Available</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl font-bold text-white sm:text-4xl">{{ $totalCategories ?? '25+' }}</div>
                    <div class="mt-2 text-blue-100">Product Categories</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl font-bold text-white sm:text-4xl">15+</div>
                    <div class="mt-2 text-blue-100">Years Experience</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl font-bold text-white sm:text-4xl">1000+</div>
                    <div class="mt-2 text-blue-100">Happy Clients</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-slate-900 dark:bg-slate-950">
        <div class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8 lg:py-16">
            <div class="xl:grid xl:grid-cols-3 xl:gap-8">
                <div class="space-y-8 xl:col-span-1">
                    <img class="h-8 w-auto" src="/images/logo-white.svg" alt="{{ config('app.name') }}">
                    <p class="text-base text-slate-400">
                        Leading provider of industrial valve solutions with over 15 years of experience in the industry.
                    </p>
                </div>
                <div class="mt-12 grid grid-cols-2 gap-8 xl:col-span-2 xl:mt-0">
                    <div class="md:grid md:grid-cols-2 md:gap-8">
                        <div>
                            <h3 class="text-base font-medium text-white">Products</h3>
                            <ul class="mt-4 space-y-4">
                                @foreach($productCategories->take(4) as $category)
                                <li>
                                    <a href="{{ route('products.category', $category->slug) }}" class="text-base text-slate-400 hover:text-white">
                                        {{ $category->name }}
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="mt-12 md:mt-0">
                            <h3 class="text-base font-medium text-white">Company</h3>
                            <ul class="mt-4 space-y-4">
                                <li><a href="#" class="text-base text-slate-400 hover:text-white">About</a></li>
                                <li><a href="#" class="text-base text-slate-400 hover:text-white">Blog</a></li>
                                <li><a href="#" class="text-base text-slate-400 hover:text-white">Careers</a></li>
                                <li><a href="#" class="text-base text-slate-400 hover:text-white">Contact</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-12 border-t border-slate-800 pt-8">
                <p class="text-base text-slate-400">&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
            </div>
        </div>
    </footer>
</body>
</html>