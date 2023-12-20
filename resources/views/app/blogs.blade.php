@extends('app.layouts.app')
@section('title', 'Blog Posts')
@section('description', 'Blog Posts | '.$settings->site_name.'')
@section('content')
<!-- =========================
        Slider Section
    ============================== -->
<section class="blog-slider-tow-grid wd-slider-section">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="text-center">
					<h1 class="wishlist-slider-title">{{ __('messages.blogs') }}</h1>
					<div class="page-location pt-0">
						<ul>
							<li><a href="">
									{{ __('messages.home') }}<span class="divider"></span>
								</a></li>
							<li><a class="page-location-active" href="">
									<span class="active-color"></span>
									<span class="divider"></span>
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
		<div class="row tow-grid">
			@foreach($posts as $post)
			<div class="col-md-6">
				<div class="blog-box">
					<div class="blog-date text-center">
						<h2 class="date">{{ $post->created_at->day }}</h2>
						<h4 class="monthe">{{ $post->created_at->format('F')}}</h4>
					</div>
					<div class="blog-img">
						<img src="{{asset($post->image)}}" class="figure-img img-fluid" alt="{{$post->title}}">
					</div>
					<div class="blog-meta">
						<div class="d-flex justify-content-start">
							<div class="col blog-meta-box">
								<a href=""><i class="fa fa-user" aria-hidden="true"></i>{{$post->author}}</a>
							</div>
							<div class="col blog-meta-box">
								<a href=""><i class="fa fa-clock-o"
										aria-hidden="true"></i>{{$post->created_at->toFormattedDateString()}}</a>
							</div>
						</div>
					</div>
					<div class="blog-content-box">
						<a href="{{route('post_page', ['slug'=>$post->slug])}}">
							<h4 class="blog-title">{!!$post->title!!}</h4>
						</a>
						<p class="blog-content">{{ strip_tags(str_limit($post->content, $limit = 250, $end = '...')) }}
						</p>
						<div class="raed-more">
							<a class="btn btn-link" href="{{route('post_page', ['slug'=>$post->slug])}}">
								{{ __('messages.Read_More') }} <i class="fa fa-angle-right" aria-hidden="true"></i>
							</a>
						</div>
					</div>
				</div>
			</div>
			@endforeach

		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="float-right">
					<nav class="wd-pagination">
						<ul class="pagination">
							{{$posts->links()}}
						</ul>
					</nav>
				</div>
			</div>
		</div>
	</div>
</section>


@endsection