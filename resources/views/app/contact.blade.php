@extends('app.layouts.app')
@section('title', 'Contact')
@section('description', 'Contact| '.$settings->site_name.'')
@section('content')
<!-- =========================
        Slider Section
    ============================== -->
<section class="blog-slider-tow-grid wd-slider-section">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="text-center">
					<h1 class="wishlist-slider-title">{{ __('messages.contact') }}</h1>
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
							<a href="">
								<h4 class="blog-title"></h4>
							</a>
							<p class="blog-content"></p>


							<div class="row">

								<!-- Contact Form -->
								<div class="col-sm-12">
									<div class="text-center"><span><i class="fa fa-envelope fa-5x"
												aria-hidden="true"></i></span></div>
									<form class="" action="{{route('contact.send')}}" method="post"
										enctype="multipart/form-data">
										{{csrf_field()}}
										@if (count($errors)>0)
										<ul class="list-group">
											@foreach($errors->all() as $error)
											<li class="list-group-item text-danger">
												{{$error}}
											</li>
											@endforeach

										</ul>
										@endif
										<div class="form-group">
											<label for="nameInput">{{ __('messages.Name')}} (*)</label>
											<input type="text" name="name" class="form-control" id="nameInput"
												placeholder="Name" required>
										</div>
										<div class="form-group">
											<label for="emailInput">{{ __('messages.Email_Address')}} (*)</label>
											<input type="email" name="email" class="form-control" id="emailInput"
												placeholder="Email Address" required>
										</div>
										<div class="form-group">
											<label for="subjectInput">{{ __('messages.Subject')}} (*)</label>
											<input type="text" name="subject" class="form-control" id="subjectInput"
												placeholder="Subject" required>
										</div>
										<div class="form-group">
											<label for="notesInput">{{ __('messages.Message')}} (*)</label>
											<textarea class="form-control" name="content" rows="5" required></textarea>
										</div>
										<div class="form-group row">
											<label for="password" class="col-md-4 col-form-label text-md-right"></label>
											{{-- <div class="col-md-6">
												{!! NoCaptcha::display(['data-theme' => 'dark']) !!}
												@if ($errors->has('g-recaptcha-response'))
												<span class="invalid-feedback" role="alert">
													<strong>{{ $errors->first('g-recaptcha-response') }}</strong>
												</span>
												@endif
											</div> --}}
										</div>

										<button type="submit" class="btn btn-primary  pull-right"><i
												class="fa fa-arrow-circle-right"></i>{{ __('messages.Send')}} </button>
									</form>
								</div>
							</div>





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