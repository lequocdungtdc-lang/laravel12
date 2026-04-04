<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Web')</title>
    <!-- CSS -->
    @include('web.layouts.css')
</head>
<body>
    {{-- Header --}}
    @include('web.layouts.header')
    {{-- Menu --}}
    @include('web.layouts.menu')
    {{-- Content --}}
    <main>
        @yield('content')
    </main>
    {{-- Footer --}}
    @include('web.layouts.footer')
    @include('web.layouts.js')
</body>
</html>