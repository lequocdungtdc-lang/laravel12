@extends('web.master')
@section('content')
    <section>
        <div class="wrap-content">
            <div class="mw-500">
                 <div class="card shadow-lg border-0">
                <div class="card-body p-4">

                    <h3 class="text-center mb-4">Đăng nhập</h3>

                    {{-- Thông báo --}}
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form action="{{ route('member.login') }}" method="POST">
                        @csrf

                        <!-- Email -->
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" placeholder="Nhập email" value="{{ old('email') }}">
                            @error('email')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div class="mb-3">
                            <label class="form-label">Mật khẩu</label>
                            <input type="password" name="password" class="form-control" placeholder="Nhập mật khẩu">
                            @error('password')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        @if($errors->has('login'))
                            <div class="alert alert-danger mb-3">
                                {{ $errors->first('login') }}
                            </div>
                        @endif

                        <!-- Remember -->
                        <div class="mb-3 form-check">
                            <input type="checkbox" name="remember" class="form-check-input">
                            <label class="form-check-label">Ghi nhớ đăng nhập</label>
                        </div>

                        <!-- Submit -->
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Đăng nhập</button>
                        </div>
                        

                        <!-- Register -->
                        <div class="text-center mt-3">
                            <small>Chưa có tài khoản?
                                <a href="{{ route('member.register') }}">Đăng ký</a>
                            </small>
                        </div>

                    </form>

                </div>
            </div>
            </div>
        </div>
    </section>
@endsection
