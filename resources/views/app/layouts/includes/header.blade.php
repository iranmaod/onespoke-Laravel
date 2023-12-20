{{-- {{ Session::get('coupon_code')}} --}}
<!doctype html>
<html lang="{{ app()->getLocale() }}">

<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>@yield('title', '{{$settings->site_name}}')</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Start SEO Settings -->
  <meta name="description" content="@yield('description', '{{$settings->meta_name}}')">
  <meta name="author" content="{{$settings->site_name}}">
  <link rel="canonical" href="{{ url('/') }}" />
  <link rel="instagram" href="{{$settings->social_instagram}}" />
  <meta property="og:locale" content="en_US" />
  <meta property="og:type" content="website" />
  <meta name="keywords" content="{{$settings->keywords}}">
  <meta property="og:title" content="@yield('description', '{{$settings->meta_name}}')" />
  <meta property="og:description" content="@yield('description', '{{$settings->meta_name}}')" />
  <meta property="og:url" content="{{ url('/') }}" />
  <meta property="og:site_name" content="{{$settings->site_name}}" />
  <meta property="og:image" content="{{asset($settings->logo)}}" />
  <meta name="twitter:card" content="summary_large_image" />
  <meta name="twitter:description" content="@yield('description', '{{$settings->meta_name}}')" />
  <meta name="twitter:title" content="@yield('title', '{{$settings->site_name}}')" />
  <meta name="twitter:site" content="{{$settings->social_twitter}}" />
  <meta name="twitter:image" content="{{asset($settings->logo)}}" />
  <meta name="twitter:creator" content="{{$settings->site_name}}" />
  <!-- End SEO Settings -->
  <link rel="apple-touch-icon" href="{{asset($settings->logo)}}">
  <link rel="shortcut icon" href="{{asset('favicon.ico')}}" type="image/x-icon">
  <link rel="icon" href="{{asset('favicon.ico')}}" type="image/x-icon">
  {{-- {!!Feed::link(url('feed'), 'atom', 'My Feed', 'en')!!} --}}
  <!-- Place favicon.ico in the root directory -->

  <!-- =========================
        Loding All Stylesheet
    ============================== -->
  <link rel="stylesheet" href="{{asset('css\bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{asset('css\font-awesome.min.css')}}">
  <link rel="stylesheet" href="{{asset('css\owl.carousel.min.css')}}">
  <!-- <link rel="stylesheet" href="{{asset('css\owl.carousel.min.css')}}"> -->

  <link rel="stylesheet" href="{{asset('css\owl.theme.default.min.css')}}">
  <link rel="stylesheet" href="{{asset('css\animate.min.css')}}">
  <link rel="stylesheet" href="{{asset('css\custom.css')}}">

  <link rel="stylesheet" href="{{asset('css\megamenu.css')}}">
  <link href="{{asset('https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css')}}" rel="stylesheet">

  <!-- =========================
        Loding Main Theme Style
    ============================== -->
  <link rel="stylesheet" href="{{asset('css\style.css')}}">

  <!-- =========================
    	Header Loding JS Script
    ============================== -->
  <script src="{{asset('js/modernizr.js')}}"></script>
  <script src='https://www.google.com/recaptcha/api.js'></script>
  <script src="https://unpkg.com/sweetalert2@7.18.0/dist/sweetalert2.all.js"></script>

</head>

