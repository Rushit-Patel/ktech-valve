@extends('frontend.layouts.app')

@section('title', $seoData['title'] ?? 'K Tech Valves - Leading Valve Manufacturer & Supplier')
@section('meta_description', $seoData['description'] ?? 'K Tech Valves is a premier manufacturer and supplier of high-quality industrial valves.')
@section('meta_keywords', $seoData['keywords'] ?? 'industrial valves, valve manufacturer, valve supplier, ball valves, gate valves')

@section('content')
<!-- Banner/Slider Section -->
<section class="hero-banner">
    <div class="banner-slider">
        <!-- Slide 1 -->
        <div class="slide active">
            <div class="slide-content">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-6">
                            <div class="banner-text">
                                <h1 class="banner-title">{{ $websiteSettings['hero_title'] ?? 'Leading Valve Solutions for Industrial Excellence' }}</h1>
                                <p class="banner-description">{{ $websiteSettings['hero_subtitle'] ?? 'Discover our comprehensive range of high-quality industrial valves designed for superior performance and reliability across diverse applications.' }}</p>
                                <div class="banner-buttons">
                                    <a href="{{ route('products.index') }}" class="btn btn-primary">Explore Products</a>
                                    <a href="{{ route('contact') }}" class="btn btn-outline">Get Quote</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="banner-image">
                                <img src="{{ $websiteSettings['hero_image'] ? asset('storage/' . $websiteSettings['hero_image']) : asset('images/banners/banner-1.jpg') }}" alt="K Tech Valves Industrial Solutions" class="img-fluid">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Slide 2 -->
        <div class="slide">
            <div class="slide-content">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-6">
                            <div class="banner-text">
                                <h1 class="banner-title">Certified Quality, Trusted Performance</h1>
                                <p class="banner-description">ISO certified manufacturing processes ensure every valve meets international quality standards for your critical applications.</p>
                                <div class="banner-buttons">
                                    <a href="{{ route('certifications') }}" class="btn btn-primary">View Certifications</a>
                                    <a href="{{ route('about') }}" class="btn btn-outline">Learn More</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="banner-image">
                                <img src="{{ asset('images/banners/banner-2.jpg') }}" alt="Certified Quality Valves" class="img-fluid">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Slide 3 -->
        <div class="slide">
            <div class="slide-content">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-6">
                            <div class="banner-text">
                                <h1 class="banner-title">Serving Industries Worldwide</h1>
                                <p class="banner-description">From oil & gas to pharmaceuticals, our valves power critical operations across multiple industries globally.</p>
                                <div class="banner-buttons">
                                    <a href="{{ route('industries.index') }}" class="btn btn-primary">View Industries</a>
                                    <a href="{{ route('gallery') }}" class="btn btn-outline">View Gallery</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="banner-image">
                                <img src="{{ asset('images/banners/banner-3.jpg') }}" alt="Industrial Applications" class="img-fluid">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Slider Navigation -->
    <div class="slider-nav">
        <button class="prev-slide">&lsaquo;</button>
        <button class="next-slide">&rsaquo;</button>
    </div>
    
    <!-- Slider Indicators -->
    <div class="slider-indicators">
        <span class="indicator active" data-slide="0"></span>
        <span class="indicator" data-slide="1"></span>
        <span class="indicator" data-slide="2"></span>
    </div>
</section>

<!-- About Company Section -->
<section class="about-company py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="about-content">
                    <div class="section-header">
                        <span class="section-subtitle">About K Tech Valves</span>
                        <h2 class="section-title">{{ $websiteSettings['about_title'] ?? 'Engineering Excellence in Every Valve' }}</h2>
                    </div>
                    <p class="about-description">
                        {{ $websiteSettings['about_description'] ?? 'With over two decades of experience in valve manufacturing, K Tech Valves has established itself as a trusted name in the industry. We specialize in designing, manufacturing, and supplying high-quality industrial valves that meet the most demanding specifications.' }}
                    </p>
                    <div class="about-features">
                        <div class="feature-item">
                            <i class="icon-check"></i>
                            <span>ISO 9001:2015 Certified</span>
                        </div>
                        <div class="feature-item">
                            <i class="icon-check"></i>
                            <span>{{ $stats['years_experience'] }}+ Years Experience</span>
                        </div>
                        <div class="feature-item">
                            <i class="icon-check"></i>
                            <span>Global Supply Network</span>
                        </div>
                    </div>
                    <a href="{{ route('about') }}" class="btn btn-primary mt-4">Read More About Us</a>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="about-image">
                    <img src="{{ $websiteSettings['about_image'] ? asset('storage/' . $websiteSettings['about_image']) : asset('images/about/company-overview.jpg') }}" alt="K Tech Valves Manufacturing" class="img-fluid rounded">
                    <div class="experience-badge">
                        <span class="years">{{ $stats['years_experience'] }}+</span>
                        <span class="text">Years of Excellence</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Our Valves Range Section -->
