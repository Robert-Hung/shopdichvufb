
        <aside class="main-sidebar sidebar-dark-primary elevation-4">

            <a href="{{ route('admin.index') }}" class="brand-link">
                <img data-cfsrc="{{ asset('') }}dist/img/AdminLTELogo.png" alt="AdminLTE Logo"
                    class="brand-image img-circle elevation-3" data-cfstyle="opacity: .8"
                    style="display:none;visibility:hidden;"><noscript><img src="{{ asset('') }}dist/img/AdminLTELogo.png"
                        alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8"></noscript>
                <span class="brand-text font-weight-light">ADMIN</span>
            </a>

            <div class="sidebar">

                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img data-cfsrc="{{ asset('') }}dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image"
                            style="display:none;visibility:hidden;"><noscript><img src="{{ asset('') }}dist/img/user2-160x160.jpg"
                                class="img-circle elevation-2" alt="User Image"></noscript>
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">{{ Auth::user()->name }}</a>
                    </div>
                </div>

                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">

                        <li class="nav-item menu-open">
                            <a href="{{ route('admin.index') }}" class="nav-link">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Trang quản trị
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.setting_website') }}" class="nav-link">
                                <i class="nav-icon fas fa-microchip"></i>
                                <p>
                                    Cài đặt website
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.manage_user') }}" class="nav-link">
                                <i class="nav-icon fas fa-user"></i>
                                <p>
                                    Quản lí thành viên

                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.setting_notification') }}" class="nav-link">
                                <i class="nav-icon fas fa-bell"></i>
                                <p>
                                    Cài đặt thông báo
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.setting_charge') }}" class="nav-link">
                                <i class="nav-icon fas fa-university"></i>
                                <p>
                                    Cài đặt nạp tiền
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.history_charge') }}" class="nav-link">
                                <i class="nav-icon fas fa-credit-card"></i>
                                <p>
                                    Quản lí nạp tiền
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.block_ip') }}" class="nav-link">
                                <i class="nav-icon fas fa-ban"></i>
                                <p>
                                    Block ip User
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.order-manage') }}" class="nav-link">
                                <i class="nav-icon fas fa-heart"></i>
                                <p>
                                    Quản lí đơn hàng
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.setting_service') }}" class="nav-link">
                                <i class="nav-icon fas fa-list"></i>
                                <p>
                                    Cài đặt dịch vụ
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.setting_admin') }}" class="nav-link">
                                <i class="nav-icon fas fa-user-plus"></i>
                                <p>
                                   Cài đặt admin
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('home') }}" class="nav-link">
                                <i class="nav-icon fas fa-logout"></i>
                                <p>
                                   Về trang chủ
                                </p>
                            </a>
                        </li>
                    </ul>
                </nav>

            </div>
        </aside>

        <div class="content-wrapper">

            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Trang quản trị </h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Admin</a></li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>


            <section class="content">
                <div class="container-fluid">

        @yield('content')
