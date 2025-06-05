<footer class="bg-gray-900 text-white">
    <!-- Main Footer Content -->
    <div class="container mx-auto px-4 py-12">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- Company Info -->
            <div class="col-span-1 lg:col-span-1">
                <div class="flex items-center space-x-2 mb-4">
                    <img src="{{ asset('images/logo-white.png') }}" alt="K Tech Valves Logo" class="h-10 w-auto">
                    <span class="text-xl font-bold">K Tech Valves</span>
                </div>
                <p class="text-gray-300 mb-4 leading-relaxed">
                    Leading manufacturer of high-quality industrial valves, serving various industries with innovative valve solutions and exceptional customer service.
                </p>
                <!-- Social Media Links -->
                <div class="flex space-x-4">
                    <a href="#" class="text-gray-400 hover:text-white transition-colors duration-200">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd" />
                        </svg>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-white transition-colors duration-200">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                        </svg>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-white transition-colors duration-200">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                        </svg>
                    </a>
                </div>
            </div>
            
            <!-- Quick Links -->
            <div>
                <h3 class="text-lg font-semibold mb-4">Quick Links</h3>
                <ul class="space-y-2">
                    <li><a href="{{ route('home') }}" class="text-gray-300 hover:text-white transition-colors duration-200">Home</a></li>
                    <li><a href="{{ route('about') }}" class="text-gray-300 hover:text-white transition-colors duration-200">About Us</a></li>
                    <li><a href="{{ route('products.index') }}" class="text-gray-300 hover:text-white transition-colors duration-200">Products</a></li>
                    <li><a href="{{ route('certifications') }}" class="text-gray-300 hover:text-white transition-colors duration-200">Certification</a></li>
                    <li><a href="{{ route('gallery') }}" class="text-gray-300 hover:text-white transition-colors duration-200">Gallery</a></li>
                    <li><a href="{{ route('industries.index') }}" class="text-gray-300 hover:text-white transition-colors duration-200">Industries</a></li>
                    <li><a href="{{ route('contact') }}" class="text-gray-300 hover:text-white transition-colors duration-200">Contact Us</a></li>
                </ul>
            </div>
            
            <!-- Our Products -->
            <div>
                <h3 class="text-lg font-semibold mb-4">Our Products</h3>
                <ul class="space-y-2">
                    <li><a href="{{ route('products.show','ball-valves') }}" class="text-gray-300 hover:text-white transition-colors duration-200">Ball Valves</a></li>
                    <li><a href="{{ route('products.show','gate-valves') }}" class="text-gray-300 hover:text-white transition-colors duration-200">Gate Valves</a></li>
                    <li><a href="{{ route('products.show','butterfly-valves') }}" class="text-gray-300 hover:text-white transition-colors duration-200">Butterfly Valves</a></li>
                    <li><a href="{{ route('products.show','check-valves') }}" class="text-gray-300 hover:text-white transition-colors duration-200">Check Valves</a></li>
                    <li><a href="{{ route('products.show','globe-valves') }}" class="text-gray-300 hover:text-white transition-colors duration-200">Globe Valves</a></li>
                    <li><a href="{{ route('products.show','strainer-valves') }}" class="text-gray-300 hover:text-white transition-colors duration-200">Strainer Valves</a></li>
                </ul>
            </div>
            
            <!-- Contact Information -->
            <div>
                <h3 class="text-lg font-semibold mb-4">Contact Info</h3>
                <div class="space-y-3">
                    <div class="flex items-start space-x-3">
                        <svg class="w-5 h-5 text-blue-400 mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        <div>
                            <p class="text-gray-300">123 Industrial Area,</p>
                            <p class="text-gray-300">Valve Street, Industrial City</p>
                            <p class="text-gray-300">State - 123456, India</p>
                        </div>
                    </div>
                    
                    <div class="flex items-center space-x-3">
                        <svg class="w-5 h-5 text-blue-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                        <div>
                            <p class="text-gray-300">+91 12345 67890</p>
                            <p class="text-gray-300">+91 98765 43210</p>
                        </div>
                    </div>
                    
                    <div class="flex items-center space-x-3">
                        <svg class="w-5 h-5 text-blue-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        <div>
                            <p class="text-gray-300">info@ktechvalves.com</p>
                            <p class="text-gray-300">sales@ktechvalves.com</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Bottom Footer -->
    <div class="border-t border-gray-800">
        <div class="container mx-auto px-4 py-6">
            <div class="flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
                <div class="text-gray-400 text-sm">
                    <p>&copy; {{ date('Y') }} K Tech Valves. All rights reserved.</p>
                </div>
                <div class="flex space-x-6 text-sm">
                    {{-- <a href="{{ route('privacy-policy') }}" class="text-gray-400 hover:text-white transition-colors duration-200">Privacy Policy</a> --}}
                    {{-- <a href="{{ route('terms-conditions') }}" class="text-gray-400 hover:text-white transition-colors duration-200">Terms & Conditions</a> --}}
                    <a href="{{ route('sitemap') }}" class="text-gray-400 hover:text-white transition-colors duration-200">Sitemap</a>
                </div>
            </div>
        </div>
    </div>
</footer>