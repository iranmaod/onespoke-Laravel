@extends('app.layouts.app')
@section('title', 'Home: '.$settings->site_name.'')
@section('description', ''.$settings->meta_name.'')
@section('content')
<!-- =========================
        Gets Slider
    ============================== -->
@include('app.layouts.includes.slim_slider')
<!-- =========================
        New and Best Products Section
    ============================== -->
<section id="amazon-review">
	<div class="container-fluid custom-width">
		<div class="amazon-review-box-area">
			<div class="row m0 justify-content-center ">
				<div class="col-md-12 p0 ">
					<div class="amazon-review-title">
						<h6>{{ __('messages.Products of the week') }}</h6>
					</div>
				</div>
				@if(!empty($latest_product))
				<div class="col-12 col-md-6 col-lg-4 p0 amazon-review-box wow fadeIn animated" data-wow-delay="0.2s">
					<div class="media">
						<div class="row">
							<div class="col-sm-4 col-md-5">
								<img class="img-fluid" src="{{asset($latest_product->image)}}"
									alt="{!!$latest_product->name!!}">
							</div>
							<div class="col-sm-8 col-md-7 p0 text-center">
								<div class="amazon-review-box-content">
									<p class="amazon-review-content"><i class="fa fa-star active-color"
											aria-hidden="true"></i></i>{{ __('messages.Latest') }}<i class="fa fa-star active-color"
											aria-hidden="true"></i></p>
									<div class="type">
										<p>
											<h6 class="amazon-review-box-title">{!!$latest_product->name!!}</h6>
										</p>
									</div>
									<div class="price">
										<strong>{!!$settings->currency->symbol!!}{{number_format($latest_product->price,2)}}</strong>
									</div>
									<a href="{{route('product_page', ['slug'=>$latest_product->slug,'id'=>$latest_product->id])}}"
										class="btn btn-primary amazon-details">{{ __('messages.Details') }} <i class="fa fa-arrow-right"
											aria-hidden="true"></i></a>
								</div>
							</div>
						</div>
					</div>
				</div>
				@endif
				@if(!empty($next_to_latest_product))
				<div class="col-12 col-md-6 col-lg-4 p0 amazon-review-box wow fadeIn animated" data-wow-delay="0.2s">
					<div class="media">
						<div class="row">
							<div class="col-sm-4 col-md-5">
								<img class="img-fluid" src="{{asset($next_to_latest_product->image)}}"
									alt="{!!$next_to_latest_product->name!!}">
							</div>
							<div class="col-sm-8 col-md-7 p0 text-center">
								<div class="amazon-review-box-content">
									<p class="amazon-review-content"><i class="fa fa-free-code-camp active-color"
											aria-hidden="true"></i></p>
									<div class="type">
										<p>
											<h6 class="amazon-review-box-title">{!!$next_to_latest_product->name!!}</h6>
										</p>
									</div>
									<div class="price">
										<strong>{!!$settings->currency->symbol!!}{{number_format($next_to_latest_product->price,2)}}</strong>
									</div>
									<a href="{{route('product_page', ['slug'=>$next_to_latest_product->slug,'id'=>$next_to_latest_product->id])}}"
										class="btn btn-primary amazon-details">{{ __('messages.Details') }} <i class="fa fa-arrow-right"
											aria-hidden="true"></i></a>
								</div>
							</div>
						</div>
					</div>
				</div>
				@endif
				@if(!empty($most_viewed_product))
				<div class="col-12 col-md-6 col-lg-4 p0 amazon-review-box wow fadeIn animated" data-wow-delay="0.2s">
					<div class="media">
						<div class="row">
							<div class="col-sm-4 col-md-5">
								<img class="img-fluid" src="{{asset($most_viewed_product->image)}}"
									alt="{!!$most_viewed_product->name!!}">
							</div>
							<div class="col-sm-8 col-md-7 p0 text-center">
								<div class="amazon-review-box-content">
									<p class="amazon-review-content"><i class="fa fa-eye active-color"
											aria-hidden="true"></i>{{ __('messages.Most Viewed') }}</p>
									<div class="type">
										<p>
											<h6 class="amazon-review-box-title">{!!$most_viewed_product->name!!}</h6>
										</p>
									</div>
									<div class="price">
										<strong>{!!$settings->currency->symbol!!}{{number_format($most_viewed_product->price,2)}}</strong>
									</div>
									<a href="{{route('product_page', ['slug'=>$most_viewed_product->slug,'id'=>$most_viewed_product->id])}}"
										class="btn btn-primary amazon-details">{{ __('messages.Details') }} <i class="fa fa-arrow-right"
											aria-hidden="true"></i></a>
								</div>
							</div>
						</div>
					</div>
				</div>
				@endif

			</div>
		</div>
	</div>