<section class="valves-range py-5 bg-light">
    <div class="container">
        <div class="section-header text-center mb-5">
            <span class="section-subtitle">Our Products</span>
            <h2 class="section-title">Comprehensive Valve Range</h2>
            <p class="section-description">Explore our extensive collection of industrial valves designed for various applications and industries</p>
        </div>
        
        <div class="row">
            @forelse($categories as $category)
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="valve-category-card">
                    <div class="category-image">
                        <img src="{{ $category->image_url }}" alt="{{ $category->name }}" class="img-fluid">
                    </div>
                    <div class="category-content">
                        <h4 class="category-title">{{ $category->name }}</h4>
                        <p class="category-description">{{ Str::limit($category->description, 100) }}</p>
                        <div class="category-meta">
                            <span class="product-count">{{ $category->active_products_count }} Products</span>
                        </div>
                        <a href="{{ route('products.category', $category->slug) }}" class="category-link">View Products</a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center">
                <p class="text-muted">No product categories available at the moment.</p>
            </div>
            @endforelse
        </div>
        
        <div class="text-center mt-4">
            <a href="{{ route('products.index') }}" class="btn btn-primary">View All Products</a>
        </div>
    </div>
</section>

<!-- Featured Products Section -->
<section class="featured-products py-5">
    <div class="container">
        <div class="section-header text-center mb-5">
            <span class="section-subtitle">Featured Products</span>
            <h2 class="section-title">Our Best Selling Valves</h2>
            <p class="section-description">Discover our most popular and trusted valve solutions</p>
        </div>
        
        <div class="row">
            @forelse($featuredProducts->take(3) as $product)
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="product-card">
                    <div class="product-image">
                        <img src="{{ $product->main_image_url }}" alt="{{ $product->name }}" class="img-fluid">
                        <div class="product-badge">Featured</div>
                    </div>
                    <div class="product-content">
                        <h5 class="product-title">{{ $product->name }}</h5>
                        <p class="product-description">{{ Str::limit($product->short_description, 120) }}</p>
                        @if($product->technical_details)
                        <div class="product-specs">
                            @foreach(collect($product->technical_details)->take(2) as $key => $value)
                            <span class="spec">{{ ucfirst($key) }}: {{ $value }}</span>
                            @endforeach
                        </div>
                        @endif
                        <div class="product-actions">
                            <a href="{{ route('products.show', $product->slug) }}" class="btn btn-outline btn-sm">View Details</a>
                            <a href="{{ route('contact') }}?product={{ $product->slug }}" class="btn btn-primary btn-sm">Get Quote</a>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center">
                <p class="text-muted">No featured products available at the moment.</p>
            </div>
            @endforelse
        </div>
    </div>
</section>

<!-- Why Choose K Tech Valves Section -->
<section class="why-choose-us py-5 bg-primary text-white">
    <div class="container">
        <div class="section-header text-center mb-5">
            <span class="section-subtitle">Why Choose Us</span>
            <h2 class="section-title">K Tech Valves Advantage</h2>
            <p class="section-description">Discover what makes us the preferred choice for industrial valve solutions</p>
        </div>
        
        <div class="row">
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="advantage-item text-center">
                    <div class="advantage-icon">
                        <i class="icon-quality"></i>
                    </div>
                    <h4 class="advantage-title">Superior Quality</h4>
                    <p class="advantage-description">ISO 9001:2015 certified manufacturing processes ensure consistent quality and reliability in every product we deliver.</p>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="advantage-item text-center">
                    <div class="advantage-icon">
                        <i class="icon-innovation"></i>
                    </div>
                    <h4 class="advantage-title">Innovative Solutions</h4>
                    <p class="advantage-description">Continuous R&D investment enables us to develop cutting-edge valve technologies for evolving industry needs.</p>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="advantage-item text-center">
                    <div class="advantage-icon">
                        <i class="icon-support"></i>
                    </div>
                    <h4 class="advantage-title">Expert Support</h4>
                    <p class="advantage-description">Our technical experts provide comprehensive support from product selection to after-sales service.</p>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="advantage-item text-center">
                    <div class="advantage-icon">
                        <i class="icon-delivery"></i>
                    </div>
                    <h4 class="advantage-title">Timely Delivery</h4>
                    <p class="advantage-description">Efficient supply chain management ensures on-time delivery to meet your project deadlines.</p>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="advantage-item text-center">
                    <div class="advantage-icon">
                        <i class="icon-customization"></i>
                    </div>
                    <h4 class="advantage-title">Custom Solutions</h4>
                    <p class="advantage-description">Tailored valve solutions designed to meet specific application requirements and industry standards.</p>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="advantage-item text-center">
                    <div class="advantage-icon">
                        <i class="icon-global"></i>
                    </div>
                    <h4 class="advantage-title">Global Reach</h4>
                    <p class="advantage-description">Worldwide distribution network ensures reliable service and support wherever your operations are located.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Industries We Serve Section -->
