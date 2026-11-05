<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Azeezia • Luxury Convention Centre & Organic Farm Resort | Thrissur & Kochi</title>

  <!-- SEO & Social Meta Tags -->
  <meta name="description" content="Azeezia Convention Centre & 37-Acre Organic Farm Resort. Premier luxury destination weddings, grand receptions, and corporate conclaves in Pazhuvil (Thrissur) and Padivattom (Kochi), Kerala.">
  <meta name="keywords" content="Azeezia Convention Centre, Thrissur wedding venue, Kochi convention centre, organic farm resort Pazhuvil, destination wedding Kerala, event planner Kerala, luxury banquet hall">
  <meta name="author" content="Azeezia">
  
  <meta property="og:type" content="website">
  <meta property="og:title" content="Azeezia • Luxury Convention Centre & Organic Farm Resort">
  <meta property="og:description" content="Where bespoke celebrations meet pristine nature. Now welcoming Thrissur bookings at our 37-acre organic resort, alongside Kochi's flagship 2,000-capacity auditorium.">
  <meta property="og:image" content="{{asset('assets/frontend/images/logo.webp')}}">

  <!-- Favicon -->
  <link rel="icon" href="{{asset('assets/frontend/images/logo.webp')}}" type="image/png">

  <!-- Google Fonts: Editorial Serif, Clean Sans & Calligraphy -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Alex+Brush&family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;0,700;1,400;1,600&family=Montserrat:wght@300;400;500;600;700&family=Playfair+Display:ital,wght@0,400;0,500;0,600;1,400&display=swap" rel="stylesheet">

  <!-- Font Awesome 6 Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

  <!-- Master Stylesheet (Separated CSS file) -->
  <link rel="stylesheet" href="{{asset('assets/frontend/css/style.css')}}">
  <link rel="stylesheet" href="{{asset('assets/frontend/css/about.css')}}">
  @stack('style')
</head>
<body>

  <!-- ========================================================================
       SITE HEADER & NAVIGATION
       (Azeezia Logo, Navigation, Phone Number, Enquire Now Button)
       ======================================================================== -->
  <header class="site-header" id="siteHeader">
    <div class="header-inner">
      <!-- Left: Authentic Azeezia Brand Logo (with the nature) -->
      <a href="{{route('home')}}" class="header-brand" aria-label="Azeezia - with the nature">
        <img src="{{asset('assets/frontend/images/logo.webp')}}" alt="Azeezia - with the nature" class="brand-logo-img">
      </a>

      <!-- Center: Navigation Menu Links (Home, About, Convention Centre, Services, Resort, Organic Farm, Gallery, Contact) -->
      <nav class="header-center-nav" aria-label="Main Navigation">
        <a href="{{route('home')}}" class="center-nav-item active">Home</a>
        <a href="{{route('about')}}" class="center-nav-item">About</a>
        <a href="{{route('convention-center')}}" class="center-nav-item">Convention Centre</a>
        <a href="{{route('services')}}" class="center-nav-item">Services</a>
        <a href="{{route('resort')}}" class="center-nav-item">Resort</a>
        <a href="{{route('organic-farm')}}" class="center-nav-item">Organic Farm</a>
        <a href="{{route('gallery')}}" class="center-nav-item">Gallery</a>
        <a href="{{route('contact')}}" class="center-nav-item">Contact</a>
      </nav>

      <!-- Right: Enquire Pill Button + Hamburger Menu Toggle (Exact Reference) -->
      <div class="header-right-tools">
        {{-- <a href="services.html" class="header-enquire-pill" id="headerEnquireBtn" aria-label="Enquire about events">
          <span class="enquire-pip" aria-hidden="true"></span>
          <span class="enquire-text">ENQUIRE</span>
        </a> --}}

        <!-- 3-bar Hamburger Menu Toggle -->
        <button class="header-hamburger-toggle mobile-toggle" id="mobileToggle" aria-label="Toggle navigation menu" aria-expanded="false">
          <span class="ham-toggle-bar"></span>
          <span class="ham-toggle-bar"></span>
          <span class="ham-toggle-bar"></span>
        </button>
      </div>
    </div>

    <!-- Luxury Off-Canvas Navigation Drawer (Slides in on Click) -->
    <nav class="nav-menu" id="navMenu" aria-label="Main Navigation">
      <div class="nav-drawer-header">
        <img src="{{asset('assets/frontend/images/logo.webp')}}" alt="Azeezia - with the nature" class="nav-drawer-logo">
        <button class="nav-close-btn" id="navCloseBtn" aria-label="Close navigation menu">
          <i class="fas fa-times"></i>
        </button>
      </div>

      <div class="nav-drawer-links">
        <a href="{{route('home')}}" class="nav-link active">Home</a>
        <a href="{{route('about')}}" class="nav-link">About</a>
        <a href="{{route('convention-center')}}" class="nav-link">Convention Centre</a>
        <a href="{{route('services')}}" class="nav-link">Services</a>
        <a href="{{route('resort')}}" class="nav-link">Resort</a>
        <a href="{{route('organic-farm')}}" class="nav-link">Organic Farm</a>
        <a href="{{route('gallery')}}" class="nav-link">Gallery</a>
        {{-- <a href="about.html#about-faq" class="nav-link">FAQ</a> --}}
        <a href="{{route('contact')}}" class="nav-link">Contact</a>
      </div>

      <div class="nav-drawer-footer">
       
        <a href="{{route('services')}}" class="nav-drawer-cta">
          <span>Plan Your Event</span>
          <i class="fas fa-arrow-right"></i>
        </a>
      </div>
    </nav>
  </header>