<header class="bg-white shadow-lg sticky top-0 z-50">
    <nav class="container mx-auto px-4 py-4">
        <div class="flex items-center justify-between">
            <!-- Logo -->
            <div class="flex items-center">
                <a href="{{ route('home') }}" class="flex items-center space-x-2">
                    <img src="{{ asset('images/logo.png') }}" alt="K Tech Valves Logo" class="h-12 w-auto">
                    <span class="text-2xl font-bold text-blue-800">K Tech Valves</span>
                </a>
            </div>
            
            <!-- Desktop Navigation -->
            <div class="hidden lg:flex items-center space-x-8">
                <a href="{{ route('home') }}" class="text-gray-700 hover:text-blue-600 font-medium transition-colors duration-200">
                    Home
                </a>
                
                <a href="{{ route('about') }}" class="text-gray-700 hover:text-blue-600 font-medium transition-colors duration-200">
                    About Us
                </a>
                
                <!-- Products Dropdown -->
                <div class="relative group">
                    <button class="text-gray-700 hover:text-blue-600 font-medium transition-colors duration-200 flex items-center space-x-1">
                        <span>Products</span>
                        <svg class="w-4 h-4 transform group-hover:rotate-180 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    
                    <div class="absolute left-0 mt-2 w-64 bg-white rounded-md shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                        <div class="py-2">
                            <a href="{{ route('products.show','ball-valves') }}" class="block px-4 py-2 text-gray-700 hover:bg-blue-50 hover:text-blue-600">Ball Valves</a>
                            <a href="{{ route('products.show','gate-valves') }}" class="block px-4 py-2 text-gray-700 hover:bg-blue-50 hover:text-blue-600">Gate Valves</a>
                            <a href="{{ route('products.show','butterfly-valves') }}" class="block px-4 py-2 text-gray-700 hover:bg-blue-50 hover:text-blue-600">Butterfly Valves</a>
                            <a href="{{ route('products.show','check-valves') }}" class="block px-4 py-2 text-gray-700 hover:bg-blue-50 hover:text-blue-600">Check Valves</a>
                            <a href="{{ route('products.show','globe-valves') }}" class="block px-4 py-2 text-gray-700 hover:bg-blue-50 hover:text-blue-600">Globe Valves</a>
                            <a href="{{ route('products.show','strainer-valves') }}" class="block px-4 py-2 text-gray-700 hover:bg-blue-50 hover:text-blue-600">Strainer Valves</a>
                            <a href="{{ route('products.index') }}" class="block px-4 py-2 text-blue-600 font-medium hover:bg-blue-50 border-t">View All Products</a>
                        </div>
                    </div>
                </div>
                
                <a href="{{ route('certifications') }}" class="text-gray-700 hover:text-blue-600 font-medium transition-colors duration-200">
                    Certification
                </a>
                
                <a href="{{ route('gallery') }}" class="text-gray-700 hover:text-blue-600 font-medium transition-colors duration-200">
                    Gallery
                </a>
                
                <a href="{{ route('industries.index') }}" class="text-gray-700 hover:text-blue-600 font-medium transition-colors duration-200">
                    Industries
                </a>
                
                <a href="{{ route('contact') }}" class="text-gray-700 hover:text-blue-600 font-medium transition-colors duration-200">
                    Contact Us
                </a>
                
                <!-- CTA Button -->
                <a href="{{ route('contact') }}" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition-colors duration-200 font-medium">
                    Get Quote
                </a>
            </div>
            
            <!-- Mobile Menu Button -->
            <div class="lg:hidden">
                <button id="mobile-menu-button" class="text-gray-700 hover:text-blue-600 focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </div>
        
        <!-- Mobile Menu -->
        <div id="mobile-menu" class="lg:hidden hidden mt-4 pb-4">
            <div class="flex flex-col space-y-3">
                <a href="{{ route('home') }}" class="text-gray-700 hover:text-blue-600 font-medium py-2">Home</a>
                <a href="{{ route('about') }}" class="text-gray-700 hover:text-blue-600 font-medium py-2">About Us</a>
                
                <!-- Mobile Products Menu -->
                <div class="border-l-2 border-gray-200 pl-4">
                    <p class="text-gray-900 font-medium py-2">Products</p>
                    <div class="flex flex-col space-y-2 ml-4">
                        <a href="{{ route('products.show','ball-valves') }}" class="text-gray-600 hover:text-blue-600 py-1">Ball Valves</a>
                        <a href="{{ route('products.show','gate-valves') }}" class="text-gray-600 hover:text-blue-600 py-1">Gate Valves</a>
                        <a href="{{ route('products.show','butterfly-valves') }}" class="text-gray-600 hover:text-blue-600 py-1">Butterfly Valves</a>
                        <a href="{{ route('products.show','check-valves') }}" class="text-gray-600 hover:text-blue-600 py-1">Check Valves</a>
                        <a href="{{ route('products.show','globe-valves') }}" class="text-gray-600 hover:text-blue-600 py-1">Globe Valves</a>
                        <a href="{{ route('products.show','strainer-valves') }}" class="text-gray-600 hover:text-blue-600 py-1">Strainer Valves</a>
                        <a href="{{ route('products.index') }}" class="text-blue-600 font-medium py-1">View All Products</a>
                    </div>
                </div>
                
                <a href="{{ route('certifications') }}" class="text-gray-700 hover:text-blue-600 font-medium py-2">Certification</a>
                <a href="{{ route('gallery') }}" class="text-gray-700 hover:text-blue-600 font-medium py-2">Gallery</a>
                <a href="{{ route('industries.index') }}" class="text-gray-700 hover:text-blue-600 font-medium py-2">Industries</a>
                <a href="{{ route('contact') }}" class="text-gray-700 hover:text-blue-600 font-medium py-2">Contact Us</a>
                <a href="{{ route('contact') }}" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition-colors duration-200 font-medium text-center">
                    Get Quote
                </a>
            </div>
        </div>
    </nav>
</header>

<script>
    // Mobile menu toggle
    document.getElementById('mobile-menu-button').addEventListener('click', function() {
        const mobileMenu = document.getElementById('mobile-menu');
        mobileMenu.classList.toggle('hidden');
    });
</script>