
    <div class="page">
        <div class="page-main">

            <!--aside open-->
            <aside class="app-sidebar">
                <div class="app-sidebar__logo">
                    <a class="header-brand" href="{{ route('home') }}">
                        {{-- <img src="{{ asset('') }}assets/images/brand/logo.png" class="header-brand-img desktop-lgo"
                            alt="Dayonelogo">
                        <img src="{{ asset('') }}assets/images/brand/logo-white.png"
                            class="header-brand-img dark-logo" alt="Dayonelogo">
                        <img src="{{ asset('') }}assets/images/brand/favicon.png"
                            class="header-brand-img mobile-logo" alt="Dayonelogo">
                        <img src="{{ asset('') }}assets/images/brand/favicon1.png"
                            class="header-brand-img darkmobile-logo" alt="Dayonelogo"> --}}
                            laravel
                    </a>
                </div>
                <div class="app-sidebar3">{{-- 
                    <div class="app-sidebar__user">
                        <div class="dropdown user-pro-body text-center">
                            <div class="user-pic">
                                <img src="https://ui-avatars.com/api/?background=random&name={{ Auth::user()->name }}" alt="user-img"
                                    class="avatar-xxl rounded-circle mb-1">
                            </div>
                            <div class="user-info">
                                <h5 class=" mb-2">{{ Auth::user()->name }}</h5>
                                <span class="text-muted app-sidebar__user-name text-sm">
                                    @if (Auth::user()->role == 1)
                                        Thành viên
                                    @elseif (Auth::user()->role == 2)
                                        Cộng tác viên
                                    @elseif (Auth::user()->role == 3)
                                        Đại lí
                                    @else
                                        Quản trị viên
                                    @endif
                                </span>
                            </div>
                        </div>
                    </div> --}}
                    <ul class="side-menu">
                        <li class="side-item side-item-category mt-4">Main</li>
                        <li class="slide">
                            <a class="side-menu__item" data-toggle="slide" href="{{ route('home') }}">
                                <img src="{{ asset('assets/images/client/house.png') }}" class="sidemenu_icon"
                                    style="width: 30px" alt="">
                                <span class="side-menu__label">Trang chủ</span>
                            </a>
                        </li>
                        <li class="slide">
                            <a class="side-menu__item" href="{{ route('account.profile') }}">
                                <img src="{{ asset('assets/images/client/user.png') }}" class="sidemenu_icon"
                                    style="width: 30px" alt="">

                                <span class="side-menu__label">Tài khoản của tôi</span>
                            </a>
                        </li>
                        <li class="slide">
                            <a class="side-menu__item" href="{{ route('recharge.banking') }}">
                                <img src="{{ asset('assets/images/client/credit-card.png') }}" class="sidemenu_icon"
                                    style="width: 30px" alt="">

                                <span class="side-menu__label">Nạp tiền vào tài khoản</span>
                            </a>
                        </li>
                        <li class="slide">
                            <a class="side-menu__item" href="{{ route('account.history') }}">
                                <img src="{{ asset('assets/images/client/medical-record.png') }}"
                                    class="sidemenu_icon" style="width: 30px" alt="">

                                <span class="side-menu__label">Lịch sử tài khoản</span>
                            </a>
                        </li>
                        <li class="slide">
                            <a class="side-menu__item" href="{{ route('account.upgrade-level') }}">
                                <img src="{{ asset('assets/images/client/crown.png') }}" class="sidemenu_icon"
                                    style="width: 30px" alt="">

                                <span class="side-menu__label">Cấp bậc tài khoản</span>
                            </a>
                        </li>
                        <li class="side-item side-item-category">Dịch vụ</li>
                        {{-- <li class="slide">
                            <a class="side-menu__item" data-toggle="slide" href="#">
                                <img src="{{ asset('assets/images/client/facebook.png') }}" class="sidemenu_icon"
                                    style="width: 30px" alt="">

                                <span class="side-menu__label">Dịch vụ facebook</span><i
                                    class="angle fa fa-angle-right"></i></a>
                            <ul class="slide-menu">
                                <li><a href="{{ route('service.facebook.like-gia-re') }}" class="slide-item"> Like giá rẻ </a></li>
                                <li><a href="calendar.html" class="slide-item"> Like chất lượng </a></li>
                                <li><a href="calendar.html" class="slide-item"> Like bình luận </a></li>
                                <li><a href="calendar.html" class="slide-item"> Tăng bình luận </a></li>
                                <li><a href="calendar.html" class="slide-item"> Tăng theo dõi </a></li>
                                <li><a href="calendar.html" class="slide-item"> Tăng like page </a></li>
                                <li><a href="calendar.html" class="slide-item"> Tăng mem group </a></li>
                                <li><a href="calendar.html" class="slide-item"> Tăng view video </a></li>
                                <li><a href="calendar.html" class="slide-item"> Tăng mắt livestream </a></li>
                                <li><a href="calendar.html" class="slide-item"> Tăng share </a></li>
                                <li><a href="calendar.html" class="slide-item"> Tăng view story </a></li>
                            </ul>
                        </li> --}}
                        <li class="slide">
                            <a class="side-menu__item" data-toggle="slide" href="#">
                                <img src="{{ asset('assets/images/client/facebook.png') }}" class="sidemenu_icon"
                                    style="width: 30px" alt="">

                                <span class="side-menu__label">Dịch vụ facebook</span><i
                                    class="angle fa fa-angle-right"></i></a>
                            <ul class="slide-menu">
                                <li><a href="{{ route('service.facebook-v2.like-post-sale') }}" class="slide-item"> Tăng like bài viết (sale)</a></li>
                                <li><a href="{{ route('service.facebook-v2.like-post-speed') }}" class="slide-item"> Tăng like bài viết (speed)</a></li>
                                <li><a href="{{ route('service.facebook-v2.comment-sale') }}" class="slide-item"> Tăng bình luận (sale)</a></li>
                                <li><a href="{{ route('service.facebook-v2.comment-speed') }}" class="slide-item"> Tăng bình luận (speed)</a></li>
                                <li><a href="{{ route('service.facebook-v2.sub-vip') }}" class="slide-item"> Tăng sub/follow (vip)</a></li>
                                <li><a href="{{ route('service.facebook-v2.sub-quality') }}" class="slide-item"> Tăng sub/follow (quality)</a></li>
                                <li><a href="{{ route('service.facebook-v2.sub-sale') }}" class="slide-item"> Tăng sub/follow (sale)</a></li>
                                <li><a href="{{ route('service.facebook-v2.sub-speed') }}" class="slide-item"> Tăng sub/follow (speed)</a></li>
                                <li><a href="{{ route('service.facebook-v2.like-page-quality') }}" class="slide-item"> Tăng like/follow page (quality)</a>
                                </li>
                                <li><a href="{{ route('service.facebook-v2.like-page-sale') }}" class="slide-item"> Tăng like/follow page (sale)</a>
                                </li>
                                <li><a href="{{ route('service.facebook-v2.like-page-speed') }}" class="slide-item"> Tăng like/follow page (speed)</a>
                                </li>
                                <li><a href="{{ route('service.facebook-v2.eye-live') }}" class="slide-item"> Tăng mắt live</a></li>
                                <li><a href="{{ route('service.facebook-v2.share-profile') }}" class="slide-item"> Tăng share (profile)</a></li>
                                <li><a href="{{ route('service.facebook-v2.member-group') }}" class="slide-item"> Tăng thành viên nhóm</a></li>
                                <li><a href="{{ route('service.facebook-v2.view-story') }}" class="slide-item"> Tăng view story</a></li>
                            </ul>
                        </li>
                        <li class="slide">
                            <a class="side-menu__item" data-toggle="slide" href="#">
                                <img src="{{ asset('assets/images/client/instagram.png') }}" class="sidemenu_icon"
                                    style="width: 30px" alt="">

                                <span class="side-menu__label">Dịch vụ Instagram</span><i
                                    class="angle fa fa-angle-right"></i></a>
                            <ul class="slide-menu">
                                <li><a href="{{ route('service.instagram.like-post') }}" class="slide-item"> Tăng like bài viết</a></li>
                                <li><a href="{{ route('service.instagram.sub') }}" class="slide-item"> Tăng sub/follow</a></li>
                            </ul>
                        </li>
                        <li class="slide">
                            <a class="side-menu__item" data-toggle="slide" href="#">
                                <img src="{{ asset('assets/images/client/tiktok.png') }}" class="sidemenu_icon"
                                    style="width: 30px" alt="">

                                <span class="side-menu__label">Dịch vụ Tiktok</span><i
                                    class="angle fa fa-angle-right"></i></a>
                            <ul class="slide-menu">
                                <li><a href="{{ route('service.tiktok.like') }}" class="slide-item"> Tăng like (thả tim)</a></li>
                                <li><a href="{{ route('service.tiktok.comment') }}" class="slide-item"> Tăng bình luận</a></li>
                                <li><a href="{{ route('service.tiktok.share') }}" class="slide-item"> Tăng chia sẻ</a></li>
                                <li><a href="{{ route('service.tiktok.sub') }}" class="slide-item"> Tăng sub/follow</a></li>
                                <li><a href="{{ route('service.tiktok.view') }}" class="slide-item"> Tăng view video</a></li>
                            </ul>
                        </li>
                        <li class="side-item side-item-category">Support</li>
                        <li class="slide">
                            <a class="side-menu__item" data-toggle="slide" href="#">
                                <i class="feather feather-file sidemenu_icon"></i>
                                <span class="side-menu__label">Liên hệ hỗ trợ</span><i
                                    class="angle fa fa-angle-right"></i></a>
                            <ul class="slide-menu">
                                <li><a href="#" onclick="window.open('https://fb.com/')" class="slide-item"> Liên
                                        hệ facebook </a></li>
                                <li><a href="#" onclick="window.open('https://zalo.me/')" class="slide-item"> Liên
                                        hệ zalo</a></li>
                            </ul>
                        </li>
                        @if (Auth::user()->role == 99)
                            <li class="slide">
                                <a class="side-menu__item" href="{{ route('admin.index') }}">
                                    <img src="{{ asset('assets/images/client/user.png') }}" class="sidemenu_icon"
                                        style="width: 30px" alt="">

                                    <span class="side-menu__label">Trang quản trị</span>
                                </a>
                            </li>
                        @endif
                    </ul>
                    </li>
                    </ul>
                </div>
            </aside>
            <!--aside closed-->

            <div class="app-content main-content">
                <div class="side-app">

                    <!--app header-->
                    <div class="app-header header">
                        <div class="container-fluid">
                            <div class="d-flex">
                                <a class="header-brand" href="index.html">
                                    <img src="{{ asset('') }}assets/images/brand/logo.png"
                                        class="header-brand-img desktop-lgo" alt="Dayonelogo">
                                    <img src="{{ asset('') }}assets/images/brand/logo-white.png"
                                        class="header-brand-img dark-logo" alt="Dayonelogo">
                                    <img src="{{ asset('') }}assets/images/brand/favicon.png"
                                        class="header-brand-img mobile-logo" alt="Dayonelogo">
                                    <img src="{{ asset('') }}assets/images/brand/favicon1.png"
                                        class="header-brand-img darkmobile-logo" alt="Dayonelogo">
                                </a>
                                <div class="app-sidebar__toggle" data-toggle="sidebar">
                                    <a class="open-toggle" href="#">
                                        <i class="feather feather-menu"></i>
                                    </a>
                                    <a class="close-toggle" href="#">
                                        <i class="feather feather-x"></i>
                                    </a>
                                </div>
                                <div class="mt-0">
                                    <form class="form-inline">
                                        <div class="search-element">
                                            <input type="search" class="form-control header-search"
                                                placeholder="Search…" aria-label="Search" tabindex="1">
                                            <button class="btn btn-primary-color">
                                                <i class="feather feather-search"></i>
                                            </button>
                                        </div>
                                    </form>
                                </div><!-- SEARCH -->
                                <div class="d-flex order-lg-2 my-auto ml-auto">
                                    <a class="nav-link my-auto icon p-0 nav-link-lg d-md-none navsearch" href="#"
                                        data-toggle="search">
                                        <i class="feather feather-search search-icon header-icon"></i>
                                    </a>
                                    <div class="dropdown header-fullscreen">
                                        <a class="nav-link icon full-screen-link">
                                            <i
                                                class="feather feather-maximize fullscreen-button fullscreen header-icons"></i>
                                            <i
                                                class="feather feather-minimize fullscreen-button exit-fullscreen header-icons"></i>
                                        </a>
                                    </div>
                                    <div class="dropdown header-message">
                                        <a class="nav-link icon" data-toggle="dropdown">
                                            <i class="feather feather-mail header-icon"></i>
                                            <span class="badge badge-success side-badge">1</span>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow  animated">
                                            <div class="header-dropdown-list message-menu" id="message-menu">
                                                <a class="dropdown-item border-bottom" href="#">
                                                    <div class="d-flex align-items-center">
                                                        <div class="">
                                                            <span
                                                                class="avatar avatar-md brround align-self-center cover-image"
                                                                data-image-src="{{ asset('') }}assets/images/users/6.jpg"></span>
                                                        </div>
                                                        <div class="d-flex">
                                                            <div class="pl-3">
                                                                <h6 class="mb-1">Lương Bình Dương</h6>
                                                                <p class="fs-13 mb-1">succesful</p>
                                                                <div class="small text-muted">
                                                                    3 days ago
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="dropdown profile-dropdown">
                                        <a href="#" class="nav-link pr-1 pl-0 leading-none" data-toggle="dropdown">
                                            <span>
                                                <img src="https://ui-avatars.com/api/?background=random&name={{ Auth::user()->name }}" alt="img"
                                                    class="avatar avatar-md bradius">
                                            </span>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow animated">
                                            <div class="p-3 text-center border-bottom">
                                                <a href="#"
                                                    class="text-center user pb-0 font-weight-bold">{{ Auth::user()->name }}</a>
                                                <p class="text-center user-semi-title">
                                                    @if (Auth::user()->role == 1)
                                                        Thành viên
                                                    @elseif (Auth::user()->role == 2)
                                                        Cộng tác viên
                                                    @elseif (Auth::user()->role == 3)
                                                        Đại lí
                                                    @elseif (Auth::user()->role == 4)
                                                        NPP
                                                    @else
                                                        Quản trị viên
                                                    @endif
                                                </p>
                                            </div>
                                            <a class="dropdown-item d-flex" href="{{ route('account.profile') }}">
                                                <i class="feather feather-user mr-3 fs-16 my-auto"></i>
                                                <div class="mt-1">Tài khoản của tôi</div>
                                            </a>
                                            <a class="dropdown-item d-flex" href="#" data-toggle="modal"
                                                data-target="#changepasswordnmodal">
                                                <i class="feather feather-edit-2 mr-3 fs-16 my-auto"></i>
                                                <div class="mt-1">Nạp tiền</div>
                                            </a>
                                            <a class="dropdown-item d-flex" href="{{ route('logout') }}">
                                                <i class="feather feather-power mr-3 fs-16 my-auto"></i>
                                                <div class="mt-1">Đăng xuất</div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/app header-->
                    @yield('content')