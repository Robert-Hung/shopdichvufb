<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="ltr">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
    <!-- Meta data -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <!-- Title -->
    <title>{{ $title }} - {{ env('APP_NAME') }}</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="api-token" content="{{ Auth::user()->api_token }}">
    <meta name="description"
        content="Hệ thống dịch vụ mạng xã hội Facebook | Instagram | Youtube | Tiktok | {{ url('') }}" />
    <meta name="keywords"
        content="like, sub, share, vip like, buff mắt, tăng follow, mua like, mua sub, sub rẻ, hack like, hack sub, hack follow, tăng like, tăng follow, tăng share, tăng comment, chéo like, chéo sub, shop sub" />
    <meta property="og:description"
        content="Hệ thống dịch vụ mạng xã hội Facebook | Instagram | Youtube | Tiktok | {{ url('') }}" />
    <meta name="copyright" content="" />
    <meta name="robots" content="index, follow" />
    <meta name='revisit-after' content='1 days' />
    <meta http-equiv="content-language" content="vi" />
    <meta property="og:url" content="{{ url('') }}" />
    <meta property="og:type" content="website" />
    <meta property="og:title"
        content="Hệ thống dịch vụ mạng xã hội Facebook | Instagram | Youtube | Tiktok | {{ url('') }}" />
    <meta property="og:locale" content="vi_VN" />
    <meta property="og:image" content="/assets/images/home-banner.jpg">
    <meta property="fb:app_id" content="" />
    <meta name="twitter:title"
        content="Hệ thống dịch vụ mạng xã hội Facebook | Instagram | Youtube | Tiktok | {{ url('') }}">
    <meta name="twitter:description"
        content="Hệ thống dịch vụ mạng xã hội Facebook | Instagram | Youtube | Tiktok | {{ url('') }}">

    <!--Favicon -->
    <link rel="icon" href="{{ asset('') }}assets/images/brand/favicon.ico" type="image/x-icon" />

    <!-- Bootstrap css -->
    <link href="{{ asset('') }}assets/plugins/bootstrap/css/bootstrap.css" rel="stylesheet" />

    <!-- Style css -->
    <link href="{{ asset('') }}assets/css/style.css" rel="stylesheet" />
    <link href="{{ asset('') }}assets/css/dark.css" rel="stylesheet" />
    <link href="{{ asset('') }}assets/css/skin-modes.css" rel="stylesheet" />

    <!-- Animate css -->
    <link href="{{ asset('') }}assets/plugins/animated/animated.css" rel="stylesheet" />

    <!--Sidemenu css -->
    <link href="{{ asset('') }}assets/css/sidemenu.css" rel="stylesheet">

    <!-- P-scroll bar css-->
    <link href="{{ asset('') }}assets/plugins/p-scrollbar/p-scrollbar.css" rel="stylesheet" />

    <!---Icons css-->
    <link href="{{ asset('') }}assets/plugins/icons/icons.css" rel="stylesheet" />

    <!---Sidebar css-->
    <link href="{{ asset('') }}assets/plugins/sidebar/sidebar.css" rel="stylesheet" />

    <!-- Select2 css -->
    <link href="{{ asset('') }}assets/plugins/select2/select2.min.css" rel="stylesheet" />


    <!--- INTERNAL jvectormap css-->
    <link href="{{ asset('') }}assets/plugins/jvectormap/jqvmap.css" rel="stylesheet" />

    <!-- INTERNAL Data table css -->
    <link href="{{ asset('') }}assets/plugins/datatable/css/dataTables.bootstrap4.min.css" rel="stylesheet" />

    <!-- INTERNAL Time picker css -->
    <link href="{{ asset('') }}assets/plugins/time-picker/jquery.timepicker.css" rel="stylesheet" />

    <!-- INTERNAL jQuery-countdowntimer css -->
    <link href="{{ asset('') }}assets/plugins/jQuery-countdowntimer/jQuery.countdownTimer.css" rel="stylesheet" />


    <!-- INTERNAL Switcher css -->
    <link href="{{ asset('') }}assets/switcher/css/switcher.css" rel="stylesheet" />
    <link href="{{ asset('') }}assets/switcher/demo.css" rel="stylesheet" />