<section class="industries-served py-5">
    <div class="container">
        <div class="section-header text-center mb-5">
            <span class="section-subtitle">Industries We Serve</span>
            <h2 class="section-title">Powering Critical Operations Worldwide</h2>
            <p class="section-description">Our valves serve diverse industries with specialized solutions for unique operational requirements</p>
        </div>
        
        <div class="row">
            @forelse($industries as $industry)
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="industry-item text-center">
                    <div class="industry-icon">
                        <img src="{{ $industry->icon_url ?? asset('images/industries/default.svg') }}" alt="{{ $industry->name }}" class="img-fluid">
                    </div>
                    <h5 class="industry-title">{{ $industry->name }}</h5>
                    <p class="industry-description">{{ Str::limit($industry->short_description, 80) }}</p>
                </div>
            </div>
            @empty
            <div class="col-12 text-center">
                <p class="text-muted">No industries information available at the moment.</p>
            </div>
            @endforelse
        </div>
        
        <div class="text-center mt-4">
            <a href="{{ route('industries.index') }}" class="btn btn-primary">View All Industries</a>
        </div>
    </div>
</section>

<!-- Certifications Section -->
<section class="certifications py-5 bg-light">
    <div class="container">
        <div class="section-header text-center mb-5">
            <span class="section-subtitle">Quality Assurance</span>
            <h2 class="section-title">Our Certifications</h2>
            <p class="section-description">Committed to international quality standards and regulatory compliance</p>
        </div>
        
        <div class="row justify-content-center">
            @forelse($certifications as $certification)
            <div class="col-lg-3 col-md-4 col-6 mb-4">
                <div class="certification-item text-center">
                    <div class="certification-logo">
                        <img src="{{ $certification->certificate_image_url }}" alt="{{ $certification->title }}" class="img-fluid">
                    </div>
                    <h6 class="certification-title">{{ $certification->title }}</h6>
                    <p class="certification-description">{{ $certification->issued_by }}</p>
                    @if($certification->expiry_date)
                    <small class="text-muted">Valid until: {{ $certification->expiry_date->format('M Y') }}</small>
                    @endif
                </div>
            </div>
            @empty
            <div class="col-12 text-center">
                <p class="text-muted">No certifications information available at the moment.</p>
            </div>
            @endforelse
        </div>
        
        <div class="text-center mt-4">
            <a href="{{ route('certifications') }}" class="btn btn-primary">View All Certifications</a>
        </div>
    </div>
</section>

