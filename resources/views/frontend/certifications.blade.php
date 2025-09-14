@extends('frontend.layouts.app')

@section('title', 'Certifications - K-Tech Valves')
@section('meta_description', 'K-Tech Valves holds industry-leading certifications including ISO 9001, API, ASME, CE, and more. View our complete certification portfolio.')

@section('content')
<!-- Hero Section -->
<div class="bg-gradient-to-r from-green-900 to-green-700 text-white py-20">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto text-center">
            <h1 class="text-4xl md:text-6xl font-bold mb-6">Our Certifications</h1>
            <p class="text-xl md:text-2xl text-green-100 mb-8">Industry-leading certifications that demonstrate our commitment to quality, safety, and excellence in valve manufacturing.</p>
            <div class="flex flex-wrap justify-center gap-4 mt-8">
                <div class="bg-white bg-opacity-20 px-4 py-2 rounded-lg">
                    <span class="font-semibold">{{ $certifications->count() }}+ Certifications</span>
                </div>
                <div class="bg-white bg-opacity-20 px-4 py-2 rounded-lg">
                    <span class="font-semibold">Global Standards</span>
                </div>
                <div class="bg-white bg-opacity-20 px-4 py-2 rounded-lg">
                    <span class="font-semibold">Verified Quality</span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Certifications Overview -->
<div class="py-20 bg-white">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6">Quality Assurance Through Certification</h2>
            <p class="text-lg text-gray-600 leading-relaxed">
                At K-Tech Valves, we maintain the highest industry standards through rigorous certification processes. 
                Our certifications ensure that every valve we manufacture meets or exceeds international quality, 
                safety, and performance requirements.
            </p>
        </div>

        <!-- Key Benefits -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-16">
            <div class="text-center p-6">
                <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Verified Quality</h3>
                <p class="text-gray-600">Third-party verification ensures our products meet international standards</p>
            </div>
            
            <div class="text-center p-6">
                <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Safety Compliance</h3>
                <p class="text-gray-600">Adherence to safety standards protects both personnel and operations</p>
            </div>
            
            <div class="text-center p-6">
                <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Global Recognition</h3>
                <p class="text-gray-600">International certifications enable market access worldwide</p>
            </div>
        </div>
    </div>
</div>

<!-- Certifications Grid -->
<div class="py-20 bg-gray-50">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl md:text-4xl font-bold text-center text-gray-900 mb-16">Our Certification Portfolio</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($certifications as $certification)
            <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                @if($certification->certificate_image)
                <div class="h-48 bg-gray-100 flex items-center justify-center overflow-hidden">
                    <img src="{{ asset('storage/' . $certification->certificate_image) }}" 
                         alt="{{ $certification->name }}" 
                         class="max-h-full max-w-full object-contain">
                </div>
                @else
                <div class="h-48 bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center">
                    <div class="text-center text-white">
                        <svg class="w-16 h-16 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                        </svg>
                        <h3 class="text-xl font-bold">{{ $certification->name }}</h3>
                    </div>
                </div>
                @endif
                
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-xl font-bold text-gray-900">{{ $certification->name }}</h3>
                        @if($certification->is_valid)
                        <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-semibold">
                            Valid
                        </span>
                        @else
                        <span class="bg-red-100 text-red-800 px-3 py-1 rounded-full text-sm font-semibold">
                            Expired
                        </span>
                        @endif
                    </div>
                    
                    <p class="text-gray-600 mb-4 leading-relaxed">{{ $certification->description }}</p>
                    
                    <div class="space-y-2 text-sm text-gray-500">
                        <div class="flex justify-between">
                            <span>Issuing Authority:</span>
                            <span class="font-semibold">{{ $certification->issuing_authority }}</span>
                        </div>
                        @if($certification->certificate_number)
                        <div class="flex justify-between">
                            <span>Certificate No:</span>
                            <span class="font-semibold">{{ $certification->certificate_number }}</span>
                        </div>
                        @endif
                        @if($certification->issue_date)
                        <div class="flex justify-between">
                            <span>Issue Date:</span>
                            <span class="font-semibold">{{ date('M d, Y', strtotime($certification->issue_date)) }}</span>
                        </div>
                        @endif
                        @if($certification->expiry_date)
                        <div class="flex justify-between">
                            <span>Expiry Date:</span>
                            <span class="font-semibold {{ $certification->is_valid ? 'text-green-600' : 'text-red-600' }}">
                                {{ date('M d, Y', strtotime($certification->expiry_date)) }}
                            </span>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

<!-- Compliance Statement -->
<div class="py-20 bg-blue-900 text-white">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto text-center">
            <h2 class="text-3xl md:text-4xl font-bold mb-8">Our Commitment to Compliance</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 text-left">
                <div>
                    <h3 class="text-xl font-bold mb-4">Quality Management</h3>
                    <p class="text-blue-100 leading-relaxed mb-6">
                        Our ISO 9001 certification demonstrates our commitment to quality management systems, 
                        ensuring consistent delivery of products that meet customer and regulatory requirements.
                    </p>
                    
                    <h3 class="text-xl font-bold mb-4">Safety Standards</h3>
                    <p class="text-blue-100 leading-relaxed">
                        We adhere to the highest safety standards, including OSHA compliance and industry-specific 
                        safety protocols to protect our workforce and customers.
                    </p>
                </div>
                
                <div>
                    <h3 class="text-xl font-bold mb-4">Environmental Responsibility</h3>
                    <p class="text-blue-100 leading-relaxed mb-6">
                        Our environmental certifications reflect our commitment to sustainable manufacturing 
                        practices and minimizing our environmental footprint.
                    </p>
                    
                    <h3 class="text-xl font-bold mb-4">Continuous Improvement</h3>
                    <p class="text-blue-100 leading-relaxed">
                        We continuously monitor and improve our processes to maintain certification compliance 
                        and exceed industry standards.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- CTA Section -->
<div class="py-16 bg-white">
    <div class="container mx-auto px-4 text-center">
        <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Need Certification Documentation?</h2>
        <p class="text-xl text-gray-600 mb-8 max-w-2xl mx-auto">
            Request copies of our certifications for your project requirements or compliance documentation.
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('contact') }}" 
               class="bg-blue-600 text-white px-8 py-4 rounded-lg font-semibold text-lg hover:bg-blue-700 transition-colors duration-200 inline-flex items-center justify-center">
                Request Certificates
                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
            </a>
            <a href="{{ route('products.index') }}" 
               class="bg-gray-100 text-gray-800 px-8 py-4 rounded-lg font-semibold text-lg hover:bg-gray-200 transition-colors duration-200 inline-flex items-center justify-center">
                View Products
                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                </svg>
            </a>
        </div>
    </div>
</div>
@endsection
