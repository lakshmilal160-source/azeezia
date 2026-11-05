@include('Admin.partials.header')
@include('Admin.partials.sidebar')

<div class="layout-page">
    @include('Admin.partials.navbar')

    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            @include('Admin.partials.alerts')
            @yield('content')
        </div>

        @include('Admin.partials.footer')