<body class="">
  <!--[if lt IE 8]>
      <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->

  <div class="preloader"></div>

  <!-- =========================
        Header Top Section
    ============================== -->


  <!-- =========================
        Header Section
    ============================== -->
  <section id="wd-header" class="dark-header">
    <div class="container-fluid custom-width">
      <div class="row">
        <div class="col-md-12 col-lg-3 col-xl-3 text-center second-home-main-logo">
          <a href="{{ url('/') }}"><img src="{{asset($settings->logo)}}" alt="Logo"></a>
        </div>
        <div class="col-md-6 col-lg-6 slider-search-section d-none d-lg-block">
          <form method="get" action="{{ url('/search') }}">
            <div class="input-group">
              <div class="input-group-btn">
                <button type="button" class="btn btn-secondary wd-slider-search-btn" data-toggle="dropdown"
                  aria-haspopup="true" aria-expanded="false">
                  <i class="fa fa-search" aria-hidden="true"></i> {{ __('messages.categories') }}
                </button>
              </div>
              <input type="text" class="form-control input-search-box" name="query"
                placeholder="{{ __('messages.enter_search_word') }} ...">
              <span class="input-group-btn">
                <button class="btn btn-secondary wd-search-btn" type="button"><i class="fa fa-search"
                    aria-hidden="true"></i></button>
              </span>
            </div>
          </form>
        </div>
        <div class="col-md-6 col-lg-3  col-xl-3 text-right">
          @if (Auth::check())
          <a title="Logout" href="{{ url('/account/logout') }}" class="btn btn-primary my-account d-none d-lg-block">/
            Logout <i class="fa fa-sign-out" style="color:red;" aria-hidden="true"></i></a>
          <a title="Account" href="{{ url('/account') }}" class="btn btn-primary my-account d-none d-lg-block"><i
              class="fa fa-user" aria-hidden="true"></i> {{ Auth::user()->name }}'s {{ __('messages.account') }} </a>
          @else
          <a title="Register" href="{{ url('/register') }}" class="btn btn-primary my-account d-none d-lg-block">/
            {{ __('messages.signup') }} <i class="fa fa-user-plus" aria-hidden="true"></i></a>
          <a title="Login" href="{{ url('/login') }}" class="btn btn-primary my-account d-none d-lg-block"><i
              class="fa fa-sign-in" aria-hidden="true"></i>{{ __('messages.login') }}</a>

          @endif
        </div>
      </div>
  </section>

  <!-- =========================
        Header Section
    ============================== -->
  <section id="wd-header-2" class="wd-header-nav sticker-nav mob-sticky bg-orange">
    <div class="container-fluid custom-width">
      <div class="row">
        <!--Mobile Menu start-->
        @include('app.layouts.includes.mobile_menu')
        <!--Mobile menu end-->
        <div class="col-xl-3 d-none d-xl-block">
          <div class="department" id="cat-department">
            <img src="{{asset('img\menu-bar.png')}}" alt="menu-bar">
            {{ __('messages.All_Categories') }}
            <div class="shape-img">
              <img src="{{asset('img\department-shape-img.png')}}" class="img-fluid" alt="department img">
            </div>
            <div id="department-list" class="department-list" style="display:none;">
              @foreach($categories as $category)
              <li class="list-group-item"><a href="{{route('category_page', ['slug'=>$category->slug])}}">
                  <div class="department-list-logo">
                    <i class="fa fa-tag" aria-hidden="true"></i>
                  </div><span class="sub-list-main-menu">{{$category->name}}</span>
                </a>
              </li>
              @endforeach
              </ul>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-10 col-xl-7 header-search-box d-none d-lg-block">
          <div id="main-menu-2" class="main-menu-desktop no-border main-menu-sh">
            <div class="menu-container wd-megamenu text-left">
              <div class="menu">
                <ul class="wd-megamenu-ul">
                  <li><a href="{{ url('/') }}" class="main-menu-list"><i class="fa fa-home" aria-hidden="true"></i>
                      {{ __('messages.home') }}</a></li>
                  <li><a href="{{ url('/products') }}" class="main-menu-list"><i class="fa fa-leaf"
                        aria-hidden="true"></i> {{ __('messages.products') }}</a></li>
                  <li><a href="{{ url('/blogs') }}" class="main-menu-list"><i class="fa fa-book" aria-hidden="true"></i>
                      {{ __('messages.blogs') }}</a></li>
                  <li><a href="{{ url('/contact') }}" class="main-menu-list"><i class="fa fa-phone"
                        aria-hidden="true"></i> {{ __('messages.contact') }}</a></li>
                  <li><a href="{{ url('locale/en') }}" class="main-menu-list"><i class="fa fa-language"
                        aria-hidden="true"></i> EN</a></li>
                  <!--<li><a href="{{ url('locale/fr') }}" class="main-menu-list"><i class="fa fa-language" aria-hidden="true"></i> FR</a></li> -->
                  @if(Auth::guard('admin')->check())
                  <li><a href="{{ url('/work') }}" class="main-menu-list">{{ __('messages.admin') }}</a>
                    <ul class="single-dropdown">
                      <li>
                        <a href="{{ url('/work/logout') }}"
                          onclick="event.preventDefault();
                          document.getElementById('logout-form').submit();">{{ __('messages.logout') }}
                        </a>
                      </li>
                      <form id="logout-form" action="{{ url('/work/logout') }}" method="POST">
                        {{ csrf_field() }}
                      </form>
                    </ul>
                  </li>
                  @endif
                </ul>
              </div>
            </div>
          </div>
        </div>
        <div class="col-10 col-sm-6 col-md-4 col-lg-2 col-xl-2 text-right">
          <!-- =========================
                             Cart Out
         ============================== -->

          <div class="header-cart">
            @if (Auth::check())
            <div class="account-section d-md-block d-lg-none">
              <a href="{{ url('/account') }}"><button class="btn btn-primary">
                  <i class="fa fa-dashboard" aria-hidden="true"></i><b>{{ __('messages.dashboard') }}</b></button></a>
            </div>
            @else
            <div class="account-section d-md-block d-lg-none">
              <a href="{{ url('/login') }}"><button class="btn btn-primary"><b>{{ __('messages.login') }}</b></button></a>
            </div>
            @endif

            <div class="serch-wrapper">
              <form method="get" action="{{ url('/search') }}">
                <div class="search">
                  <input class="search-input" placeholder="Search" name="query" type="text">
                  <a href="javascript:void(0)"><i class="fa fa-search"></i>{{ __('messages.search') }}</a>
                </div>
              </form>
            </div>
            @if (Auth::check())
            <div class="account-section d-md-block d-lg-none">
              <a href="{{ url('/account/logout') }}"><button class="btn btn-primary"><b>{{ __('messages.logout') }}</b></button></a>
            </div>
            @else
            <div class="account-section d-md-block d-lg-none">
              <a href="{{ url('/register') }}"><button class="btn btn-primary"><b>{{ __('messages.signup') }}</b></button></a>
            </div>
            @endif

            <a title="Cart" href="{{ url('cart') }}" class="coupon-save"><i class="fa fa-cart-plus"
                aria-hidden="true"></i>
              <span class="count">{{Cart::content()->count()}}</span>
            </a>



          </div>
        </div>
      </div>
  </section>