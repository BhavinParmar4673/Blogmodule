<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('admin.home') }}" class="brand-link" style="border-bottom: none;">
        <img src="{{ asset('img/avatar5.png') ?? $setting->logo }}" alt="AdminLTE Logo" class="brand-image">
        <span class="brand-text font-weight-light"
            style=" font-size: 16px; font-weight: 600 !important; ">{{ $response->store_name }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item p-1 ">
                    <a href="{{ route('admin.home') }}" class="nav-link {{ Helper::isActive(['admin.home']) }}">
                        <i class="nav-icon align-middle m-1 fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.employee.index') }}"
                        class="nav-link {{ Helper::isActive(['employee.*']) }}">
                        <i class="nav-icon align-middle fa fa-users"></i>
                        <p>
                            Employee
                        </p>
                    </a>
                </li>

                <li class="nav-item ">
                    <a href="{{ route('admin.projects.index') }}"
                        class="nav-link {{ Helper::isActive(['projects.*']) }}">
                        <i class="nav-icon align-middle fas m-1 fa-clipboard-list"></i>
                        <p>
                            Project
                        </p>
                    </a>
                </li>

                <li class="nav-item ">
                    <a href="{{ route('admin.service.index') }}"
                        class="nav-link {{ Helper::isActive(['service.*']) }}">
                        <i class="nav-icon align-middle fa fa-wrench"></i>
                        <p>
                            Service
                        </p>
                    </a>
                </li>

                <li class="nav-item ">
                    <a href="{{ route('admin.category.index') }}"
                        class="nav-link {{ Helper::isActive(['category.*']) }}">
                        <i class="nav-icon align-middle fas m-1 fa-clipboard-list"></i>
                        <p>
                            Categories
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.tag.index') }}" class="nav-link {{ Helper::isActive(['tag.*']) }}">
                        <i class="nav-icon fa fa-tag"></i>
                        <p>
                            Tag
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.contact.index') }}"
                        class="nav-link {{ Helper::isActive(['contact.*']) }}">
                        <i class="nav-icon align-middle fa fa-address-card"></i>
                        <p>
                            Contact
                        </p>
                    </a>
                </li>

                <li class="nav-item ">
                    <a href="{{ route('admin.testimonials.index') }}"
                        class="nav-link {{ Helper::isActive(['testimonials.*']) }}">
                        <i class="nav-icon align-middle fa fa-quote-left"></i>
                        <p>
                            Testimonial
                        </p>
                    </a>
                </li>

                <li
                    class="nav-item has-treeview {{ Helper::isActive(['website-setting', 'website-setting.*', 'settings.*', 'smtp.*', 'about-us.*'], 'menu-open') }} ">
                    <a href="pages/widgets.html"
                        class="nav-link  {{ Helper::isActive(['user.*', 'role.*', 'permission.*']) }}">
                        <i class="nav-icon align-middle m-1 fa fa-cog f-18 "></i>
                        <p> Website setting <i class="right fa fa-angle-left"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.website-setting') }}"
                                class="nav-link {{ Helper::isActive(['website-setting', 'website-setting.*', 'settings.*', 'smtp.*']) }}">
                                <i class="nav-icon align-middle m-1 fa fa-cog f-18 px-1"></i>
                                <p class="align-middle">
                                    Setting
                                </p>
                            </a>
                        </li>

                        <li class="nav-item ">
                            <a href="{{ route('admin.about-us.index') }}"
                                class="nav-link {{ Helper::isActive(['about-us.*']) }}">
                                <i class="nav-icon align-middle fa fa-solid fa-info"></i>
                                <p>
                                    About US
                                </p>
                            </a>
                        </li>

                    </ul>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
