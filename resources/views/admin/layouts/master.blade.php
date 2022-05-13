<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>

    <!-- Scripts -->

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <link type="text/css" rel="stylesheet" href="{{ asset('css/image-uploader.min.css') }}">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        body {
            overflow-x: hidden;
        }

        @font-face {
            font-family: OptimusPrinceps;
            src: url('{{ asset('fonts/iu.ttf') }}');
        }

    </style>
    @yield('css')
</head>

@php
$setting = \App\Models\Setting::where('name', 'general_settings')->first();
$response = $setting->response;
@endphp

<body class="hold-transition sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper" id="app">

        @if (Auth::guard('admin')->check())
            {{-- navbar --}}
            @include('admin.layouts.nav')
            {{-- sidebar --}}
            @include('admin.layouts.aside', ['setting' => $setting, 'response' => $response])
        @endif

        <!-- Main Sidebar Container -->

        <div>
            @yield('content')
        </div>


        <!-- /.content-wrapper -->
        @if (Auth::guard('admin')->check())
            @include('admin-lte.footer')
        @endif
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/modal.js') }}"></script>
    <script src="{{ mix('js/popper.js') }}"></script>
    <script src="{{ asset('js/image-uploader.min.js') }}"></script>
    <script src="{{ asset('js/image.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/additional-methods.min.js"></script>
    <script src="http://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        @if (Session::has('success'))
            toastr.success('{!! session('success') !!}')
            @php
                session()->forget('success');
            @endphp
        @endif
        @if (Session::has('error'))
            toastr.error('{!! session('error') !!}')
            @php
                session()->forget('error');
            @endphp
        @endif
    </script>
    @stack('script')
</body>

</html>
