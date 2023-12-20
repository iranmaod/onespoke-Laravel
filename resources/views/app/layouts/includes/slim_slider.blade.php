<!-- =========================
Slider Section
============================== -->
<section id="main-slider-section" class="shop-slider-section">
<div id="shop-slider" class="owl-carousel owl-theme product-review">
@foreach($slides as $slide)
<div class="item bc-slider-bg" style="
background-image: url({{asset($slide->image)}});
background-repeat: no-repeat;
background-size: 100% 100%;
height: 40vh;
position: relative;
">
<div class="container">
<div class="row">
<div class="slider-text col-12">
<a href="{{$slide->url}}" class="btn btn-primary wd-shop-btn slider-btn">
{{ __('messages.go') }} <i class="fa fa-arrow-right" aria-hidden="true"></i>
</a>
</div>
</div>
</div>
</div>
@endforeach
</div>
</section>