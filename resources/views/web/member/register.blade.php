@extends('web.master')
@section('content')
    <section>
        <div class="wrap-content">
            <div class="mw-500">
                <div class="card shadow-lg border-0">
                    <div class="card-body p-4">
                        <h3 class="text-center mb-4">Đăng ký tài khoản</h3>
                        <form action="{{ route('member.register') }}" method="POST">
                            @csrf
                            <!-- Name -->
                            <div class="mb-3">
                                <label class="form-label">Họ tên</label>
                                <input type="text" name="fullname" class="form-control" placeholder="Nhập họ tên" required>
                                @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" placeholder="Nhập email" required>
                                @error('email')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <!-- Password -->
                            <div class="mb-3">
                                <label class="form-label">Mật khẩu</label>
                                <input type="password" name="password" class="form-control" placeholder="Nhập mật khẩu"
                                    required>
                                @error('password')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <!-- Confirm Password -->
                            <div class="mb-3">
                                <label class="form-label">Xác nhận mật khẩu</label required>
                                <input type="password" name="password_confirmation" class="form-control"
                                    placeholder="Nhập lại mật khẩu">
                            </div>

                            <!-- Submit -->
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Đăng ký</button>
                            </div>

                            <!-- Login link -->
                            <div class="text-center mt-3">
                                <small>Đã có tài khoản?
                                    <a href="{{ route('member.login') }}">Đăng nhập</a>
                                </small>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
