@extends('web.master')

@section('content')
    <div class="container mt-4">
        <div class="row">

            <!-- LEFT: Avatar + Info -->
            <div class="col-md-4">
                <div class="card shadow-sm text-center">
                    <div class="card-body">

                        <img src="https://via.placeholder.com/120" class="rounded-circle mb-3" width="120" height="120">

                        <h5>{{ $authUser->fullname }}</h5>
                        <p class="text-muted">{{ $authUser->email }}</p>

                        <hr>

                        <p><strong>SĐT:</strong> {{ $authUser->phone ?? 'Chưa có' }}</p>
                        <p><strong>Địa chỉ:</strong> {{ $authUser->address ?? 'Chưa có' }}</p>

                    </div>
                </div>
            </div>

            <!-- RIGHT: Update form -->
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-body">

                        <h5 class="mb-3">Cập nhật thông tin</h5>

                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('member.profile') }}" method="POST">
                            @csrf
                            @if (!request('action') == 'change-password')
                                <!-- Name -->
                                <div class="mb-3">
                                    <label>Họ tên</label>
                                    <input type="text" name="fullname" class="form-control"
                                        value="{{ old('fullname', $authUser->fullname) }}">
                                </div>

                                <!-- Email -->
                                <div class="mb-3">
                                    <label>Email</label>
                                    <input type="email" name="email" class="form-control"
                                        value="{{ old('email', $authUser->email) }}">
                                </div>

                                <!-- Phone -->
                                <div class="mb-3">
                                    <label>Số điện thoại</label>
                                    <input type="text" name="phone" class="form-control"
                                        value="{{ old('phone', $authUser->phone) }}">
                                </div>

                                <!-- Address -->
                                <div class="mb-3">
                                    <label>Địa chỉ</label>
                                    <input type="text" name="address" class="form-control"
                                        value="{{ old('address', $authUser->address) }}">
                                </div>
                            @endif


                            @if (request('action') == 'change-password')
                                {{-- mat khau cu --}}
                                <div class="mb-3">
                                    <label>Mật khẩu cũ (nếu đổi)</label>
                                    <input type="password" name="current_password" class="form-control">
                                </div>

                                <!-- Password -->
                                <div class="mb-3">
                                    <label>Mật khẩu mới (nếu đổi)</label>
                                    <input type="password" name="password" class="form-control">
                                </div>

                                <!-- Confirm Password -->
                                <div class="mb-3">
                                    <label>Xác nhận mật khẩu</label>
                                    <input type="password" name="password_confirmation" class="form-control">
                                </div>
                            @endif
                            <!-- Submit -->
                            <button class="btn btn-primary">Cập nhật</button>
                            @if (!request('action') == 'change-password')
                                <a href="{{ route('member.profile') }}?action=change-password" class="btn btn-danger">Đổi
                                    mật khẩu</a>
                            @else
                                <a href="{{ route('member.profile') }}" class="btn btn-danger">Quay lại</a>
                            @endif

                        </form>

                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
