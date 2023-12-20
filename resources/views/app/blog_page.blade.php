@extends('app.layouts.app')
@section('title', 'Blog: '.$post->title.'')
@section('description', ''.$post->title.' | '.$settings->site_name.'')
@section('content')
<!-- =========================
        Slider Section
    ============================== -->
<section class="blog-slider-tow-grid wd-slider-section">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="text-center">
					<h1 class="wishlist-slider-title">{!!$post->title!!}</h1>
					<div class="page-location pt-0">
						<ul>
							<li><a href="{{ url('/blogs') }}">
									{{ __('messages.blogs') }}
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
	    					 -->
						<div class="blog-date text-center">
							<h2 class="date">{{ $post->created_at->day }}</h2>
							<h4 class="monthe">{{ $post->created_at->format('M')}}</h4>
						</div>
						<!--
								==================
								Blog Img
								==================
	    					 -->
						<div class="blog-img">
							<img src="{{asset($post->image)}}" class="figure-img img-fluid" alt="blog-img">
						</div>
						<!--
								==================
								Meta Area
								==================
	    					 -->
						<div class="single-blog-mata-area">
							<div class="blog-badge">
								<span class="badge badge-secondary green-bg">{{ __('messages.blog') }}</span>
							</div>
						</div>
						<!--
								==================
								Author Meta
								==================
	    					 -->
						<div class="author-meta">
							{{ __('messages.Posted_by') }} <a href="#">{{$post->author}}</a> on <a
								href="#">{{$post->created_at->toFormattedDateString()}}</a>
						</div>
						<!--
								======================
								Blog Content
								======================
	    					 -->
						<div class="blog-content-box">
							<a href="{{route('post_page', ['slug'=>$post->slug])}}">
								<h4 class="blog-title">{!!$post->title!!}</h4>
							</a>
							<p class="blog-content">{!!$post->content!!}</p>
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
							<!-- <div class="author-bio">
											<div class="media">
												<img class="d-flex mr-3" src="img\blog-img\author-img-1.png" alt="author-img">
												<div class="media-body">
													<h5 class="mt-0 author-bio-title">Mohammad Shohag <span>( Administrator )</span></h5>
													It is a long established fact that a reader looking at its layout. The point of using Lorem Ipsum is that it has.
												</div>
											</div>
										</div> -->

						</div>

					</div>
				</div>
			</div>
		</div>
	</div>
	</div>
</section>


@endsection