</head>

<body class="app sidebar-mini light-menu" id="index1">

    <!-- Switcher -->
    <div class="switcher-wrapper">
        <div class="demo_changer">
            <div class="demo-icon bg_dark">
                <i class="fa fa-cog fa-spin  text_primary"></i>
            </div>
            <div class="form_holder sidebar-right1">
                <div class="row">
                    <div class="predefined_styles">
                        <div class="swichermainleft mb-4">
                            <h4>Navigation Style</h4>
                            <div class="pl-3 pr-3 pt-3">
                                <a class="btn ripple btn-success btn-block" href="verticalmenu.html"> Leftmenu</a>
                                <a class="btn ripple btn-danger btn-block" href="horizontal.html"> Horizontal </a>
                            </div>
                        </div>
                        <div class="swichermainleft">
                            <h4>Theme Layout</h4>
                            <div class="switch_section d-flex my-4">
                                <ul class="switch-buttons row">
                                    <li class="col-md-6 mb-0">
                                        <button type="button" id="background-left1"
                                            class="bg-left1 wscolorcode1 button-image"></button>
                                        <span class="d-block">Light Theme</span>
                                    </li>
                                    <li class="col-md-6 mb-0">
                                        <button type="button" id="background-left2"
                                            class="bg-left2 wscolorcode1 button-image"></button>
                                        <span class="d-block">Dark Theme</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="swichermainleft">
                            <h4>Header Styles Mode</h4>
                            <div class="switch_section d-flex my-4">
                                <ul class="switch-buttons row">
                                    <li class="col-md-6 light-bg">
                                        <button type="button" id="background1"
                                            class="bg1 wscolorcode1 button-image"></button>
                                        <span class="d-block">Light Header</span>
                                    </li>
                                    <li class="col-md-6">
                                        <button type="button" id="background2"
                                            class="bg2 wscolorcode1 button-image"></button>
                                        <span class="d-block">Color Header</span>
                                    </li>
                                    <li class="col-md-6 d-block mx-auto dark-bg">
                                        <button type="button" id="background3"
                                            class="bg3 wscolorcode1 button-image"></button>
                                        <span class="d-block">Dark Header</span>
                                    </li>
                                    <li class="col-md-6 d-block mx-auto">
                                        <button type="button" id="background11"
                                            class="bg8 wscolorcode1 button-image"></button>
                                        <span class="d-block">Gradient Header</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="swichermainleft">
                            <h4>Leftmenu Styles Mode</h4>
                            <div class="switch_section d-flex my-4">
                                <ul class="switch-buttons row">
                                    <li class="col-md-6 mb-4">
                                        <button type="button" id="background4"
                                            class="bg4 wscolorcode1 button-image"></button>
                                        <span class="d-block">Light Menu</span>
                                    </li>
                                    <li class="col-md-6 mb-4">
                                        <button type="button" id="background5"
                                            class="bg5 wscolorcode1 button-image"></button>
                                        <span class="d-block">Color Menu</span>
                                    </li>
                                    <li class="col-md-6 mb-0 d-block mx-auto dark-bgmenu">
                                        <button type="button" id="background6"
                                            class="bg6 wscolorcode1 button-image"></button>
                                        <span class="d-block">Dark Menu</span>
                                    </li>
                                    <li class="col-md-6 mb-0 d-block mx-auto">
                                        <button type="button" id="background10"
                                            class="bg7 wscolorcode1 button-image"></button>
                                        <span class="d-block">Gradient Menu</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Switcher -->

    <!---Global-loader-->
    <div id="global-loader">
        <img src="{{ asset('') }}assets/images/svgs/loader.svg" alt="loader">
    </div>
