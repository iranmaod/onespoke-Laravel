</div>

<div id="styleSelector">
</div>

</div>
</div>
</div>
</div>


<!--[if lt IE 10]>
<div class="ie-warning">
<h1>Warning!!</h1>
<p>You are using an outdated version of Internet Explorer, please upgrade
<br/>to any of the following web browsers to access this website.
</p>
<div class="iew-container">
<ul class="iew-download">
<li>
<a href="http://www.google.com/chrome/">
    <img src="{{asset('app/assets/images/browser/chrome.png')}}" alt="Chrome">
    <div>Chrome</div>
</a>
</li>
<li>
<a href="https://www.mozilla.org/en-US/firefox/new/">
    <img src="{{asset('app/assets/images/browser/firefox.png')}}" alt="Firefox">
    <div>Firefox</div>
</a>
</li>
<li>
<a href="http://www.opera.com">
    <img src="{{asset('app/assets/images/browser/opera.png')}}" alt="Opera">
    <div>Opera</div>
</a>
</li>
<li>
<a href="https://www.apple.com/safari/">
    <img src="{{asset('app/assets/images/browser/safari.png')}}" alt="Safari">
    <div>Safari</div>
</a>
</li>
<li>
<a href="http://windows.microsoft.com/en-us/internet-explorer/download-ie">
    <img src="{{asset('app/assets/images/browser/ie.png')}}" alt="">
    <div>IE (9 & above)</div>
</a>
</li>
</ul>
</div>
<p>Sorry for the inconvenience!</p>
</div>
<![endif]-->


{{-- <script data-cfasync="false" src="../../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js')}}"></script> --}}

<script type="text/javascript" src="{{asset('app/bower_components/jquery-ui/js/jquery-ui.min.js')}}"></script>
<script type="text/javascript" src="{{asset('app/bower_components/popper.js/js/popper.min.js')}}"></script>
<script type="text/javascript" src="{{asset('app/bower_components/bootstrap/js/bootstrap.min.js')}}"></script>

<script src="{{asset('app/assets/pages/waves/js/waves.min.js')}}"></script>

<script type="text/javascript" src="{{asset('app/bower_components/jquery-slimscroll/js/jquery.slimscroll.js')}}"></script>

{{-- <script src="{{asset('app/assets/pages/chart/float/jquery.flot.js')}}"></script> --}}
{{-- <script src="{{asset('app/assets/pages/chart/float/jquery.flot.categories.js')}}"></script> --}}
{{-- <script src="{{asset('app/assets/pages/chart/float/curvedLines.js')}}"></script> --}}
{{-- <script src="{{asset('app/assets/pages/chart/float/jquery.flot.tooltip.min.js')}}"></script> --}}

{{-- <script src="{{asset('app/bower_components/chartist/js/chartist.js')}}"></script> --}}

{{-- <script src="{{asset('app/assets/pages/widget/amchart/amcharts.js')}}"></script> --}}
{{-- <script src="{{asset('app/assets/pages/widget/amchart/serial.js')}}"></script> --}}
{{-- <script src="{{asset('app/assets/pages/widget/amchart/light.js')}}"></script> --}}

<script src="{{asset('app/assets/js/pcoded.min.js')}}"></script>
<script src="{{asset('app/assets/js/vertical/vertical-layout.min.js')}}"></script>
{{-- <script type="text/javascript" src="{{asset('app/assets/pages/dashboard/custom-dashboard.min.js')}}"></script> --}}
<script type="text/javascript" src="{{asset('app/assets/js/script.min.js')}}"></script>

{{-- custom --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script> --}}

<script>
  @if(Session::has('success'))
    toastr.success("{{Session::get('success')}}",{timeOut: 30000})
  @endif
  @if(Session::has('info'))
    toastr.info("{{Session::get('info')}}",{timeOut: 30000})
  @endif
  @if(Session::has('error'))
    toastr.error("{{Session::get('error')}}",{timeOut: 30000})
  @endif
  @if(Session::has('warning'))
    toastr.warning("{{Session::get('warning')}}",{timeOut: 30000})
  @endif
</script>
</body>

</html>