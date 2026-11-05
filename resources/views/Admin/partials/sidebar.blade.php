<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="{{ route('admin.dashboard') }}" class="app-brand-link">
            <span class="app-brand-logo demo">
                <i class="bx bxs-institution text-primary fs-2"></i>
            </span>
            <span class="app-brand-text demo menu-text fw-bolder ms-2 text-uppercase text-primary fs-4">
                {{ config('custom.app_name', 'Azeezia') }}
            </span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboard -->
        <li class="menu-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <a href="{{ route('admin.dashboard') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div>Dashboard</div>
            </a>
        </li>

        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Properties & Venues</span>
        </li>

        <!-- Convention Centre Dropdown -->
        <li class="menu-item {{ request()->routeIs('admin.convention-centres.*', 'admin.infrastructures.*', 'admin.what-we-offers.*') ? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-buildings"></i>
                <div>Convention Centre</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ request()->routeIs('admin.convention-centres.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.convention-centres.index') }}" class="menu-link">
                        <div>Basic Details</div>
                    </a>
                </li>
                <li class="menu-item {{ request()->routeIs('admin.infrastructures.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.infrastructures.index') }}" class="menu-link">
                        <div>Infrastructure</div>
                    </a>
                </li>
                <li class="menu-item {{ request()->routeIs('admin.what-we-offers.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.what-we-offers.index') }}" class="menu-link">
                        <div>What We Offer</div>
                    </a>
                </li>
            </ul>
        </li>

        <!-- Resorts -->
        <li class="menu-item {{ request()->routeIs('admin.resorts.*') ? 'active' : '' }}">
            <a href="{{ route('admin.resorts.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-bed"></i>
                <div>Resorts & Stay</div>
            </a>
        </li>

        <!-- Organic Farms -->
        <li class="menu-item {{ request()->routeIs('admin.organic-farms.*') ? 'active' : '' }}">
            <a href="{{ route('admin.organic-farms.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-leaf"></i>
                <div>Organic Farms</div>
            </a>
        </li>

        <!-- Upcoming Projects -->
        <li class="menu-item {{ request()->routeIs('admin.upcoming-projects.*') ? 'active' : '' }}">
            <a href="{{ route('admin.upcoming-projects.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-rocket"></i>
                <div>Upcoming Projects</div>
            </a>
        </li>

        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Content & Marketing</span>
        </li>

        <!-- Services -->
        <li class="menu-item {{ request()->routeIs('admin.services.*') ? 'active' : '' }}">
            <a href="{{ route('admin.services.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-briefcase"></i>
                <div>Services</div>
            </a>
        </li>


        <!-- Gallery -->
        <li class="menu-item {{ request()->routeIs('admin.gallery.*') ? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-images"></i>
                <div>Gallery</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ request()->routeIs('admin.gallery.index') ? 'active' : '' }}">
                    <a href="{{ route('admin.gallery.index') }}" class="menu-link">
                        <div>All Images</div>
                    </a>
                </li>
                <li class="menu-item {{ request()->routeIs('admin.gallery.categories') ? 'active' : '' }}">
                    <a href="{{ route('admin.gallery.categories') }}" class="menu-link">
                        <div>Categories</div>
                    </a>
                </li>
            </ul>
        </li>

        <!-- Testimonials -->
        <li class="menu-item {{ request()->routeIs('admin.testimonials.*') ? 'active' : '' }}">
            <a href="{{ route('admin.testimonials.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-star"></i>
                <div>Testimonials</div>
            </a>
        </li>

        <!-- FAQs -->
        <li class="menu-item {{ request()->routeIs('admin.faqs.*') ? 'active' : '' }}">
            <a href="{{ route('admin.faqs.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-help-circle"></i>
                <div>FAQs</div>
            </a>
        </li>

        <!-- Page Banners -->
        <li class="menu-item {{ request()->routeIs('admin.banners.*') ? 'active' : '' }}">
            <a href="{{ route('admin.banners.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-image-alt"></i>
                <div>Page Banners</div>
            </a>
        </li>

        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Leads & System</span>
        </li>

        <!-- Enquiries -->
        <li class="menu-item {{ request()->routeIs('admin.enquiries.*') ? 'active' : '' }}">
            <a href="{{ route('admin.enquiries.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-envelope"></i>
                <div>Enquiries</div>
                @php
                    $newEnquiryCount = \App\Models\Enquiry::where('status', 'new')->count();
                @endphp
                @if($newEnquiryCount > 0)
                    <div class="badge bg-danger rounded-pill ms-auto">{{ $newEnquiryCount }}</div>
                @endif
            </a>
        </li>

        <!-- Site Settings -->
        <li class="menu-item {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
            <a href="{{ route('admin.settings.edit') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-cog"></i>
                <div>Settings</div>
            </a>
        </li>
    </ul>
</aside>
