<!DOCTYPE html>
<html lang="en">

<head>
    <title>{{ __('Admin Control Panel') }}l</title>

    <!--[if lt IE 10]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description"
        content="Admindek Bootstrap admin template made using Bootstrap 4 and it has huge amount of ready made feature, UI components, pages which completely fulfills any dashboard needs.">
    <meta name="keywords"
        content="flat ui, admin Admin , Responsive, Landing, Bootstrap, App, Template, Mobile, iOS, Android, apple, creative app">
    <meta name="author" content="colorlib">

    <link rel="icon" href="{{asset('app/assets/images/favicon.ico')}}" type="image/x-icon">

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Quicksand:500,700" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="{{asset('app/bower_components/bootstrap/css/bootstrap.min.css')}}">

    <link rel="stylesheet" href="{{asset('app/assets/pages/waves/css/waves.min.css')}}" type="text/css" media="all">

    <link rel="stylesheet" type="text/css" href="{{asset('app/assets/icon/feather/css/feather.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app/assets/icon/icofont/css/icofont.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app/assets/icon/font-awesome/css/font-awesome.min.css')}}">



    <link rel="stylesheet" type="text/css" href="{{asset('app/assets/css/font-awesome-n.min.css')}}">

    {{-- <link rel="stylesheet" href="{{asset('app/bower_components/chartist/css/chartist.css')}}" type="text/css"
    media="all"> --}}

    <link rel="stylesheet" type="text/css" href="{{asset('app/assets/css/style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app/assets/css/widget.css')}}">
    <!-- Custom Css -->
    <!-- <link href="" rel="stylesheet"> -->
    <link href="{{asset('https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css')}}" rel="stylesheet">
    <!-- include summernote css/js -->
    {{-- <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.css" rel="stylesheet"> --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.min.css"
        rel="stylesheet" />
    <script src="https://unpkg.com/sweetalert2@7.18.0/dist/sweetalert2.all.js"></script>

    {{-- new custom --}}
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script type="text/javascript" src="{{asset('app/tiny/js/tinymce.min.js')}}"></script>

    {{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css"> --}}
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
                      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script> --}}
    {{-- <link href="{{asset('app/assets/pages/waves/js/waves.min.js')}}" rel="stylesheet">
    <link href="{{asset('app/bower_components/popper.js/js/popper.min.js')}}" rel="stylesheet"> --}}


</head>

<body>

    <div class="loader-bg">
        <div class="loader-bar"></div>
    </div>

    <div id="pcoded" class="pcoded">
        <div class="pcoded-overlay-box"></div>
        <div class="pcoded-container navbar-wrapper">

            <nav class="navbar header-navbar pcoded-header">
                <div class="navbar-wrapper">
                    <div class="navbar-logo">
                        <a href="{{ url('/work') }}">
                            <i class="fa fa-home"></i> {{ __('Dashboard') }}
                        </a>
                        <a class="mobile-menu" id="mobile-collapse" href="#!">
                            <i class="feather icon-menu icon-toggle-right"></i>
                        </a>
                        <a class="mobile-options waves-effect waves-light">
                            <i class="feather icon-more-horizontal"></i>
                        </a>
                    </div>
                    <div class="navbar-container container-fluid">
                        <ul class="nav-left">
                            <li>
                                <a href="{{ url('/') }}" class="waves-effect waves-light">
                                    <i class="fa fa-globe"></i>{{ __('Site') }}
                                </a>
                            </li>

                            <li>
                                <a href="#!" onclick="javascript:toggleFullScreen()" class="waves-effect waves-light">
                                    <i class="full-screen feather icon-maximize"></i>{{ __('Fullscreen') }}
                                </a>
                            </li>
                        </ul>
                        <ul class="nav-right">
                            <li class="header-notification">
                                <div class="dropdown-primary dropdown">
                                    <ul class="show-notification notification-view dropdown-menu"
                                        data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                        <li>
                                        </li>


                                    </ul>
                                </div>
                            </li>

                            <li class="user-profile header-notification">
                                <div class="dropdown-primary dropdown">
                                    <div class="dropdown-toggle" data-toggle="dropdown">
                                        <span><i class="feather icon-user"></i></span>
                                        <i class="feather icon-chevron-down"></i>
                                    </div>
                                    <ul class="show-notification profile-notification dropdown-menu"
                                        data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">

                                        <li>
                                            <a href="{{ route('work.admin.profile') }}">
                                                <i class="feather icon-user"></i>{{ __('Profile') }}
                                            </a>
                                        </li>
                                        <li>
                                        <li>
                                            <a href="{{ url('/work/logout') }}" onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();"><i
                                                    class="feather icon-log-out"></i>{{ __('Logout') }}
                                            </a>
                                            <form id="logout-form" action="{{ url('/work/logout') }}" method="POST"
                                                style="display: none;">
                                                {{ csrf_field() }}
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>




            <div class="pcoded-main-container">
                <div class="pcoded-wrapper">

                    <nav class="pcoded-navbar">
                        <div class="nav-list">
                            <div class="pcoded-inner-navbar main-menu">
                                <div class="pcoded-navigation-label">{{ __('Dashboard') }}</div>
                                <ul class="pcoded-item pcoded-left-item">

                                    <li class="">
                                        <a href="{{ route('work.admin.profile') }}" class="waves-effect waves-dark">
                                            <span class="pcoded-micon">
                                                <i class="fa fa-user"></i>
                                            </span>
                                            <span class="pcoded-mtext">{{ __('Profile') }}</span>
                                        </a>
                                    </li>

                                    <li class="pcoded-hasmenu">
                                        <a href="javascript:void(0)" class="waves-effect waves-dark">
                                            <span class="pcoded-micon"><i class="feather icon-sidebar"></i></span>
                                            <span class="pcoded-mtext"> {{ __('Products') }}</span>
                                        </a>
                                        <ul class="pcoded-submenu">
                                            <li class="">
                                                <a href="{{ route('products') }}" class="waves-effect waves-dark">
                                                <span><i class="fa fa-list" aria-hidden="true"></i> {{ __('Products') }}</span>
                                                </a>
                                            </li>
                                            <li class="">
                                                <a href="{{ route('work.product.create') }}"
                                                    class="waves-effect waves-dark">
                                                    <span><i class="fa fa-plus-circle" aria-hidden="true"></i> {{ __('Add Product') }}</span>
                                                </a>
                                            </li>
                                            <li class="">
                                                <a href="{{ route('categories') }}" class="waves-effect waves-dark">
                                                    <span><i class="fa fa-th-list" aria-hidden="true"></i> {{ __('Categories') }}</span>
                                                </a>
                                            </li>
                                            <li class="">
                                                <a href="{{ route('variations') }}" class="waves-effect waves-dark">
                                                    <span><i class="fa fa-arrows-alt" aria-hidden="true"></i> {{ __('Variations') }}</span>
                                                </a>
                                            </li>
                                            <li class="">
                                                <a href="{{ route('work.product.import') }}"
                                                    class="waves-effect waves-dark">
                                                <span><i class="fa fa-upload" aria-hidden="true"></i> {{ __('Csv Import') }}</span>
                                                </a>
                                            </li>
                                            <li class="">
                                                <a href="{{ route('work.crawl.ebay') }}"
                                                    class="waves-effect waves-dark">
                                                    <span><i class="fa fa-magnet" aria-hidden="true"></i> {{ __('Crawler') }} Ebay</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>

                                    <li class="pcoded-hasmenu">
                                        <a href="javascript:void(0)" class="waves-effect waves-dark">
                                            <span class="pcoded-micon"><i class="fa fa-users"></i> </span>
                                            <span class="pcoded-mtext">{{ __('Users') }}</span>
                                        </a>
                                        <ul class="pcoded-submenu">
                                            <li class="">
                                                <a href="{{ route('users') }}" class="waves-effect waves-dark">
                                                    <span><i class="fa fa-users" aria-hidden="true"></i> {{ __('Customers') }}</span>
                                                </a>
                                            </li>
                                            <li class="">
                                                <a href="{{ route('admins') }}" class="waves-effect waves-dark">
                                                    <span><i class="fa fa-user-secret" aria-hidden="true"></i> {{ __('Admin') }}</span>
                                                </a>
                                            </li>

                                        </ul>
                                    </li>

                                    <li class="pcoded-hasmenu">
                                        <a href="javascript:void(0)" class="waves-effect waves-dark">
                                            <span class="pcoded-micon"><i class="fa fa-book"
                                                    aria-hidden="true"></i></span>
                                            <span class="pcoded-mtext">{{ __('Coupons') }}</span>
                                        </a>
                                        <ul class="pcoded-submenu">
                                            <li class="">
                                                <a href="{{ route('work.coupons') }}" class="waves-effect waves-dark">
                                                    <span><i class="fa fa-list" aria-hidden="true"></i> Coupons</span>
                                                </a>
                                            </li>
                                            <li class="">
                                                <a href="{{ route('work.coupon.create') }}" class="waves-effect waves-dark">
                                                    <span><i class="fa fa-list" aria-hidden="true"></i> Add Coupon</span>
                                                </a>
                                            </li>

                                        </ul>
                                    </li>

                                    <li class="">
                                        <a href="{{ route('work.suppliers') }}" class="waves-effect waves-dark">
                                            <span class="pcoded-micon">
                                                <i class="fa fa-industry"></i>
                                            </span>
                                            <span class="pcoded-mtext">{{ __('Suppliers') }}</span>
                                        </a>
                                    </li>



                                    <li class="pcoded-hasmenu">
                                        <a href="javascript:void(0)" class="waves-effect waves-dark">
                                            <span class="pcoded-micon"><i class="fa fa-money"></i> </span>
                                            <span class="pcoded-mtext">{{ __('Finance') }}</span>
                                        </a>
                                        <ul class="pcoded-submenu">
                                            <li class="">
                                                <a href="{{ route('work.invoices') }}" class="waves-effect waves-dark">
                                                    <span><i class="fa fa-list-ol" aria-hidden="true"></i> {{ __('Invoices') }}</span>
                                                </a>
                                            </li>
                                            <li class="">
                                                <a href="{{ route('work.income') }}" class="waves-effect waves-dark">
                                                    <span><i class="fa fa-usd" aria-hidden="true"></i> {{ __('Income') }}</span>
                                                </a>
                                            </li>

                                        </ul>
                                    </li>


                                    <li class="pcoded-hasmenu">
                                        <a href="javascript:void(0)" class="waves-effect waves-dark">
                                            <span class="pcoded-micon"><i class="fa fa-book"
                                                    aria-hidden="true"></i></span>
                                            <span class="pcoded-mtext">{{ __('Blog & Pages') }}</span>
                                        </a>
                                        <ul class="pcoded-submenu">
                                            <li class="">
                                                <a href="{{ route('work.posts') }}" class="waves-effect waves-dark">
                                                    <span><i class="fa fa-list" aria-hidden="true"></i> {{ __('View Blogs') }}</span>
                                                </a>
                                            </li>
                                            <li class="">
                                                <a href="{{ route('work.pages') }}" class="waves-effect waves-dark">
                                                    <span><i class="fa fa-list" aria-hidden="true"></i> {{ __('View Pages') }}</span>
                                                </a>
                                            </li>

                                        </ul>
                                    </li>


                                    <li class="pcoded-hasmenu">
                                        <a href="javascript:void(0)" class="waves-effect waves-dark">
                                            <span class="pcoded-micon">
                                                <i class="fa fa-cog fa-spin fa-2x fa-fw col-red" aria-hidden="true"></i>
                                            </span>
                                            <span class="pcoded-mtext">{{ __('Settings') }}</span>
                                        </a>
                                        <ul class="pcoded-submenu">
                                            <li class="">
                                                <a href="{{ route('work.slides') }}" class="waves-effect waves-dark">
                                                    <span><i class="fa fa-picture-o" aria-hidden="true"></i> {{ __('Slider') }}</span>
                                                </a>
                                            </li>
                                            <li class="">
                                                <a href="{{ route('work.regex') }}" class="waves-effect waves-dark">
                                                    <span><i class="fa fa-code" aria-hidden="true"></i> {{ __('Regex Test') }}</span>
                                                </a>
                                            </li>
                                            <li class="">
                                                <a href="{{ route('work.settings') }}" class="waves-effect waves-dark">
                                                    <span><i class="fa fa-wrench" aria-hidden="true"></i> {{ __('Site Settings') }}</>
                                                </a>
                                            </li>

                                        </ul>
                                    </li>



                                    <li class="">
                                        <a class="waves-effect waves-dark">
                                            <span class="pcoded-micon">
                                            </span>
                                            <span class="pcoded-mtext">{{ __('version') }}
                                                {{-- {{$_ENV['DEV_VERSION']}}</span> --}}
                                        </a>
                                    </li>

                                </ul>

                            </div>
                        </div>
                    </nav>

                    <div class="pcoded-content">

                        <div class="page-header card">
                            <div class="row align-items-end">
                                <div class="col-lg-8">
                                    <div class="page-header-title">
                                        <i class="feather icon-home bg-c-blue"></i>
                                        <div class="d-inline">
                                            <h5>{{ __('Dashboard') }}</h5>
                                            <span>{{ date("l jS \of F Y h:i:s A") }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="page-header-breadcrumb">
                                        <ul class=" breadcrumb breadcrumb-title">
                                            <li class="breadcrumb-item">
                                                <a href="{{ url('/work') }}"><i class="feather icon-home"></i></a>
                                            </li>
                                            <li class="breadcrumb-item"><a
                                                    href="{{ url('/work') }}">{{ __('Dashboard') }}</a> </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="pcoded-inner-content">

                            <div class="main-body">
                                <div class="page-wrapper">

                                    <div class="page-body">
                                        <div class="row">
                                            <div class="col-sm-12">