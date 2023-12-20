@extends('work.layouts.app')

@section('content')

{{-- start here --}}
<div class="card">
  <div class="card-header">
    <h3>Settings</h3>
  </div>
  <div class="card-block">
    <form action="{{route('work.settings.update')}}" method="post" enctype="multipart/form-data">
      {{csrf_field()}}
      <div class="body">
        @if (count($errors)>0)
        <ul class="list-group">
          @foreach($errors->all() as $error)
          <li class="list-group-item text-danger">
            {{$error}}
          </li>
          @endforeach
        </ul>
        @endif
      </div>
      {{-- start 1 --}}
      <div class="row">
        <div class="col-lg-12 col-xl-6">

          <div class="card">
            <div class="card-header">
              <h5>Logo</h5>
            </div>

            <div class="card-block">
              <div class="row form-group">
                <div class="col-sm-12 text-center">
                  <img src="{{asset($settings->logo)}}" class="text-center" alt="{{$settings->site_name}}" width="150px"
                    height="50px" />

                </div>
              </div>

              <div class="row form-group">
                <div class="col-sm-3">

                </div>
                <div class="col-sm-9">
                  <div class="form-group">
                    <input name="image" type="file" class="form-control" accept="image/*">
                  </div>
                </div>
              </div>

              {{-- hidden --}}
            </div>
          </div>
        </div>
        <div class="col-lg-12 col-xl-6">

          <div class="card">
            <div class="card-header">
            </div>
            <div class="card-block">
              <div class="row form-group">
                <div class="col-sm-3">
                  <label class="col-form-label">Sitemap</label>
                </div>
                <div class="col-sm-9 text-center">
                  <div class="form-group">
                    <a href="{{ route('work.sitemap') }}">
                      <button type="button" class="btn btn-primary m-t-15 waves-effect">
                        <i class="fa fa-sitemap" aria-hidden="true"></i>Generate
                      </button>
                    </a>
                  </div>
                </div>
              </div>
              <div class="row form-group">
                <div class="col-sm-3">
                  <label class="col-form-label">Rss Feed</label>
                </div>
                <div class="col-sm-9">
                  <div class="form-group text-center">
                    <a href="{{ route('feed') }}" target="_blank">
                      <button type="button" class="btn btn-primary m-t-15 waves-effect">
                        <i class="fa fa-rss-square"></i>Rss
                      </button>
                    </a>
                  </div>
                </div>
              </div>


            </div>
          </div>

        </div>
      </div>
      {{-- end 1 --}}

      <div class="card">
        <div class="card-header">
          <h5>Socials</h5>
        </div>
        <div class="card-block">

          <div class="row clearfix">
            <div class="col-md-4">
              <div class="form-group">
                <div class="form-line">
                  <label for="facebook">
                    <h6>FaceBook</h6>
                  </label>
                  <input type="text" class="form-control" name="social_facebook" value="{{$settings->social_facebook}}"
                    placeholder="facebook">
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <div class="form-line">
                  <label for="facebook">Twitter</label>
                  <input type="text" class="form-control" name="social_twitter" value="{{$settings->social_twitter}}"
                    placeholder="twitter">
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <div class="form-line">
                  <label for="facebook">Instagram</label>
                  <input type="text" class="form-control" name="social_instagram"
                    value="{{$settings->social_instagram}}" placeholder="instagram">
                </div>
              </div>
            </div>
          </div>



        </div>


      </div>{{-- // --}}

      {{-- Product Settings --}}
      <div class="card">
        <div class="card-header">
          <h5>Product Settings</h5>
        </div>
        <div class="card-block">

          <div class="body">
            <center>
              <h4><u>Hompage</u></h4>
            </center>
            <div class="row clearfix">
              <div class="col-md-4">
                <div class="form-group">
                  <div class="form-line">
                    <label for="facebook">Random Products</label>
                    <input type="number" class="form-control" required name="home_rand_pro"
                      value="{{$settings->home_rand_pro}}" placeholder="home_rand_pro">
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <div class="form-line">
                    <label for="facebook">Blog Posts</label>
                    <input type="number" class="form-control" required name="home_posts"
                      value="{{$settings->home_posts}}" placeholder="home_posts">
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <div class="form-line">
                    <label for="facebook">Customers</label>
                    <input type="number" class="form-control" required name="home_users"
                      value="{{$settings->home_users}}" placeholder="home_featured_pro">
                  </div>
                </div>
              </div>
            </div>
            <hr />
            <div class="row clearfix">
              <div class="col-md-3">
                <div class="form-group">
                  <div class="form-line">
                    <label for="facebook">CSV Import Limit</label>
                    <input type="number" class="form-control" name="csv_import_limit"
                      value="{{$settings->csv_import_limit}}" placeholder="csv_import_limit">
                  </div>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <div class="form-line">
                    <label for="facebook">Compare Similarity [%]</label>
                    <input type="number" class="form-control" required name="compare_percentage" min="1" max="100"
                      value="{{$settings->compare_percentage}}" placeholder="compare_percentage">
                  </div>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <div class="form-line">
                    <label for="facebook">Products per Comparison</label>
                    <input type="number" class="form-control" required name="compared_products"
                      value="{{$settings->compared_products}}" placeholder="compared_products">
                  </div>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <div class="form-line">
                    <label for="facebook">Cart Button Name</label>
                    <input type="text" class="form-control" required value="{{$settings->cart_button}}"
                      name="cart_button" placeholder="cart_button">
                  </div>
                </div>
              </div>

              <br><br>
              <div class="col-sm-12">
                <div class="row clearfix">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Search Element</label>
                      <select class="form-control show-tick" required name="search_element">
                        <option value="price" @if($settings->search_element == 'price') selected @endif > Price
                        </option>
                        <option value="name" @if($settings->search_element == 'name') selected @endif > Name </option>
                        <option value="created_at" @if($settings->search_element == 'created_at') selected @endif > Date
                        </option>
                        <option value="cart_count" @if($settings->search_element == 'cart_count') selected @endif > Cart
                        </option>
                        <option value="views_count" @if($settings->search_element == 'views_count') selected @endif >
                          Views </option>
                      </select>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Search Order</label>
                      <select class="form-control show-tick" required name="search_order">
                        <option value="desc" @if($settings->search_order == 'desc') selected @endif> High to low
                        </option>
                        <option value="asc" @if($settings->search_order == 'asc') selected @endif>Low to high </option>
                      </select>
                    </div>
                  </div>

                </div>
              </div>
              
              <br><br>
              <div class="col-sm-12">
                <div class="row clearfix">
                  <div class="col-md-4">
                    <div class="form-group">
                      <div class="form-line">
                        <label for="facebook">Tax%</label>
                        <input type="number" class="form-control" required min="0" name="tax" value="{{$settings->tax}}"
                          placeholder="Tax">
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <div class="form-line">
                        <label for="facebook">Commission%</label>
                        <input type="number" min="0" class="form-control fill" required step="0.01"
                          value="{{$settings->price_percent_gain}}" name="price_percent_gain"
                          placeholder="price_percent_gain">
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <div class="form-line">
                        <label for="facebook">Default Quantity[Crawl Import]</label>
                        <input type="number" class="form-control" required min="1" name="default_quantity"
                          value="{{$settings->default_quantity}}" placeholder="default_quantity">
                      </div>
                    </div>
                  </div>

                </div>
              </div>

            </div>

            <hr><br>

            <div class="row clearfix">
              <div class="col-md-12">
                <div class="form-group">
                  <div class="form-line">
                    <label for="facebook">Set Disqus Js for Comments</label>
                    <input type="text" class="form-control" name="disqus" value="{{$settings->disqus}}"
                      placeholder="Disqus">
                  </div>
                </div>
              </div>
            </div>

          </div>



        </div>


      </div>{{-- // --}}

      {{-- SEO --}}
      <div class="card">
        <div class="card-header">
          <h5>SEO</h5>
        </div>
        <div class="card-block">

          <div class="body">
            <div class="row clearfix">
              <div class="col-md-3">
                <div class="form-group">
                  <div class="form-line">
                    <label for="facebook">Sitename</label>
                    <input type="text" class="form-control" required name="site_name" value="{{$settings->site_name}}"
                      placeholder="site_name">
                  </div>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <div class="form-line">
                    <label for="facebook">Meta Name</label>
                    <input type="text" class="form-control" name="meta_name" value="{{$settings->meta_name}}"
                      placeholder="meta_name">
                  </div>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <div class="form-line">
                    <label for="facebook">About</label>
                    <input type="text" class="form-control" name="site_about" value="{{$settings->site_about}}"
                      placeholder="site_about">
                  </div>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <div class="form-line">
                    <label for="facebook">Keywords</label>
                    <input type="text" class="form-control" name="keywords" value="{{$settings->keywords}}"
                      placeholder="keywords">
                  </div>
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <div class="form-line">
                    <label for="facebook">Currency</label>
                    <select id="currency_id" name="currency_id" class="form-control show-tick">
                      @foreach($currencies as $currency)
                      <option value="{{$currency->id}}" @if($settings->currency->id == $currency->id)
                        selected
                        @endif
                        >{{$currency->name}}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <div class="form-line">
                    <label for="facebook">Email</label>
                    <input type="text" class="form-control" required name="site_email" value="{{$settings->site_email}}"
                      placeholder="site_email">
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <div class="form-line">
                    <label for="facebook">Phone Number</label>
                    <input type="text" class="form-control" name="site_number" value="{{$settings->site_number}}"
                      placeholder="site_number">
                  </div>
                </div>
              </div>


            </div>

          </div>

        </div>


      </div>{{-- //End SEO --}}




      <div class="card">
        <div class="card-header">
          <h6>Payment Gateways</h6>
        </div>
        <div class="card-block">

          <div class="body">
            <center>
              <h4><u>PayPal</u></h4>
            </center>
            <div class="row clearfix">
              <div class="col-md-2">
                <div class="form-group">
                  <div class="form-line">
                    <label for="facebook">PayPal Status</label>
                    <div class="switch">
                      <label>OFF
                        <input type="checkbox" name="paypal_active" @if ($gateways->paypal_active ==1 ) checked @else
                        @endif >
                        <span class="lever"></span>
                        ON</label>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-5">
                <div class="form-group">
                  <div class="form-line">
                    <label for="paypal_client_id">PayPal Client ID</label>
                    <input type="text" class="form-control" name="paypal_client_id"
                      value="{{$gateways->paypal_client_id}}" placeholder="paypal_client_id">
                  </div>
                </div>
              </div>
              <div class="col-md-5">
                <div class="form-group">
                  <div class="form-line">
                    <label for="paypal_client_secret">PayPal Secret</label>
                    <input type="text" class="form-control" name="paypal_client_secret"
                      value="{{$gateways->paypal_client_secret}}" placeholder="paypal_client_secret">
                  </div>
                </div>
              </div>
            </div>
            <div class="row clearfix">
              <div class="col-md-2">
                <div class="form-group">
                  <div class="form-line">
                    <label for="facebook">Stripe Status</label>
                    <div class="switch">
                      <label>OFF
                        <input type="checkbox" name="stripe_active" @if ($gateways->stripe_active ==1 ) checked @else
                        @endif >
                        <span class="lever"></span>
                        ON</label>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-5">
                <div class="form-group">
                  <div class="form-line">
                    <label for="stripe_publishable_key">Stripe Publishable Key</label>
                    <input type="text" class="form-control" name="stripe_publishable_key"
                      value="{{$gateways->stripe_publishable_key}}" placeholder="stripe_publishable_key">
                  </div>
                </div>
              </div>
              <div class="col-md-5">
                <div class="form-group">
                  <div class="form-line">
                    <label for="stripe_secret_key">Stripe Secret Key</label>
                    <input type="text" class="form-control" name="stripe_secret_key"
                      value="{{$gateways->stripe_secret_key}}" placeholder="stripe_secret_key">
                  </div>
                </div>
              </div>
            </div>
            <div class="row clearfix">
              <div class="col-md-2">
                <div class="form-group">
                  <div class="form-line">
                    <label for="facebook">VoguePay Status</label>
                    <div class="switch">
                      <label>OFF
                        <input type="checkbox" name="voguepay_active" @if ($gateways->voguepay_active ==1 ) checked
                        @else @endif >
                        <span class="lever"></span>
                        ON</label>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-10">
                <div class="form-group">
                  <div class="form-line">
                    <label for="facebook">VoguePay Merchant ID</label>
                    <input type="text" class="form-control" name="voguepay_merchant_id" min="1" max="100"
                      value="{{$gateways->voguepay_merchant_id}}" placeholder="voguepay_merchant_id">
                  </div>
                </div>
              </div>
            </div>
            

            
              
            </div>

            <div class="row clearfix">
              <div class="col-md-12">
                {{-- <div class="form-group"> --}}
                <div class="row">
                  <label class="col-sm-2 col-lg-2 col-form-label">Delivery Terms</label>
                  <div class="col-sm-10 col-lg-10">
                    <textarea rows="5" id="description" required class="form-control no-resize editor"
                      name="delivery_terms" placeholder="Input delivery_terms...">
                                       {!!$settings->delivery_terms!!}
                                      </textarea>
                  </div>
                </div>
                <br>
                {{-- </div> --}}
              </div>
            </div>


          </div>

        </div>


      </div>{{-- //Payment Gateways --}}



      <div class="card">
        <div class="card-block">
          <center><button type="submit" class="btn btn-primary m-t-15 waves-effect"><i
                class="fa fa-save"></i>Save</button>
          </center>
    </form><br>

  </div>


</div>{{-- //Misc --}}

</div>{{-- end class block --}}



</div>


</div>
{{-- end here --}}





@endsection


@section('mainjs_script')
<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
<script>
  tinymce.init({
        selector: '.editor',
    });

</script>
@endsection