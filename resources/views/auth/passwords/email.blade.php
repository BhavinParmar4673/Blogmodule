@extends('layouts.master')
@section('content')
    <div class="container py-4">
        <div class="d-flex align-items-center justify-content-center py-4">
            <div class="login-box">
                <div class="card card-outline card-primary">
                    <div class="card-header text-center">
                        <p class="h1"><b>{{ __('Reset Password') }}</p>
                    </div>
                    <div class="card-body">
                        <p class="login-box-msg">You forgot your password? Here you can easily retrieve a new password.</p>
                        <form action="{{ route('password.email') }}" method="post">
                            @csrf
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif
                            <div class="input-group mb-3">
                                <input id="email" type="email" placeholder="{{ __('E-Mail Address') }}"
                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                    value="{{ old('email') }}" required autocomplete="email" autofocus>

                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-envelope"></span>
                                    </div>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary btn-block">
                                        {{ __('Send Password Reset Link') }}</button>
                                </div>
                                <!-- /.col -->
                            </div>
                        </form>
                        <p class="mt-3 mb-1">
                            <a href="{{ route('login') }}"> {{ __('Login') }}</a>
                        </p>
                    </div>
                    <!-- /.login-card-body -->
                </div>
            </div>
            <!-- /.login-box -->
        </div>
    </div>

    <!-- /.login-box -->
@endsection
