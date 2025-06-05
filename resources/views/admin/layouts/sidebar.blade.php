<div class="position-sticky pt-3">
    <div class="text-center pb-3 border-bottom">
        <h5 class="text-primary">K Tech Valves</h5>
        <small class="text-muted">Admin Panel</small>
    </div>
    
    <ul class="nav flex-column mt-3">
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                <i class="fas fa-tachometer-alt me-2"></i>
                Dashboard
            </a>
        </li>
        
        <li class="nav-item">
            <h6 class="nav-header text-muted mt-3 mb-1 px-3">PRODUCT MANAGEMENT</h6>
        </li>
        
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.products.*') ? 'active' : '' }}" href="{{ route('admin.products.index') }}">
                <i class="fas fa-box me-2"></i>
                Products
            </a>
        </li>
        
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.product-categories.*') ? 'active' : '' }}" href="{{ route('admin.product-categories.index') }}">
                <i class="fas fa-layer-group me-2"></i>
                Product Categories
            </a>
        </li>
        
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.industries.*') ? 'active' : '' }}" href="{{ route('admin.industries.index') }}">
                <i class="fas fa-industry me-2"></i>
                Industries
            </a>
        </li>
        
        <li class="nav-item">
            <h6 class="nav-header text-muted mt-3 mb-1 px-3">CONTENT MANAGEMENT</h6>
        </li>
        
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.pages.*') ? 'active' : '' }}" href="{{ route('admin.pages.index') }}">
                <i class="fas fa-file-alt me-2"></i>
                Pages
            </a>
        </li>
        
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.galleries.*') ? 'active' : '' }}" href="{{ route('admin.galleries.index') }}">
                <i class="fas fa-images me-2"></i>
                Gallery
            </a>
        </li>
        
        <li class="nav-item">
            <h6 class="nav-header text-muted mt-3 mb-1 px-3">CUSTOMER MANAGEMENT</h6>
        </li>
        
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.inquiries.*') ? 'active' : '' }}" href="{{ route('admin.inquiries.index') }}">
                <i class="fas fa-envelope me-2"></i>
                Inquiries
                @if(isset($newInquiriesCount) && $newInquiriesCount > 0)
                    <span class="badge bg-danger ms-1">{{ $newInquiriesCount }}</span>
                @endif
            </a>
        </li>
        
        <li class="nav-item">
            <h6 class="nav-header text-muted mt-3 mb-1 px-3">SEO & SETTINGS</h6>
        </li>
        
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.seo.*') ? 'active' : '' }}" href="{{ route('admin.seo.index') }}">
                <i class="fas fa-search me-2"></i>
                SEO Management
            </a>
        </li>
        
        <li class="nav-item">
            <h6 class="nav-header text-muted mt-3 mb-1 px-3">WEBSITE</h6>
        </li>
        
        <li class="nav-item">
            <a class="nav-link" href="{{ route('home') }}" target="_blank">
                <i class="fas fa-external-link-alt me-2"></i>
                View Website
            </a>
        </li>
    </ul>
</div>