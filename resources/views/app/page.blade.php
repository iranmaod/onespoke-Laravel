@extends('layouts.app')
@section('title', 'Page: '.$page->title.'')
@section('description', ''.$page->title.' | '.$settings->site_name.'')
@section('content')
<!-- =========================
        Slider Section
    ============================== -->
<section class="blog-slider-tow-grid wd-slider-section">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="text-center">
					<h1 class="wishlist-slider-title">{!!$page->title!!}</h1>
					<div class="page-location pt-0">
						<ul>
							<li><a href="{{ url('/') }}">
									{{ __('messages.home') }}
								</a></li>
							<li><a class="page-location-active" href="">
								</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<!-- =========================
        Blog Section
    ============================== -->
<section class="blog-section">
	<div class="container">
		<div class="row">
			<div class="col-md-1"></div>
			<div class="col-md-10">
				<div class="blog-single">
					<div class="blog-box">
						<!--
								==================
								Date Section
								==================


								======================
								Blog Content
								======================
	    					 -->
						<div class="blog-content-box">
							<a href="{{route('single_page', ['slug'=>$page->slug])}}">
								<h4 class="blog-title">{!!$page->title!!}</h4>
							</a>
							<p class="blog-content">{!!$page->content!!}</p>
							<br>
						</div>

					</div>
					<!--
								=====================
								Blog Share Oprion
								=====================
	    					 -->

					<!--
								=======================
								Author Bio
								=======================
	    					 -->
					<div class="row">
						<div class="col-md-12 col-lg-8">

						</div>

					</div>
				</div>
			</div>
		</div>
	</div>
	</div>
</section>


@endsection