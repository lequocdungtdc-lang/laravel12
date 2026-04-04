<header>
    <div class="wrap-content">
        <!-- Header content goes here -->
        <div class="d-flex justify-content-between align-items-center py-3">
            <div class="logo">
                <a href="{{ url('/') }}" class="text-decoration-none text-dark font-weight-bold">My Website</a>
            </div>
            <nav>
                <ul class="nav">
                    <li class="nav-item"><a href="{{ url('/') }}" class="nav-link">Trang chủ</a></li>
                    <li class="nav-item"><a href="{{ url('/gioi-thieu') }}" class="nav-link">Giới thiệu</a></li>
                    <li class="nav-item"><a href="{{ url('/lien-he') }}" class="nav-link">Liên hệ</a></li>
                    {{-- member --}}
                    @if(Auth::guard('member')->check())
                        <li class="nav-item"><a href="{{ url('/member/profile') }}" class="nav-link">Hello, {{ Auth::guard('member')->user()->fullname??'' }}</a></li>
                        <li class="nav-item"><a href="{{ url('/member/logout') }}" class="nav-link">Đăng xuất</a></li>
                    @else
                        <li class="nav-item"><a href="{{ url('/member/login') }}" class="nav-link">Đăng nhập</a></li>
                        <li class="nav-item"><a href="{{ url('/member/register') }}" class="nav-link">Đăng ký</a></li>
                    @endif
                </ul>
            </nav>
        </div>
    </div>
</header>