</section>

<!-- =========================
        Recent-Product Section
    ============================== -->
<section id="recent-product" class="recent-pro-2">
	<div class="container-fluid custom-width">
		<div class="row">
			<div class="col-md-12 text-center">
				<h2 class="recent-product-title"><i class="fa fa-fire" aria-hidden="true"></i>{{ __('messages.Hot Products') }}</h2>
			</div>
			@foreach($products as $product)
			<div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-2 wow fadeIn animated" data-wow-delay="100ms">
				<div class="recent-product-box">
					<div class="recent-product-img">
						<a href="{{route('product_page', ['slug'=>$product->slug,'id'=>$product->id])}}"><img
								src="{{asset($product->image)}}" class="img-fluid" alt="{{$product->name}}"></a>
						<!-- <span class="badge badge-secondary wd-badge text-uppercase">Cool</span> -->
						<div class="recent-product-info">
							<div class="d-flex justify-content-between">
								<div class="recent-price">
									{!!$settings->currency->symbol!!}{{number_format($product->price,2)}}
								</div>
								<div class="recente-product-categories">
									<a
										href="{{route('category_page', ['slug'=>$product->category->slug])}}">{!!$product->category->name!!}</a>
								</div>
							</div>
							<div class="recente-product-content">
								<a
									href="{{route('product_page', ['slug'=>$product->slug,'id'=>$product->id])}}">{!!$product->name!!}</a>
							</div>
							<div class="custom_btn text-center">
								<!-- <a rel="external nofollow" href="{{route('link', ['id'=>$product->id])}}" target="_blank" class="btn btn-primary ">{{$settings->cart_button}}</a> -->
								<form action="{{route('cart.add')}}" method="post">
									{{csrf_field()}}
									<input name="qty" type="hidden" value="1" />
									<input type="hidden" name="product_id" value="{{$product->id}}" />
									@if($product->stock>0)
									<button class="btn btn-primary ">{{$settings->cart_button}} </button>&nbsp
									@endif
									<a href="{{route('product_page', ['slug'=>$product->slug,'id'=>$product->id])}}"
										class="btn btn-light">{{ __('messages.Info') }}</a>
								</form>

							</div>
						</div>
					</div>
				</div>
			</div>
			@endforeach



		</div>
	</div>
</section>

<!-- =========================
        Weekly Top News
    ============================== -->
@if(count($posts) >0)
<section id="weekly-news">
	<div class="container-fluid custom-width">
		<div class="row">
			<div class="col-md-12 text-center">
				<h2 class="news-title"><i class="fa fa-newspaper-o" aria-hidden="true"></i>{{ __('messages.Recent Posts') }}</h2>
			</div>
			@foreach($posts as $post)
			<div class=" col-sm-6 col-md-6 col-xl-3 wow fadeInRight animated" data-wow-delay="300ms">
				<div class="weekly-news-box">
					<figure class="figure">
						<div class="weekly-news-img text-left">
							<img src="{{asset($post->image)}}" class="figure-img img-fluid rounded"
								alt="{!!$post->title!!}">
							<div class="weekly-news-title">
								<a href="{{route('post_page', ['slug'=>$post->slug])}}">
									<h4>{!!$post->title!!}</h4>
								</a>
							</div>
						</div>
						<figcaption class="figure-caption">
							<div class="blog-meta container">
								<div class="row">
									<div class="col blog-meta-box">
										<a href=""><i class="fa fa-user" aria-hidden="true"></i>{{$post->author}}</a>
									</div>
									<div class="col blog-meta-box">
										<a href=""><i class="fa fa-clock-o"
												aria-hidden="true"></i>{{$post->created_at->diffForHumans()}}</a>
									</div>
								</div>
							</div>
							<div class="text-center">
								{!! strip_tags(str_limit($post->content, $limit = 180, $end = '...')) !!}
							</div>
							<a href="{{route('post_page', ['slug'=>$post->slug])}}"
								class="badge badge-light wd-news-more-btn">{{ __('messages.Read_More') }}<i class="fa fa-arrow-right"
									aria-hidden="true"></i></a>
						</figcaption>
					</figure>
					<div class="weekly-news-shape"></div>
				</div>
			</div>
			@endforeach
		</div>
	</div>
</section>
@endif



<!-- =========================
        Counter Section
    ============================== -->
<section id="wd-counter" class=" wow bounceIn animated" data-wow-delay="300ms">
	<div class="container-fluid custom-width text-center">
		<div class="row">

		</div>
	</div>
</section>
@endsection