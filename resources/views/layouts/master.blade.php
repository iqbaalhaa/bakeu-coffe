<!DOCTYPE html>
<html lang="id">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>@yield('title', 'Admin Panel - Bakeu Coffee')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    {{-- Favicon --}}
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('backend/assets/img/favicon/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('backend/assets/img/favicon/favicon.png') }}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="theme-color" content="#ffffff">

    {{-- Vendor CSS --}}
    <link rel="stylesheet" href="{{ asset('backend/vendor/sweetalert2/dist/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/vendor/notyf/notyf.min.css') }}">

    {{-- Volt CSS --}}
    <link rel="stylesheet" href="{{ asset('backend/css/volt.css') }}">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

    @stack('styles')
</head>
<body>

    {{-- Navbar mobile (tampilan HP) --}}
    @include('partials.navbar-mobile')

    {{-- Sidebar --}}
    @include('partials.sidebar')

    {{-- Konten utama --}}
    <main class="content">
        {{-- Top bar (navbar atas) --}}
        @include('partials.topbar')

        {{-- Flash message global --}}
        <div class="container-fluid px-0">
            @if(session('success'))
                <div class="alert alert-success m-3">
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger m-3">
                    {{ session('error') }}
                </div>
            @endif
        </div>

        {{-- Tempat isi halaman --}}
        @yield('content')

        {{-- Footer --}}
        @include('partials.footer')
    </main>

    {{-- Script JS --}}
    @include('partials.scripts')
    @stack('scripts')
</body>
</html>
