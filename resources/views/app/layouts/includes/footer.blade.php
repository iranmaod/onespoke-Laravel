<!-- =========================
    Footer Section
============================== -->
<footer class="footer wow fadeInUp animated footer-2" data-wow-delay="900ms">
  <div class="container-fluid custom-width">
    <div class="row">
      <div class="col-md-12 col-lg-3">
        <!-- ===========================
            Footer About
           =========================== -->
        <div class="footer-about">
          <a href="{{ url('/') }}" class="footer-about-logo">
            <img src="{{asset($settings->logo)}}" alt="Logo">
          </a>
          <div class="footer-description">
            <p>{!! strip_tags(str_limit($settings->site_about, $limit = 100, $end = '...')) !!}</p><a href="{{route('single_page', ['slug'=>'about'])}}">{{ __('messages.Read_More') }}</a>
          </div>
        </div>
      </div>
      <div class="col-md-12 col-lg-3 footer-nav">
        <!-- ===========================
            Festival Deals
           =========================== -->
        <h6 class="footer-subtitle">{{ __('messages.Our_Store') }}</h6>
        <div class="footer-description">
        <p><i class="fa fa-phone"  aria-hidden="true"></i> {{$settings->site_number}}</p>
        <p><i class="fa fa-envelope" aria-hidden="true"></i> {{$settings->site_email}}</p><hr />
        <div class="wb-social-media">
          <a href="{{$settings->social_facebook}}" class="fb" name="Facebook" ><i class="fa fa-facebook-official"></i></a>
          <a href="{{$settings->social_twitter}}" class="vn" name="Twitter"><i class="fa fa-twitter" aria-hidden="true"></i></a>
          <a href="{{$settings->social_facebook}}" class="gp" name="Instagram"><i class="fa fa-instagram" aria-hidden="true"></i></a>
          <a rel="alternate" type="application/atom+xml" href="{{ url('/feed') }}" name="Rss Feed"><i class="fa fa-rss" aria-hidden="true"></i></a>
        </div>
      </div>
      </div>
      <div class="col-md-12 col-lg-3 footer-nav">
        <!-- ===========================
            About
           =========================== -->
        <h6 class="footer-subtitle">{{ __('messages.Pages') }}</h6>
          <ul>
            @foreach($pages as $page)
            <li><a href="{{route('single_page', ['slug'=>$page->slug])}}">{{$page->title}}</a></li>
            @endforeach
          </ul>
      </div>
      <div class="col-12 col-md-12 col-lg-3">
        <h6 class="footer-subtitle text-center"><u>{{ __('messages.Express_Shopping') }}</u></h6>
         <h4 class="text-center"><a href="{{ url('/') }}">
          <img src="{{asset('uploads\defaults\footer-image.png')}}" alt="HTML5 Icon" ></a>
        </h4>
      </div>
    </div>
  </div>
</footer>
<!-- =========================
    CopyRight
============================== -->
<section class="copyright wow fadeInUp animated copyright-2" data-wow-delay="1500ms">
  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <div class="copyright-text">
          <p class="text-uppercase">{{ __('messages.COPYRIGHT') }} &copy; <?php echo date("Y"); ?></p><a class="created-by" href="{{ url('/') }}">{{$settings->site_name}}</a>
        </div>
      </div>
      <div class="col-md-6">
        <div class="brand-logo">
          <img src="{{asset('uploads\defaults\payment-1.png')}}" alt="Payment-1">
          <img src="{{asset('uploads\defaults\payment-2.png')}}" alt="Payment-2">
          <img src="{{asset('uploads\defaults\payment-3.png')}}" alt="Payment-3">
          <img src="{{asset('uploads\defaults\payment-4.png')}}" alt="Payment-4">
          <img src="{{asset('uploads\defaults\payment-5.png')}}" alt="Payment-5">
        </div>
      </div>
    </div>
  </div>
</section>

<!-- =========================
  Main Loding JS Script
============================== -->
<script src="{{asset('js\jquery.min.js')}}"></script>
<script src="{{asset('js\jquery-ui.js')}}"></script>
<script src="{{asset('js\popper.js')}}"></script>
<script src="{{asset('js\bootstrap.min.js')}}"></script>
<script src="{{asset('js\jquery.counterup.min.js')}}"></script>
<script src="{{asset('js\jquery.nav.js')}}"></script>
<!-- <script src="js/jquery.nicescroll.js')}}"></script> -->
<script src="{{asset('js\jquery.rateyo.js')}}"></script>
<script src="{{asset('js\jquery.scrollUp.min.js')}}"></script>
<script src="{{asset('js\jquery.sticky.js')}}"></script>
<script src="{{asset('js\mobile.js')}}"></script>
<script src="{{asset('js\lightslider.min.js')}}"></script>
<script src="{{asset('js\owl.carousel.min.js')}}"></script>
<script src="{{asset('js\circle-progress.min.js')}}"></script>
<script src="{{asset('js\waypoints.min.js')}}"></script>

<script src="{{asset('js\simplePlayer.js')}}"></script>

<script src="{{asset('js\main.js')}}"></script>
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
