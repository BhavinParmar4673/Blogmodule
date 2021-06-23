@extends('admin.layouts.master')

@section('content')
    <div class="container py-5">
        <div class="d-flex align-items-center justify-content-center py-5">
            <div class="login-box">
                <div class="card card-outline card-primary">
                    <div class="card-header text-center">
                        <p class="h1"><b>{{ __('Reset Password') }}</p>
                    </div>
                    <div class="card-body">
                        <p class="login-box-msg">You are only one step a way from your new password, recover your password
                            now.</p>
                        <form action="{{ route('admin.password.request') }}" method="post"
                            aria-label="{{ __('Reset Password') }}">
                            @csrf
                            <input type="hidden" name="token" value="{{ $token }}">
                            <div class="input-group mb-3">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ $email ?? old('email') }}" required autocomplete="email"
                                    autofocus>
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-envelope"></span>
                                    </div>
                                </div>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="input-group mb-3">
                                <input id="password" type="password" placeholder="{{ __('Password') }}"
                                    class="form-control @error('password') is-invalid @enderror" name="password" required
                                    autocomplete="new-password">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-lock"></span>
                                    </div>
                                </div>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="input-group mb-3">
                                <input id="password-confirm" type="password" placeholder="{{ __('Confirm Password') }}"
                                    class="form-control" name="password_confirmation" required autocomplete="new-password">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-lock"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary btn-block">
                                        {{ __('Reset Password') }}</button>
                                </div>
                                <!-- /.col -->
                            </div>
                        </form>

                        <p class="mt-3 mb-1">
                            <a href="{{ route('admin.login') }}"> {{ __('Login') }}</a>
                        </p>
                    </div>
                    <!-- /.login-card-body -->
                </div>
            </div>
            <!-- /

    </div>
    </div>
@endsection
