<aside class="main-sidebar sidebar-dark-primary elevation-4">

    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <img src="{{ asset('img/AdminLTELogo.png') ?? $setting->logo }}" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">{{ $response->store_name ?? '' }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('img/avatar5.png') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth::guard('admin')->user()->name }}</a>
            </div>
        </div>
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                {{-- <li class="nav-item">
                    <a href="{{ route('admin.posts.index') }}"
                        class="{{ request()->is('admin/posts') || request()->is('admin/posts/*') ? 'nav-link active' : 'nav-link' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Post
                            <span class="badge badge-danger right">{{ App\Models\Post::all()->count() }}</span>
                        </p>
                    </a>
                </li> --}}
                <li class="nav-item">
                    <a href="{{ route('admin.projects.index') }}"
                        class="{{ request()->is('admin/projects') || request()->is('admin/projects/*') ? 'nav-link active' : 'nav-link' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Project
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.category.index') }}"
                        class="{{ request()->is('admin/category') ? 'nav-link active' : 'nav-link' }}">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Category
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.service.index') }}"
                        class="{{ request()->is('admin/service') || request()->is('admin/service/*') ? 'nav-link active' : 'nav-link' }}">
                        <i class="nav-icon fa fa-wrench"></i>
                        <p>
                            Service
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.employee.index') }}"
                        class="{{ request()->is('admin/employee') || request()->is('admin/employee/*') ? 'nav-link active' : 'nav-link' }}">
                        <i class="nav-icon fa fa-users"></i>
                        <p>
                            Employee
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.tag.index') }}"
                        class="{{ Request::path() == 'admin/tag' ? 'nav-link active' : 'nav-link' }}">
                        <i class="nav-icon fa fa-tag"></i>
                        <p>
                            Tag
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.testimonials.index') }}"
                        class="{{ request()->is('admin/testimonials') || request()->is('admin/testimonials/*') ? 'nav-link active' : 'nav-link' }}">
                        <i class="nav-icon fa fa-quote-left"></i>
                        <p>
                            Testimonial
                        </p>
                    </a>
                </li>
                {{-- <li class="nav-item">
                    <a href="{{ route('admin.sliders.index') }}"
                        class="{{ request()->is('admin/sliders') || request()->is('admin/sliders/*') ? 'nav-link active' : 'nav-link' }}">
                        <i class="nav-icon fa fa-image"></i>
                        <p>
                            Slide
                        </p>
                    </a>
                </li> --}}
                <li class="nav-item">
                    <a href="{{ route('admin.website-setting') }}"
                        class="{{ request()->is('admin/website-setting') || request()->is('admin/settings') || request()->is('admin/smtp') ? 'nav-link active' : 'nav-link' }}">
                        <i class="nav-icon align-middle m-1 fa fa-cog f-18 px-1"></i>
                        <p class="align-middle">
                            Setting
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.contact.index') }}"
                        class="{{ request()->is('admin/contact') || request()->is('admin/contact/*') ? 'nav-link active' : 'nav-link' }}">
                        <i class="nav-icon 	fa fa-address-card"></i>
                        <p>
                            Contact Us
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.about-us.index') }}"
                        class="{{ request()->is('admin/about-us') || request()->is('admin/about-us/*') ? 'nav-link active' : 'nav-link' }}">
                        <i class="nav-icon fa fa-solid fa-info"></i>
                        <p>
                            About US
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