<!-- Our Clients Section -->
<section class="our-clients py-5">
    <div class="container">
        <div class="section-header text-center mb-5">
            <span class="section-subtitle">Trusted Partners</span>
            <h2 class="section-title">Our Valued Clients</h2>
            <p class="section-description">Proud to serve leading organizations across the globe</p>
        </div>
        
        @if($clients->count() > 0)
        <div class="clients-grid">
            <div class="row">
                @foreach($clients as $client)
                <div class="col-lg-2 col-md-3 col-4 mb-4">
                    <div class="client-logo">
                        <img src="{{ $client->logo_url }}" alt="{{ $client->name }}" class="img-fluid grayscale" title="{{ $client->name }}">
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif
        
        <!-- Client Testimonials -->
        @if($testimonials->count() > 0)
        <div class="testimonials mt-5">
            <div class="row">
                @foreach($testimonials->take(3) as $testimonial)
                <div class="col-lg-4 mb-4">
                    <div class="testimonial-card">
                        <div class="testimonial-content">
                            <p class="testimonial-text">"{{ $testimonial->content }}"</p>
                        </div>
                        <div class="testimonial-author">
                            <div class="author-info">
                                <h6 class="author-name">{{ $testimonial->client_name }}</h6>
                                <span class="author-position">{{ $testimonial->client_designation }}, {{ $testimonial->company_name }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</section>

<!-- Statistics Section -->
<section class="statistics py-5 bg-dark text-white">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="stat-item text-center">
                    <div class="stat-number">{{ $stats['total_products'] }}</div>
                    <div class="stat-label">Products Available</div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="stat-item text-center">
                    <div class="stat-number">{{ $stats['industries_served'] }}+</div>
                    <div class="stat-label">Industries Served</div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="stat-item text-center">
                    <div class="stat-number">{{ $stats['years_experience'] }}+</div>
                    <div class="stat-label">Years Experience</div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="stat-item text-center">
                    <div class="stat-number">{{ $stats['satisfied_clients'] }}+</div>
                    <div class="stat-label">Satisfied Clients</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Call to Action Section -->
<section class="cta-section py-5 bg-primary text-white">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <div class="cta-content">
                    <h3 class="cta-title">Ready to Find Your Perfect Valve Solution?</h3>
                    <p class="cta-description">Contact our technical experts today for personalized recommendations and competitive quotes.</p>
                </div>
            </div>
            <div class="col-lg-4 text-lg-end">
                <div class="cta-buttons">
                    <a href="{{ route('contact') }}" class="btn btn-light me-3">Contact Us</a>
                    <a href="{{ route('contact') }}?type=quote" class="btn btn-outline-light">Get Quote</a>
                </div>
            </div>
        </div>
    </div>
</section>

@if(isset($schemaMarkup))
<!-- Schema Markup -->
<script type="application/ld+json">
{!! json_encode($schemaMarkup, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
</script>
@endif
@endsection

@push('styles')
<style>
/* Banner/Slider Styles */
.hero-banner {
    position: relative;
    overflow: hidden;
    height: 600px;
}

.banner-slider {
    position: relative;
    height: 100%;
}

.slide {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    opacity: 0;
    transition: opacity 0.8s ease-in-out;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

.slide.active {
    opacity: 1;
}

.slide-content {
    display: flex;
    align-items: center;
    height: 100%;
    padding: 60px 0;
}

.banner-title {
    font-size: 3.5rem;
    font-weight: 700;
    margin-bottom: 1.5rem;
    color: white;
}

.banner-description {
    font-size: 1.2rem;
    margin-bottom: 2rem;
    color: rgba(255, 255, 255, 0.9);
}

.banner-buttons .btn {
    margin-right: 1rem;
    margin-bottom: 1rem;
}

/* Product and Category Cards */
.valve-category-card,
.product-card {
    background: white;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    height: 100%;
    display: flex;
    flex-direction: column;
}

.valve-category-card:hover,
.product-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15);
}

.category-image,
.product-image {
    position: relative;
    overflow: hidden;
    height: 200px;
}

.category-image img,
.product-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.category-content,
.product-content {
    padding: 1.5rem;
    flex-grow: 1;
    display: flex;
    flex-direction: column;
}

.product-actions {
    margin-top: auto;
    padding-top: 1rem;
}

.product-badge {
    position: absolute;
    top: 1rem;
    right: 1rem;
    background: #ff6b6b;
    color: white;
    padding: 0.25rem 0.75rem;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 600;
}

.product-specs {
    margin: 0.5rem 0;
}

.product-specs .spec {
    display: inline-block;
    background: #f8f9fa;
    padding: 0.25rem 0.5rem;
    border-radius: 4px;
    font-size: 0.8rem;
    margin-right: 0.5rem;
    margin-bottom: 0.25rem;
}

/* Statistics Section */
.statistics {
    background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
}

.stat-item {
    padding: 2rem 1rem;
}

.stat-number {
    font-size: 3rem;
    font-weight: 700;
    color: #3498db;
    margin-bottom: 0.5rem;
}

.stat-label {
    font-size: 1.1rem;
    color: #ecf0f1;
}

/* Industry Items */
.industry-item {
    padding: 1.5rem;
    border-radius: 12px;
    transition: transform 0.3s ease;
    background: white;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    height: 100%;
}

.industry-item:hover {
    transform: translateY(-3px);
}

.industry-icon {
    width: 80px;
    height: 80px;
    margin: 0 auto 1rem;
}

/* Certification Items */
.certification-item {
    padding: 1.5rem;
    background: white;
    border-radius: 12px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease;
    height: 100%;
}

.certification-item:hover {
    transform: translateY(-3px);
}

.certification-logo {
    width: 80px;
    height: 80px;
    margin: 0 auto 1rem;
}

/* Client Logos */
.client-logo {
    display: flex;
    align-items: center;
    justify-content: center;
    height: 80px;
    padding: 1rem;
    transition: transform 0.3s ease;
    background: white;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

.client-logo:hover {
    transform: scale(1.05);
}

.client-logo img {
    max-height: 100%;
    max-width: 100%;
    object-fit: contain;
    filter: grayscale(100%);
    transition: filter 0.3s ease;
}

.client-logo:hover img {
    filter: grayscale(0%);
}

/* Testimonial Cards */
.testimonial-card {
    background: white;
    padding: 2rem;
    border-radius: 12px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    height: 100%;
    display: flex;
    flex-direction: column;
}

.testimonial-content {
    flex-grow: 1;
}

.testimonial-text {
    font-style: italic;
    font-size: 1.1rem;
    margin-bottom: 1.5rem;
    color: #666;
}

/* Experience Badge */
.experience-badge {
    position: absolute;
    bottom: 2rem;
    right: 2rem;
    background: #007bff;
    color: white;
    padding: 1rem;
    border-radius: 12px;
    text-align: center;
}

.experience-badge .years {
    display: block;
    font-size: 2rem;
    font-weight: 700;
}

.experience-badge .text {
    font-size: 0.9rem;
}

/* Responsive Design */
@media (max-width: 768px) {
    .banner-title {
        font-size: 2.5rem;
    }
    
    .cta-buttons {
        text-align: center;
        margin-top: 1rem;
    }
    
    .stat-number {
        font-size: 2.5rem;
    }
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Banner Slider Functionality
    const slides = document.querySelectorAll('.slide');
    const indicators = document.querySelectorAll('.indicator');
    const prevButton = document.querySelector('.prev-slide');
    const nextButton = document.querySelector('.next-slide');
    let currentSlide = 0;
    const slideInterval = 5000; // 5 seconds

    function showSlide(index) {
        slides.forEach((slide, i) => {
            slide.classList.toggle('active', i === index);
        });
        indicators.forEach((indicator, i) => {
            indicator.classList.toggle('active', i === index);
        });
        currentSlide = index;
    }

    function nextSlide() {
        const next = (currentSlide + 1) % slides.length;
        showSlide(next);
    }

    function prevSlide() {
        const prev = (currentSlide - 1 + slides.length) % slides.length;
        showSlide(prev);
    }

    // Event listeners
    if (nextButton) nextButton.addEventListener('click', nextSlide);
    if (prevButton) prevButton.addEventListener('click', prevSlide);

    indicators.forEach((indicator, index) => {
        indicator.addEventListener('click', () => showSlide(index));
    });

    // Auto-play slider
    let autoPlayInterval = setInterval(nextSlide, slideInterval);

    // Pause auto-play on hover
    const bannerSlider = document.querySelector('.banner-slider');
    if (bannerSlider) {
        bannerSlider.addEventListener('mouseenter', () => {
            clearInterval(autoPlayInterval);
        });

        bannerSlider.addEventListener('mouseleave', () => {
            autoPlayInterval = setInterval(nextSlide, slideInterval);
        });
    }

    // Counter Animation
    function animateCounters() {
        const counters = document.querySelectorAll('.stat-number');
        counters.forEach(counter => {
            const target = parseInt(counter.textContent.replace(/\D/g, ''));
            const increment = target / 200;
            let current = 0;
            
            const timer = setInterval(() => {
                current += increment;
                if (current >= target) {
                    counter.textContent = counter.textContent.replace(/\d+/, target);
                    clearInterval(timer);
                } else {
                    counter.textContent = counter.textContent.replace(/\d+/, Math.floor(current));
                }
            }, 10);
        });
    }

    // Animate counters when they come into view
    const statsSection = document.querySelector('.statistics');
    if (statsSection) {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    animateCounters();
                    observer.unobserve(entry.target);
                }
            });
        });
        observer.observe(statsSection);
    }
});
</script>
@endpush