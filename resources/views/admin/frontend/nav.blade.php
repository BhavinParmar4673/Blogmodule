<header class="header_menu">
    <div class="main_menu">
        <nav class="navbar navbar-expand-lg navbar-light" id="mainNav">
            <div class="container ">
                <a class="navbar-brand" href="{{URL('/')}}"> <img class="img-fluid"
                    src="{{ asset('Image/xlogo.png.pagespeed.ic.KBn90ATyWc.png') }}" alt="no-image"></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
                    aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fas fa-bars"></i>
                </button>
                <div class="collapse navbar-collapse offset" id="navbarResponsive">
                    <ul class="nav navbar-nav menu_nav">
                        <li class="{{request()->is('/') ? 'nav-item active' : 'nav-item' }}"><a class="nav-link py-3 px-0 px-lg-3" href="{{URL('/')}}">HOME</a></li>
                        <li class="nav-item"><a class="nav-link py-3 px-0 px-lg-3" href="#about">ABOUT</a></li>
                        <li class="{{request()->is('admin/project') || request()->is('admin/projects/*') ? 'nav-item active' : 'nav-item' }}"><a class="nav-link py-3 px-0 px-lg-3" href="{{route('admin.project')}}">PORTFOLIO</a></li>
                        <li class="{{request()->is('admin/post') || request()->is('admin/posts/*') ? 'nav-item active' : 'nav-item' }}"><a class="nav-link py-3 px-0 px-lg-3" href="{{route('admin.post')}}">BLOG</a></li>
                        <li class="{{request()->is('admin/contact') ? 'nav-item active' : 'nav-item' }}"><a class="nav-link py-3 px-0 px-lg-3" href="{{route('admin.contact')}}">CONTACT</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</header>
