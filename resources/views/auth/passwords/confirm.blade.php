@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="d-flex align-items-center justify-content-center py-4">
            <div class="login-box">
                <!-- /.login-logo -->
                <div class="card card-outline card-primary">
                    <div class="card-header text-center">
                        <p class="h1"><b>{{ __('Confirm Password') }}</p>
                    </div>
                    <div class="card-body">
                        <p class="login-box-msg">Sign in to start your session</p>
                        <form method="POST" action="{{ route('password.confirm') }}">
                            @csrf
                            {{ __('Please confirm your password before continuing.') }}
                            <div class="input-group mb-3">
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password" required
                                    autocomplete="current-password">
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
                            <div class="row">
                                <div class="col-6">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Confirm Password') }}
                                    </button>
                                </div>
                            </div>
                            <!-- /.col -->
                            <div class="col-6">
                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                            <!-- /.col -->
                    </div>
                    </form>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
    </div>

    <!-- /.login-box -->
@endsection
