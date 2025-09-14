<!-- Sidebar component -->
<div class="flex h-full flex-col overflow-y-auto bg-gray-50 border-r border-gray-200">
    <!-- Logo/Brand -->
    <div class="flex h-16 shrink-0 items-center border-b border-gray-200 bg-white px-6">
        <div class="flex items-center group cursor-pointer">
            <div class="flex-shrink-0">
                <div class="h-8 w-8 bg-gradient-to-br from-blue-600 to-blue-700 rounded-lg flex items-center justify-center shadow-sm group-hover:shadow-md transition-shadow duration-200">
                    <span class="text-white font-bold text-sm">KT</span>
                </div>
            </div>
            <div class="ml-3">
                <h1 class="text-lg font-semibold text-gray-900">K-Tech Valves</h1>
                <p class="text-xs text-gray-500">Admin Panel</p>
            </div>
        </div>
    </div>

    <!-- Navigation -->
    <nav class="flex flex-1 flex-col py-6" aria-label="Main navigation">
        <div class="px-3 space-y-6">
            <!-- General Section -->
            <div>
                <h2 class="text-xs font-medium text-gray-500 uppercase tracking-wider mb-3 px-3">General</h2>
                <ul role="list" class=" space-y-1">
                    <!-- Dashboard -->
                    <li class="">
                        <a href="{{ route('admin.dashboard') }}" 
                           class="nav-item pl-2 items-center flex grid-2 gap-2 {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
                           role="menuitem">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                            </svg>
                            <span>Dashboard</span>
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Catalog Section -->
            <div>
                <h2 class="text-xs font-medium text-gray-500 uppercase tracking-wider mb-3 px-3">Catalog</h2>
                <ul role="list" class="space-y-1">
                    <!-- Categories -->
                    <li>
                        <a href="{{ route('admin.categories.index') }}" 
                           class="nav-item pl-2 items-center flex grid-2 gap-2  {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}"
                           role="menuitem">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z" />
                            </svg>
                            <span>Categories</span>
                        </a>
                    </li>
                    <!-- Products -->
                    <li>
                        <a href="{{ route('admin.products.index') }}" 
                           class="nav-item pl-2 items-center flex grid-2 gap-2  {{ request()->routeIs('admin.products.*') ? 'active' : '' }}"
                           role="menuitem">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />
                            </svg>
                            <span>Products</span>
                        </a>
                    </li>
                </ul>
            </div>            <!-- Content Section -->
            <div>
                <h2 class="text-xs font-medium text-gray-500 uppercase tracking-wider mb-3 px-3">Page Management</h2>
                <ul role="list" class="space-y-1">
                    <!-- Homepage -->
                    <li>
                        <a href="{{ route('admin.homepage.index') }}" 
                           class="nav-item pl-2 items-center flex grid-2 gap-2 {{ request()->routeIs('admin.homepage.*') ? 'active' : '' }}"
                           role="menuitem">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                            </svg>
                            <span>Homepage</span>
                        </a>
                    </li>
                    <!-- About Us -->
                    <li>
                        <a href="{{ route('admin.about-page.index') }}" 
                           class="nav-item pl-2 items-center flex grid-2 gap-2 {{ request()->routeIs('admin.about-page.*') ? 'active' : '' }}"
                           role="menuitem">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
                            </svg>
                            <span>About Us</span>
                        </a>
                    </li>
                    <!-- Gallery Page -->
                    <li>
                        <a href="{{ route('admin.gallery-page.index') }}" 
                           class="nav-item pl-2 items-center flex grid-2 gap-2 {{ request()->routeIs('admin.gallery-page.*') ? 'active' : '' }}"
                           role="menuitem">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                            </svg>
                            <span>Gallery Page</span>
                        </a>
                    </li>
                    <!-- Industries Page -->
                    <li>
                        <a href="{{ route('admin.industries-page.index') }}" 
                           class="nav-item pl-2 items-center flex grid-2 gap-2 {{ request()->routeIs('admin.industries-page.*') ? 'active' : '' }}"
                           role="menuitem">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 21h16.5M4.5 3h15l-.75 18H5.25L4.5 3zm7.5 0v18m-3-9h6" />
                            </svg>
                            <span>Industries Page</span>
                        </a>
                    </li>
                    <!-- Certifications Page -->
                    <li>
                        <a href="{{ route('admin.certifications-page.index') }}" 
                           class="nav-item pl-2 items-center flex grid-2 gap-2 {{ request()->routeIs('admin.certifications-page.*') ? 'active' : '' }}"
                           role="menuitem">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 01-1.043 3.296 3.745 3.745 0 01-3.296 1.043A3.745 3.745 0 0112 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 01-3.296-1.043 3.745 3.745 0 01-1.043-3.296A3.745 3.745 0 013 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 011.043-3.296 3.746 3.746 0 013.296-1.043A3.746 3.746 0 0112 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 013.296 1.043 3.746 3.746 0 011.043 3.296A3.745 3.745 0 0121 12z" />
                            </svg>
                            <span>Certifications Page</span>
                        </a>
                    </li>                    <!-- Contact Page -->
                    <li>
                        <a href="{{ route('admin.contact-page.index') }}" 
                           class="nav-item pl-2 items-center flex grid-2 gap-2 {{ request()->routeIs('admin.contact-page.*') ? 'active' : '' }}"
                           role="menuitem">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                            </svg>
                            <span>Contact Page</span>
                        </a>
                    </li>
                    <!-- Product Detail Page -->
                    <li>
                        <a href="{{ route('admin.product-detail-page.index') }}" 
                           class="nav-item pl-2 items-center flex grid-2 gap-2 {{ request()->routeIs('admin.product-detail-page.*') ? 'active' : '' }}"
                           role="menuitem">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                            </svg>
                            <span>Product Detail Page</span>
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Content Management -->
            <div>
                <h2 class="text-xs font-medium text-gray-500 uppercase tracking-wider mb-3 px-3">Content</h2>
                <ul role="list" class="space-y-1">
                    <!-- Banners -->
                    <li>
                        <a href="{{ route('admin.banners.index') }}" 
                           class="nav-item pl-2 items-center flex grid-2 gap-2 {{ request()->routeIs('admin.banners.*') ? 'active' : '' }}"
                           role="menuitem">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25H12" />
                            </svg>
                            <span>Banners</span>
                        </a>
                    </li>
                    <!-- Gallery -->
                    <li>
                        <a href="{{ route('admin.galleries.index') }}" 
                           class="nav-item pl-2 items-center flex grid-2 gap-2 {{ request()->routeIs('admin.galleries.*') ? 'active' : '' }}"
                           role="menuitem">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                            </svg>
                            <span>Gallery</span>
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Business Section -->
            <div>
                <h2 class="text-xs font-medium text-gray-500 uppercase tracking-wider mb-3 px-3">Business</h2>
                <ul role="list" class="space-y-1">
                    <!-- Industries -->
                    <li>
                        <a href="{{ route('admin.industries.index') }}" 
                           class="nav-item pl-2 items-center flex grid-2 gap-2 {{ request()->routeIs('admin.industries.*') ? 'active' : '' }}"
                           role="menuitem">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 21h16.5M4.5 3h15l-.75 18H5.25L4.5 3zm7.5 0v18m-3-9h6" />
                            </svg>
                            <span>Industries</span>
                        </a>
                    </li>
                    <!-- Certifications -->
                    <li>
                        <a href="{{ route('admin.certifications.index') }}" 
                           class="nav-item pl-2 items-center flex grid-2 gap-2 {{ request()->routeIs('admin.certifications.*') ? 'active' : '' }}"
                           role="menuitem">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 01-1.043 3.296 3.745 3.745 0 01-3.296 1.043A3.745 3.745 0 0112 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 01-3.296-1.043 3.745 3.745 0 01-1.043-3.296A3.745 3.745 0 013 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 011.043-3.296 3.746 3.746 0 013.296-1.043A3.746 3.746 0 0112 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 013.296 1.043 3.746 3.746 0 011.043 3.296A3.745 3.745 0 0121 12z" />
                            </svg>
                            <span>Certifications</span>
                        </a>
                    </li>
                    <!-- Clients -->
                    <li>
                        <a href="{{ route('admin.clients.index') }}" 
                           class="nav-item pl-2 items-center flex grid-2 gap-2 {{ request()->routeIs('admin.clients.*') ? 'active' : '' }}"
                           role="menuitem">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z" />
                            </svg>
                            <span>Clients</span>
                        </a>
                    </li>
                    <!-- Inquiries -->
                    <li>
                        <a href="{{ route('admin.inquiries.index') }}" 
                           class="nav-item pl-2 items-center flex grid-2 gap-2 {{ request()->routeIs('admin.inquiries.*') ? 'active' : '' }}"
                           role="menuitem">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                            </svg>
                            <span>Inquiries</span>
                            @if($newInquiriesCount = App\Models\Inquiry::where('status', 'new')->count())
                                <span class="ml-auto inline-flex items-center rounded-full bg-red-100 px-2 py-0.5 text-xs font-medium text-red-800">
                                    {{ $newInquiriesCount }}
                                </span>
                            @endif
                        </a>
                    </li>
                </ul>
            </div>

            <!-- System Section -->
            @if(auth()->user()->isSuperAdmin())
            <div>
                <h2 class="text-xs font-medium text-gray-500 uppercase tracking-wider mb-3 px-3">System</h2>
                <ul role="list" class="space-y-1">
                    <!-- Users -->
                    <li>
                        <a href="{{ route('admin.users.index') }}" 
                           class="nav-item pl-2 items-center flex grid-2 gap-2 {{ request()->routeIs('admin.users.*') ? 'active' : '' }}"
                           role="menuitem">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                            </svg>
                            <span>Users</span>
                        </a>
                    </li>
                    <!-- Settings -->
                    <li>
                        <a href="{{ route('admin.settings.index') }}" 
                           class="nav-item pl-2 items-center flex grid-2 gap-2 {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}"
                           role="menuitem">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.324.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 011.37.49l1.296 2.247a1.125 1.125 0 01-.26 1.431l-1.003.827c-.293.24-.438.613-.431.992a6.759 6.759 0 010 .255c-.007.378.138.75.43.99l1.005.828c.424.35.534.954.26 1.43l-1.298 2.247a1.125 1.125 0 01-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.57 6.57 0 01-.22.128c-.331.183-.581.495-.644.869l-.213 1.28c-.09.543-.56.941-1.11.941h-2.594c-.55 0-1.02-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 01-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 01-1.369-.49l-1.297-2.247a1.125 1.125 0 01.26-1.431l1.004-.827c.292-.24.437-.613.43-.992a6.932 6.932 0 010-.255c.007-.378-.138-.75-.43-.99l-1.004-.828a1.125 1.125 0 01-.26-1.43l1.297-2.247a1.125 1.125 0 011.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.087.22-.128.332-.183.582-.495.644-.869l.214-1.281z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <span>Settings</span>
                        </a>
                    </li>
                </ul>
            </div>
            @endif
        </div>
        
        <!-- Footer Section -->
        <div class="mt-2 px-3 py-4 border-t border-gray-200">
            <div class="flex items-center text-xs text-gray-500">
                <div class="flex-shrink-0 w-2 h-2 bg-green-400 rounded-full mr-2 animate-pulse"></div>
                <span>System Online</span>
            </div>
            <div class="mt-1 text-xs text-gray-400">
                <span>Laravel {{ app()->version() }}</span>
            </div>
        </div>
    </nav>
</div>
