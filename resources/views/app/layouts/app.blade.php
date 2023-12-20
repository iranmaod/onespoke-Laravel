
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
  {{-- <link rel="stylesheet" href="{{asset('css\bootstrap.min.css')}}"> --}}
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link rel="stylesheet" href="{{asset('front\css\font-awesome.min.css')}}">
  <link rel="stylesheet" href="{{asset('front\css\owl.carousel.min.css')}}">
  <!-- <link rel="stylesheet" href="{{asset('front\css\owl.carousel.min.css')}}"> -->

  <link rel="stylesheet" href="{{asset('front\css\owl.theme.default.min.css')}}">
  <link rel="stylesheet" href="{{asset('front\css\animate.min.css')}}">
  <link rel="stylesheet" href="{{asset('front\css\custom.css')}}">

  <link rel="stylesheet" href="{{asset('front\css\megamenu.css')}}">
  <link href="{{asset('https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css')}}" rel="stylesheet">

  <!-- =========================
        Loding Main Theme Style
    ============================== -->
  <link rel="stylesheet" href="{{asset('front\css\style.css')}}">

  <!-- =========================
    	Header Loding JS Script
    ============================== -->
  <script src="{{asset('front\js/modernizr.js')}}"></script>
  <script src='https://www.google.com/recaptcha/api.js'></script>
  <script src="https://unpkg.com/sweetalert2@7.18.0/dist/sweetalert2.all.js"></script>

</head>

<body class="">
    <div>
        @yield('content')
    </div>

   

<!-- =========================
  Main Loding JS Script
============================== -->
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script src="{{asset('front\js\jquery.min.js')}}"></script>
<script src="{{asset('front\js\jquery-ui.js')}}"></script>
<script src="{{asset('front\js\popper.js')}}"></script>
<script src="{{asset('front\js\bootstrap.min.js')}}"></script>
<script src="{{asset('front\js\jquery.counterup.min.js')}}"></script>
<script src="{{asset('front\js\jquery.nav.js')}}"></script>
<!-- <script src="js/jquery.nicescroll.js')}}"></script> -->
<script src="{{asset('front\js\jquery.rateyo.js')}}"></script>
<script src="{{asset('front\js\jquery.scrollUp.min.js')}}"></script>
<script src="{{asset('front\js\jquery.sticky.js')}}"></script>
<script src="{{asset('front\js\mobile.js')}}"></script>
<script src="{{asset('front\js\lightslider.min.js')}}"></script>
<script src="{{asset('front\js\owl.carousel.min.js')}}"></script>
<script src="{{asset('front\js\circle-progress.min.js')}}"></script>
<script src="{{asset('front\js\waypoints.min.js')}}"></script>

<script src="{{asset('front\js\simplePlayer.js')}}"></script>

<script src="{{asset('front\js\main.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
  @if(Session::has('success'))
    toastr.success("{{Session::get('success')}}",'',{timeOut: 100000})
  @endif
  @if(Session::has('info'))
    toastr.info("{{Session::get('info')}}",'',{timeOut: 100000})
  @endif
  @if(Session::has('error'))
    toastr.error("{{Session::get('error')}}",'',{timeOut: 100000})
  @endif
  @if(Session::has('warning'))
    toastr.warning("{{Session::get('warning')}}",'',{timeOut: 100000})
  @endif
</script>
</body>
</html>

