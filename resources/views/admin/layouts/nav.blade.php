  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light shadow-sm">

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false"
        aria-label="{{ __('Toggle navigation') }}">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <!-- Left Side Of Navbar -->
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                        class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="{{ route('admin.posts.index') }}" class="nav-link">Home</a>
            </li>
        </ul>

        <!-- Left navbar links -->
        {{-- <a class="navbar-brand text-center" href="{{ route('admin.home') }}">
            {{ config('app.name', 'Laravel') }} :: Admin
        </a> --}}


        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <!-- Authentication Links -->
                @if (Auth::guard('admin')->guest())
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.login') }}">{{ __('Login') }}</a>
                    </li>
              

                @if (Route::has('admin.register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.register') }}">{{ __('Register') }}</a>
                    </li>
                @endif
            @else
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::guard('admin')->user()->name }} <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('admin.logout') }}" onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('admin.logout') }}" method="POST"
                            style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
                @endif
        </ul>
    </div>
   </nav>
<!-- /.navbar -->