<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
    <script nonce="b26d3dbe-7cd4-42b6-83ca-580e1a5244bf"> (function(w, d) { ! function(a, e, t, r) { a.zarazData = a.zarazData || {}, a.zarazData.executed = [], a.zarazData.tracks = [], a.zaraz = { deferred: [] }, a.zaraz.track = (e, t) => { for (key in a.zarazData.tracks.push(e), t) a.zarazData["z_" + key] = t[key] }, a.zaraz._preSet = [], a.zaraz.set = (e, t, r) => { a.zarazData["z_" + e] = t, a.zaraz._preSet.push([e, t, r]) }, a.addEventListener("DOMContentLoaded", (() => { var t = e.getElementsByTagName(r)[0], z = e.createElement(r), n = e.getElementsByTagName("title")[0]; n && (a.zarazData.t = e.getElementsByTagName("title")[0].text), a.zarazData.w = a.screen .width, a.zarazData.h = a.screen.height, a.zarazData.j = a.innerHeight, a.zarazData .e = a.innerWidth, a.zarazData.l = a.location.href, a.zarazData.r = e.referrer, a .zarazData.k = a.screen.colorDepth, a.zarazData.n = e.characterSet, a.zarazData.o = (new Date).getTimezoneOffset(), z.defer = !0, z.src = "../../cdn-cgi/zaraz/sd0d9.js?z=" + btoa(encodeURIComponent(JSON.stringify(a .zarazData))), t.parentNode.insertBefore(z, t) })) }(w, d, 0, "script"); })(window, document); </script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }} - {{ env('APP_NAME') }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&amp;display=fallback">

    <link rel="stylesheet" href="{{ asset('') }}plugins/fontawesome-free/css/all.min.css">

    <link rel="stylesheet" href="{{ asset('') }}plugins/overlayScrollbars/css/OverlayScrollbars.min.css">

    <link rel="stylesheet" href="{{ asset('') }}dist/css/adminlte.min2167.css?v=3.2.0"> --}}
    
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&amp;display=fallback">

    <link rel="stylesheet" href="{{ asset('') }}plugins/fontawesome-free/css/all.min.css">

    <link rel="stylesheet" href="{{ asset('') }}plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('') }}plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('') }}plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

    <link rel="stylesheet" href="{{ asset('') }}dist/css/adminlte.min2167.css?v=3.2.0">
</head>

<body class="sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">

        <div class="preloader flex-column justify-content-center align-items-center">
            <script type="text/javascript" style="display:none">
                //<![CDATA[
                window.__mirage2 = {
                    petok: "b5f2ab87ebd4e1233a9862b689c7f43a0ef9e22f-1648306627-1800"
                };
                //]]>
            </script>
            <script type="text/javascript"
                        src="../../../ajax.cloudflare.com/cdn-cgi/scripts/04b3eb47/cloudflare-static/mirage2.min.js"></script>
            <img class="animation__wobble" data-cfsrc="{{ asset('') }}dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60"
                width="60" style="display:none;visibility:hidden;"><noscript><img class="animation__wobble"
                    src="{{ asset('') }}dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60"></noscript>
        </div>

        <nav class="main-header navbar navbar-expand navbar-dark">

            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{ route('admin.index') }}" class="nav-link">Home</a>
                </li>
            </ul>

            <ul class="navbar-nav ml-auto">

                <li class="nav-item">
                    <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                        <i class="fas fa-search"></i>
                    </a>
                    <div class="navbar-search-block">
                        <form class="form-inline">
                            <div class="input-group input-group-sm">
                                <input class="form-control form-control-navbar" type="search" placeholder="Search"
                                    aria-label="Search">
                                <div class="input-group-append">
                                    <button class="btn btn-navbar" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                    <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                        <i class="fas fa-th-large"></i>
                    </a>
                </li>
            </ul>
        </nav>