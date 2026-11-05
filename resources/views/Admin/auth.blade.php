<!DOCTYPE html>
<html
  lang="en"
  class="light-style customizer-hide"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="../assets/"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>{{ $siteSettings['site_name'] ?? config('app.name', 'Azeezia') }} - Admin Login</title>

    <meta name="description" content="Admin Dashboard Login" />
    <meta name="robots" content="noindex, nofollow" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ isset($siteSettings['favicon']) && $siteSettings['favicon'] ? asset('storage/' . $siteSettings['favicon']) : asset('assets/admin/img/favicon/favicon.ico') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

    <!-- Icons -->
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/fonts/boxicons.css') }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/css/core.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/css/theme-default.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/admin/css/demo.css') }}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />

    <!-- Page CSS -->
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/css/pages/page-auth.css') }}" />

    <!-- Helpers -->
    <script src="{{ asset('assets/admin/vendor/js/helpers.js') }}"></script>
    <script src="{{ asset('assets/admin/js/config.js') }}"></script>
  </head>

  <body>
    <div class="container-xxl">
      <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner">
          <div class="card shadow-sm border-0">
            <div class="card-body p-4">
              <!-- Logo -->
              <div class="app-brand justify-content-center mb-3">
                <a href="{{ url('/') }}" class="app-brand-link gap-2">
                  <span class="app-brand-text demo text-body fw-bolder text-uppercase text-primary fs-3">
                    {{ $siteSettings['site_name'] ?? 'Azeezia' }}
                  </span>
                </a>
              </div>
              <!-- /Logo -->

              <h4 class="mb-2 text-center">Welcome to Admin Portal 👋</h4>
              <p class="mb-4 text-center text-muted">Please sign in to manage your venues, resorts & SEO</p>

              @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                  {{ session('success') }}
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
              @endif

              @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                  @foreach($errors->all() as $error)
                    <div>{{ $error }}</div>
                  @endforeach
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
              @endif

              <form id="formAuthentication" class="mb-3" action="{{ route('admin.login.post') }}" method="POST">
                @csrf

                <div class="mb-3">
                  <label for="email" class="form-label">Email Address</label>
                  <input
                    type="email"
                    class="form-control @error('email') is-invalid @enderror"
                    id="email"
                    name="email"
                    placeholder="admin@azeezia.com"
                    value="{{ old('email') }}"
                    required
                    autofocus
                  />
                  @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>

                <div class="mb-3 form-password-toggle">
                  <div class="d-flex justify-content-between">
                    <label class="form-label" for="password">Password</label>
                  </div>
                  <div class="input-group input-group-merge">
                    <input
                      type="password"
                      id="password"
                      class="form-control @error('password') is-invalid @enderror"
                      name="password"
                      placeholder="••••••••"
                      required
                    />
                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                  </div>
                  @error('password')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                  @enderror
                </div>

                <div class="mb-3">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember-me" {{ old('remember') ? 'checked' : '' }} />
                    <label class="form-check-label" for="remember-me">Remember Me</label>
                  </div>
                </div>

                <div class="mb-3">
                  <button class="btn btn-primary d-grid w-100 py-2 fw-semibold" type="submit">Sign in to Dashboard</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Core JS -->
    <script src="{{ asset('assets/admin/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('assets/admin/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('assets/admin/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('assets/admin/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}"></script>
    <script src="{{ asset('assets/admin/vendor/js/menu.js') }}"></script>
    <script src="{{ asset('assets/admin/js/main.js') }}"></script>
  </body>
</html>
