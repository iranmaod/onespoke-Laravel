@extends('app.layouts.app')
@section('title', ''.$product->name.'')
@section('description', ''.$product->name.' | '.$settings->site_name.'')
@section('content')
<link rel="stylesheet" href="{{asset('css\rateyo.css')}}">
<link rel="stylesheet" href="{{asset('css\lightslider.min.css')}}">
<link rel="stylesheet" href="{{asset('css\jquery-ui.min.css')}}">
{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"> --}}
    <!-- =========================
        Product Details Section
    ============================== -->
    <section class="product-details">
    	<div class="container">
    		<div class="row">
				<div class="col-12 p0">
					<div class="page-location">
						<ul>
							<li><a href="{{ url('/products') }}">
								{{ __('messages.Home_Product') }} <span class="divider">/</span>
							</a></li>
							<li><a class="page-location-active" href="{{route('product_page', ['slug'=>$product->slug,'id'=>$product->id])}}">
								{{$product->name}}
								<span class="divider">/</span>
							</a></li>
						</ul>
					</div>
				</div>
	    		<div class="col-12 product-details-section">
				    <!-- ====================================
				        Product Details Gallery Section
				    ========================================= -->
					<div class="row">
						<div class="product-gallery col-12 col-md-12 col-lg-6">
						    <!-- ====================================
						        Single Product Gallery Section
						    ========================================= -->
						    <div class="row">
								<div class="col-md-12 product-slier-details">
								    <ul id="lightSlider">
								        <li data-thumb="{{asset($product->image)}}">
								            <img class="figure-img img-fluid" src="{{asset($product->image)}}" alt="{{$product->name}}">
								        </li>
										@if($product->image_ex1)
										<li data-thumb="{{asset($product->image_ex1)}}">
								            <img class="figure-img img-fluid" src="{{asset($product->image_ex1)}}" alt="product-img">
								        </li>
										@endif
										@if($product->image_ex2)
										<li data-thumb="{{asset($product->image_ex2)}}">
								            <img class="figure-img img-fluid" src="{{asset($product->image_ex2)}}" alt="product-img">
								        </li>
										@endif
										@if($product->image_ex3)
										<li data-thumb="{{asset($product->image_ex3)}}">
								            <img class="figure-img img-fluid" src="{{asset($product->image_ex3)}}" alt="product-img">
								        </li>
										@endif
										@if($product->image_ex4)
										<li data-thumb="{{asset($product->image_ex4)}}">
								            <img class="figure-img img-fluid" src="{{asset($product->image_ex4)}}" alt="product-img">
								        </li>
										@endif
										@if($product->image_ex5)
										<li data-thumb="{{asset($product->image_ex5)}}">
								            <img class="figure-img img-fluid" src="{{asset($product->image_ex5)}}" alt="product-img">
								        </li>
										@endif
										
								    </ul>
								</div>
							</div>
						</div>
						<div class="col-6 col-12 col-md-12 col-lg-6">
							<div class="product-details-gallery">
								<div class="list-group">
									<h4 class="list-group-item-heading product-title">
										{{$product->name}}
									</h4>
								</div>
								<div class="list-group content-list">
									<p><i class="fa fa-dot-circle-o" aria-hidden="true"></i>{{ __('messages.Price') }}  : <span style="color:red">{{number_format($product->price,2)}}</span></p>
									<p><i class="fa fa-dot-circle-o" aria-hidden="true"></i>{{ __('messages.Views') }}  : {{$product->views_count}}</p>
									<p><i class="fa fa-dot-circle-o" aria-hidden="true"></i>{{ __('messages.category') }} : {{$product->category->name}}</p>
									<p><i class="fa fa-dot-circle-o" aria-hidden="true"></i>{{ __('messages.Stock') }} : {{$product->stock}}</p>
									@if($product->cart_count > 0)
									<p><i class="fa fa-dot-circle-o" aria-hidden="true"></i>{{ __('messages.Times Added To Cart') }} : {{$product->cart_count}}</p>
									@endif
									<p><i class="fa fa-dot-circle-o" aria-hidden="true"></i>{{ __('messages.Id') }}: <span class="cart66-price-value">{{$product->id}}</span></p>
								</div>
							</div>
							
							<div class="product-store row">
									{{-- @foreach($product->variants as $product_variant)
									@if ($product_variant->stock>0)
									<div class="col-12 product-store-box">
										<div class="row">
											<div class="col-3 p0 store-border-img">
												<img src="{{asset($product_variant->image)}}" class="figure-img img-fluid" alt="Img" height="100" width="100">
											</div>
											<div class="col-5 text-center">
												<div class="price">
													<p><b>{{$product_variant->variant_type->name}}</b> | <b>{{$product_variant->variant_name}}</b></p>
													<p><b>{!!$settings->currency->symbol!!}{{number_format($product->price,2)}}</b> | <b>Stock:</b>{{$product->stock}}</p>
												</div>
											</div>
											<div class="col-4 store-border-button">
											<form action="{{route('cart.add')}}" method="post">
												{{csrf_field()}}
												<button   class="btn btn-primary pull-right">
													<input  name="qty" type="hidden" value="1" />
													<input type="hidden" name="product_id" value="{{$product_variant->id}}" />
													<i class="fa fa-shopping-cart" aria-hidden="true"></i> {{$settings->cart_button}} 
												</button>
											</form>
											</div>
										</div>
									</div>
									@endif
									@endforeach --}}

							
						
						
							{{-- check if main product has stock --}}
							@if($product->stock ==0)
							<div class="alert alert-info text-center">
								<strong>{{ __('messages.Out of Stock') }}</strong>
								</div>
							 @endif

							<form action="{{route('cart.add')}}" method="post">
									{{csrf_field()}}
									<input  name="qty" type="hidden" value="1" />
							<div class="input-group">
									{{-- onchange="this.form.submit();" --}}
									<select class="form-control cart66-select" id="sel1"  name="product_id" required>
										{{-- If it is Main Porducts --}}	
										@if($product->parent_id==0)
											@if($product->stock > 0)
											 <option value="{{$product->id}}">{{ __('messages.Base Product') }} | {{ __('messages.Price') }}: {{number_format($product->price,2)}} | Stock:{{$product->stock}}</option>
											@endif

											
											
											@foreach($product->variants as $product_variant)
											@if ($product_variant->stock>0)
											<option value="{{$product_variant->id}}">{{$product_variant->variant_type->name}}>{{$product_variant->variant_name}} | {{ __('messages.Price') }}: {!!$settings->currency->symbol!!}{{number_format($product_variant->price,2)}} | {{ __('messages.Stock') }}:{{$product_variant->stock}}</option>
											@endif
											@endforeach
											@endif
											{{-- End if Main Product --}}

											{{-- If it is a  Varied Porduct --}}
											@if($product->parent_id>0)
											
											
											@foreach($product->parent->variants as $product_variant)
											@if ($product_variant->stock>0)
											<option value="{{$product_variant->id}}"
												@if($product_variant->id == $product->id) 
												selected
												@endif
												>{{$product_variant->variant_type->name}}>{{$product_variant->variant_name}} | {{ __('messages.Price') }}: {!!$settings->currency->symbol!!}{{number_format($product_variant->price,2)}} | {{ __('messages.Stock') }}:{{$product_variant->stock}}</option>
											@endif
											@endforeach

											@if($product->parent->stock > 0)
											 <option value="{{$product->parent->id}}">{{ __('messages.Base Product') }} | {{ __('messages.Price') }}: {!!$settings->currency->symbol!!}{{number_format($product->parent->price,2)}} | {{ __('messages.Stock') }}:{{$product->parent->stock}}</option>
											@endif

											@endif
											{{-- Endif Varied product --}}
											
										</select>
									 <span class="input-group-btn">
											<button class="btn btn-secondary wd-search-btn" type="submit" formaction="{{route('link')}}" type="submit" name="link">
											<i class="fa fa-folder-open" aria-hidden="true"></i>{{ __('messages.View') }}
										</button>
										
										<button   class="btn btn-primary pull-right" formaction="{{route('cart.add')}}" type="submit" name="add_cart" >
												<i class="fa fa-shopping-cart" aria-hidden="true"></i> {{$settings->cart_button}} 
										</button>
									</span>
							</div>
						 </form>
						 

						</div>

						</div>
					</div>
	    		</div>
    		</div>
			<div class="row">
				<div class="col-12">
				<div class="wd-tab-section">
					<div class="bd-example bd-example-tabs">
					  <ul class="nav nav-pills mb-3 wd-tab-menu" id="pills-tab" role="tablist">
					    <li class="nav-item col-6 col-md">
					      <a class="nav-link active" id="description-tab" data-toggle="pill" href="#description-section" role="tab" aria-controls="description-section" aria-expanded="true">{{ __('messages.Description') }}</a>
					    </li>
					    <li class="nav-item col-6 col-md">
					      <a class="nav-link" id="full-specifiction-tab" data-toggle="pill" href="#full-specifiction" role="tab" aria-controls="full-specifiction" aria-expanded="false">{{ __('messages.More Info') }}</a>
					    </li>
					  </ul>
						<div class="tab-content" id="pills-tabContent">
							<div class="tab-pane fade active show " id="description-section" role="tabpanel" aria-labelledby="description-tab" aria-expanded="true">
								<div class="product-tab-content">
									<h4 class="description-title">{{$product->name}} {{ __('messages.Details') }}</h4>
									{!!$product->description!!}
								</div>
								<hr>
							</div>
							<div class="tab-pane fade" id="full-specifiction">
								<h6>{{ __('messages.Additional Information') }}</h6>
								<ul class="list-group wd-info-section">
									<li class="list-group-item d-flex justify-content-between align-items-center p0">
										<div class="col-12 col-md-6 info-section">
											<p>{{ __('messages.Imported') }} : {{$product->created_at->toFormattedDateString()}}</p>
										</div>
										<div class="col-12 col-md-5 info-section">
											<p>{{ __('messages.Updated') }} : {{$product->updated_at->toFormattedDateString()}}</p>
										</div>
										<div class="col-1"></div>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
				</div>
			</div>
			<section class="comments">
                    <div class="comments">
                              <div class="heading text-center">
                                    <h4 class="h1 heading-title">{{ __('messages.Reviews') }}</h4>
                                    <div class="heading-line">
                                    <span class="short-line"></span>
                                    <span class="long-line"></span>
                                    </div>
                              </div>
                              @include('app.layouts.includes.disqus')
                        </div>
      </section>
      <!-- =========================
          Compare Section
      ============================== -->
      @if(count($compared_products) > 0 )
      <section class="product-details wishlist-table">
        <div class="text-center"><h6><i class="fa fa-balance-scale"></i>{{ __('messages.Comparison Table') }} </h6></div>
      	<div class="container">
  			<div class="row compare-product">
  				<div class="col-12 p0">
  			        <div id="no-more-tables">
  			            <table class="col-md-12 p0 table table-responsive">
  						  <thead>
  						    <tr class="wishlist-table-title">
  						      <th class="text-center">{{ __('messages.Image') }}</th>
  						      <th class="text-center">{{ __('messages.Name') }}</th>
  						      <th class="text-center">{{ __('messages.Price') }}</th>
  						      <th class="text-center">{{ __('messages.Information') }}</th>
  						      <th class="text-center">{{ __('messages.Visit') }}</th>
  						    </tr>
  						  </thead>
  			        		<tbody>
                      @foreach($compared_products as $compared_product)

                      <?php
                      //random button Colors
                      $random_btn = array('red-bg','Blue','orange-bg','blue-bg','green-bg');
                        $key = array_rand($random_btn);
                        //show percentage
                        similar_text($product->name, $compared_product->name, $perc);
                        ?>
  			        			<tr>
  			        				<td class="text-center">
  			        					<img src="{{asset($compared_product->image)}}" class="figure-img img-fluid" width="50" height="50" alt="product-img">
  			        				</td>
  			        				<td class="text-center">
  			        					<div class="vertical-center">
  			        						<p>{{$compared_product->name }} ({{round($perc,2)}}%)</p>
  				        				</div>
  			        				</td>
  			        				<td class="text-center">
  			        					<div class="vertical-center">
  			        						<div class="wishlist-price">
  			        							<p>{!!$settings->currency->symbol!!}{{number_format($compared_product->price,2)}}</p>
  			        						</div>
  			        					</div>
  			        				</td>
  			        				<td class="text-center">
  			        					<div class="vertical-center">
  			        						<a href="{{route('product_page', ['slug'=>$compared_product->slug,'id'=>$compared_product->id])}}"  class="btn btn-warning">{{ __('messages.Info') }}</a>
  			        					</div>
  			        				</td>
  			        				<td class="text-center">
  			        					<div class="vertical-center">
										<form action="{{route('cart.add')}}" method="post">
										{{csrf_field()}}
										<input  name="qty" type="hidden" value="1" />
										<input type="hidden" name="product_id" value="{{$compared_product->id}}" />
										@if($compared_product->stock>0)
										<button class="btn btn-primary wd-shop-btn {{$random_btn[$key]}}">
												{{$settings->cart_button}} <i class="fa fa-arrow-right" aria-hidden="true"></i>
										</button>
										@endif
										</form>
  										</div>
  			        				</td>
  			        			</tr>
                      @endforeach

  			        		</tbody>
  			        	</table>
  			        </div>
  				</div>
  			</div>

      	</div>
      </section>
      @endif

       <!-- =========================
          Compare Section
      ============================== -->

			<div class="row related-product">
				<h4 class="related-product-title">{{ __('messages.Other Cool Products') }}</h4>
				<div id="related-product" class="owl-carousel owl-theme">
            @foreach($rand_products as $rand_product)
	    			<div class="col-12">
						<figure class="figure product-box">
							<div class="product-box-img">
								<a href="{{route('product_page', ['slug'=>$rand_product->slug,'id'=>$rand_product->id])}}">
									<img src="{{asset($rand_product->image)}}" class="figure-img img-fluid" alt="{{$rand_product->name}}">
								</a>
							</div>
							<div class="quick-view-btn">
								<div class="compare-btn">
								</div>
							</div>
							<figcaption class="figure-caption text-center">
								<div class="price-start">
									<p><strong class="active-color"><u>{{number_format($rand_product->price,2)}}</u></strong></p>
								</div>
								<div class="content-excerpt">
									<p>{{$rand_product->name}}</p>
								</div>
								<div class="custom_btn text-center">
								<form action="{{route('cart.add')}}" method="post">
									{{csrf_field()}}
									<input  name="qty" type="hidden" value="1" />
									<input type="hidden" name="product_id" value="{{$rand_product->id}}" />
									@if($rand_product->stock>0)
									<button class="btn btn-primary ">{{$settings->cart_button}} </button>&nbsp
									@endif
								<a href="{{route('product_page', ['slug'=>$rand_product->slug,'id'=>$rand_product->id])}}"  class="btn btn-light">{{ __('messages.Info') }}</a>
								</form>
								</div>

							</figcaption>
						</figure>
	    			</div>
            @endforeach

				</div>
			</div>
    	</div>
    </section>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script >
			var changePrice = function(){
				var select = $(".cart66-select"),
					displayPrice = $(".cart66-price-value");
				
				select.change(function(){
					var selected = $(this).children("option:selected").val();
					displayPrice.text(selected);
				});
			}

			changePrice();
		</script>
@endsection
