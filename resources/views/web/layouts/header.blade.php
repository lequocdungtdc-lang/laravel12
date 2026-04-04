<header>
    <div class="wrap-content">
        <!-- Header content goes here -->
        <div class="d-flex justify-content-between align-items-center py-3">
            <div class="logo">
                <a href="{{ url('/') }}" class="text-decoration-none text-dark font-weight-bold">My Website</a>
            </div>
            <nav>
                <ul class="nav">
                    <li class="nav-item"><a href="{{ url('/') }}" class="nav-link">Home</a></li>
                    <li class="nav-item"><a href="{{ url('/about') }}" class="nav-link">About</a></li>
                    <li class="nav-item"><a href="{{ url('/contact') }}" class="nav-link">Contact</a></li>
                    {{-- member --}}
                    @if(Auth::guard('member')->check())
                        <li class="nav-item"><a href="{{ url('/member/profile') }}" class="nav-link">Profile</a></li>
                        <li class="nav-item"><a href="{{ url('/member/logout') }}" class="nav-link">Logout</a></li>
                    @else
                        <li class="nav-item"><a href="{{ url('/member/login') }}" class="nav-link">Login</a></li>
                        <li class="nav-item"><a href="{{ url('/member/register') }}" class="nav-link">Register</a></li>
                    @endif
                </ul>
            </nav>
        </div>
    </div>
</header>