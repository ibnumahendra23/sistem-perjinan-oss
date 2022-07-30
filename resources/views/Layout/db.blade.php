<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>OSS</title>
    <meta name="viewport"
        content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="description" content="This is an example dashboard created using build-in elements and components.">
    <meta name="msapplication-tap-highlight" content="no">

    @yield('css')
    <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet">
    <style>
        .vertical-nav-menu li a.mm-active
        {
            color: #1758f2;
        }

        .vertical-nav-menu li a
        {
            color: #000;
        }
        .app-sidebar__heading
        {
            color: #5d5d7b;
        }
    </style>
</head>

<body>
    <div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">
        <div class="app-header header-shadow">
            <div class="app-header__logo">
                <div class="logo-src"></div>
                <div class="header__pane ml-auto">
                    <div>
                        <button type="button" class="hamburger close-sidebar-btn hamburger--elastic"
                            data-class="closed-sidebar">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
            <div class="app-header__mobile-menu">
                <div>
                    <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                        <span class="hamburger-box">
                            <span class="hamburger-inner"></span>
                        </span>
                    </button>
                </div>
            </div>
            <div class="app-header__menu">
                <span>
                    <button type="button"
                        class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                        <span class="btn-icon-wrapper">
                            <i class="fa fa-ellipsis-v fa-w-6"></i>
                        </span>
                    </button>
                </span>
            </div>
            <div class="app-header__content">
                <div class="app-header-left">
                </div>
                <div class="app-header-right">
                    <div class="header-btn-lg pr-0">
                        <div class="widget-content p-0">
                            <div class="widget-content-wrapper">
                                <div class="widget-content-left">
                                    <div class="btn-group">
                                        <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                            class="p-0 btn">
                                            <img width="42" class="rounded-circle" src="{{ asset('uploads/user/'.Auth::user()->gambar) }}"
                                                alt="">
                                            <i class="fa fa-angle-down ml-2 opacity-8"></i>
                                        </a>
                                        <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu dropdown-menu-right">
                                            <a href="{{ route('profile') }}" type="button" tabindex="0" class="dropdown-item">User Account</a>
                                            <div tabindex="-1" class="dropdown-divider"></div>
                                            <form action="{{ route('logout') }}" method="POST">
                                                @csrf
                                                <button type="submit" tabindex="0" class="dropdown-item">Logout</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="widget-content-left  ml-3 header-user-info">
                                    <div class="widget-heading">
                                        {{ Auth::user()->nama }}
                                    </div>
                                    <div class="widget-subheading">
                                        {{ Auth::user()->jabatan }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="app-main">
            <div class="app-sidebar sidebar-shadow">
                <div class="app-header__logo">
                    <div class="logo-src"></div>
                    <div class="header__pane ml-auto">
                        <div>
                            <button type="button" class="hamburger close-sidebar-btn hamburger--elastic"
                                data-class="closed-sidebar">
                                <span class="hamburger-box">
                                    <span class="hamburger-inner"></span>
                                </span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="app-header__mobile-menu">
                    <div>
                        <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
                <div class="app-header__menu">
                    <span>
                        <button type="button"
                            class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                            <span class="btn-icon-wrapper">
                                <i class="fa fa-ellipsis-v fa-w-6"></i>
                            </span>
                        </button>
                    </span>
                </div>
                <div class="scrollbar-sidebar">
                    <div class="app-sidebar__inner">
                        <ul class="vertical-nav-menu">
                            <li class="app-sidebar__heading">Dashboards</li>
                            <li>
                                <a href="{{ route('home') }}" class="{{ Route::currentRouteNamed('home') ? 'mm-active' : '' }}">
                                    <i class="metismenu-icon pe-7s-rocket"></i>
                                    Home
                                </a>
                            </li>
                            <li class="app-sidebar__heading">Menu</li>
                            <li>
                                <a href="" class="{{ Route::currentRouteNamed('pp.index', 'pp.create', 'pp.edit*', 'pp.show*', 'sp.index') ? 'mm-active' : '' }}">
                                    <i class="metismenu-icon pe-7s-albums"></i>
                                    Perijinan
                                    <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                                </a>
                                <ul class="{{ Route::currentRouteNamed('pp.index', 'pp.create', 'pp.edit*', 'pp.show*', 'sp.index') ? 'mm-show' : '' }}">
                                    <li>
                                        <a href="{{ route('pp.index') }}" class="{{ Route::currentRouteNamed('pp.index', 'pp.create', 'pp.edit*', 'pp.show*',) ? 'mm-active' : '' }}">
                                            <i class="metismenu-icon"></i>
                                            Perijinan
                                        </a>
                                    </li>
                                    @if (Auth::user()->role == 'admin'  || Auth::user()->role == 'superadmin')
                                    <li>
                                        <a href="{{ route('sp.index') }}" class="{{ Route::currentRouteNamed('sp.index') ? 'mm-active' : '' }}">
                                            <i class="metismenu-icon"></i>
                                            Semua Perijinan
                                        </a>
                                    </li>
                                    @endif
                                </ul>
                            </li>
                            @if (Auth::user()->role == 'superadmin')
                            <li>
                                <a href="" class="{{ Route::currentRouteNamed('user.index') ? 'mm-active' : '' }}">
                                    <i class="metismenu-icon pe-7s-user"></i>
                                    Users
                                    <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                                </a>
                                <ul class="{{ Route::currentRouteNamed('user.index') ? 'mm-show' : '' }}">
                                    <li>
                                        <a href="{{ route('user.index') }}" class="{{ Route::currentRouteNamed('user.index') ? 'mm-active' : '' }}">
                                            <i class="metismenu-icon"></i>
                                            All User
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
            <div class="app-main__outer">
                <div class="app-main__inner">
                    @yield('content')
                </div>
                <div class="app-wrapper-footer">
                    <div class="app-footer">
                        <div class="app-footer__inner">
                            <div class="app-footer-left">
                                <ul class="nav">
                                    <li class="nav-item">
                                        <a href="javascript:void(0);" class="nav-link">
                                            Footer Link 1
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="javascript:void(0);" class="nav-link">
                                            Footer Link 2
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="app-footer-right">
                                <ul class="nav">
                                    <li class="nav-item">
                                        <a href="javascript:void(0);" class="nav-link">
                                            Footer Link 3
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="javascript:void(0);" class="nav-link">
                                            <div class="badge badge-success mr-1 ml-0">
                                                <small>NEW</small>
                                            </div>
                                            Footer Link 4
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <script src="http://maps.google.com/maps/api/js?sensor=true"></script> --}}
        </div>
    </div>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js' integrity='sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==' crossorigin='anonymous'></script>
    <script type="text/javascript" src="{{ asset('assets/js/main.js') }}"></script>
    @yield('js')
</body>

</html>
