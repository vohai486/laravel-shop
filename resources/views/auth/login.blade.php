@extends('auth.layouts.master')
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h4>Đăng nhập</h4>
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('login') }}" class="needs-validation">
                @csrf
                <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" value="{{ old('email') }}" type="email"
                        class="form-control @error('email') is-invalid @enderror" name="email" tabindex="1" autofocus>
                    @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <div class="d-block">
                        <label for="password" class="control-label">Mật khẩu</label>
                        <div class="float-right">
                            <a href="auth-forgot-password.html" class="text-small">
                                Quên mật khẩu?
                            </a>
                        </div>
                    </div>
                    <input id="password" value="{{ old('password') }}" type="password"
                        class="form-control @error('password') is-invalid @enderror" name="password" tabindex="2">
                    @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" name="remember" class="custom-control-input" tabindex="3" id="remember-me">
                        <label class="custom-control-label" for="remember-me">Ghi nhớ mật khẩu</label>
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                        Login
                    </button>
                </div>
            </form>
        </div>
    </div>
    <div class="mt-5 text-muted text-center">
        Bạn chưa có tài khoản? <a href="{{ route('register') }}">Tạo ngay</a>
    </div>
@endsection
