<!DOCTYPE html>
<html>

    @include('admin.layouts.head')

    <body data-page="{{ request()->segment(2) ?? 'dashboard' }}" class="admin-layout">
        <!-- Loading Screen -->
        <div id="loading-screen" class="loading-screen">
            <div class="loading-spinner">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
        </div>

        <!-- Main Wrapper -->
        <div class="admin-wrapper" id="admin-wrapper">
            <!-- Header -->
            @include('admin.layouts.header')
            <!-- Sidebar -->
            @include('admin.layouts.sidebar')
            <!-- Sidebar Backdrop (mobile overlay) -->
            <div class="sidebar-backdrop" aria-hidden="true"></div>
            <!-- Main Content -->
            <main class="admin-main">
                @yield('content')
            </main>
            <!-- Footer -->
            @include('admin.layouts.footer')
        </div> <!-- /.admin-wrapper -->
        @include('admin.layouts.modal')
    </body>
</html>
