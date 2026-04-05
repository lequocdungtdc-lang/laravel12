<head>
    <title>Admin</title>
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"> --}}
    {{-- <link rel="stylesheet" href="{{ asset('assets/admin/css/style.css') }}"> --}}

    <!-- Meta Tags -->
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Modern Bootstrap 5 Admin Template - Clean, responsive dashboard">
    <meta name="keywords" content="bootstrap, admin, dashboard, template, modern, responsive">
    <meta name="author" content="Bootstrap Admin Template">

    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="Modern Bootstrap Admin Template">
    <meta property="og:description" content="Clean and modern admin dashboard template built with Bootstrap 5">
    <meta property="og:type" content="website">

    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" href="{{ asset('assets/admin/icons/favicon.svg') }}">
    <link rel="icon" type="image/png" href="{{ asset('assets/admin/icons/favicon.png') }}">
    

    <!-- Preconnect to external domains -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <!-- Fonts -->
    <link rel="manifest" href="{{ asset('assets/admin/manifest-DTaoG9pG.json') }}">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" crossorigin href="{{ asset('assets/admin/css/main-BQhM7myw.css') }}">
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"> --}}


    <!-- Title -->
    {{-- <title>Dashboard - Modern Bootstrap Admin</title> --}}
    <!-- Theme Color -->
    {{-- <meta name="theme-color" content="#6366f1"> --}}
    <!-- PWA Manifest -->

    {{-- <script type="module" crossorigin src="{{ asset('assets/admin/js/vendor-bootstrap-C9iorZI5.js') }}"></script> --}}
    {{-- cdm bootstrap --}}
    <!-- CSS -->

    <!-- JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="module" crossorigin src="{{ asset('assets/admin/js/vendor-charts-DGwYAWel.js') }}"></script>
    <script type="module" crossorigin src="{{ asset('assets/admin/js/vendor-ui-CflGdlft.js') }}"></script>
    <script type="module" crossorigin src="{{ asset('assets/admin/js/main-B24LRf0x.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script type="module" crossorigin src="{{ asset('assets/admin/js/functions.js') }}?v={{ time() }}"></script>

    <script type="module" crossorigin src="{{ asset('assets/admin/js/apps.js') }}?v={{ time() }}"></script>

    <!-- ApexCharts CDN -->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <!-- Styles now in SCSS files -->
    <script type="module" crossorigin src="{{ asset('assets/admin/js/users-DaDyOi2I.js') }}"></script>
</head>
