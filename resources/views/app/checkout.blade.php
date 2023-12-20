@extends('app.layouts.app')
@section('title', 'Checkout')
@section('description', 'Checkout | '.$settings->site_name.'')
@section('content')
<!-- =========================
        Slider Section
    ============================== -->
<section class=" wd-slider-section">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header"> <br /> </div>
          <h5 class="text-center">{{ __('Your Order') }}</h5>
          <div class="card-body">
            <!-- <form method="POST" action="" > -->
            @csrf

            <table id="cart" class="table table-hover table-condensed">

              @if(count(Cart::content()) > 0)
              <thead>
                <tr>
                  <th style="width:50%">{{ __('Name') }}</th>
                  <th style="width:10%">{{ __('Price') }}</th>
                  <th style="width:8%">{{ __('Quantity') }}</th>
                  <th style="width:22%" class="text-center">{{ __('Subtotal') }}</th>
                </tr>
              </thead>
              <tbody>
                <?php @$total_supplier_price = 0 ?>
                @foreach (Cart::content() as $product)
                <?php
                                      $correct_supplier_price = $product->model->supplier_price*$product->qty;
                                      $total_supplier_price += $correct_supplier_price ?>
                <tr>
                  <td data-th="Product">
                    <div class="row">
                      <div class="col-sm-2 hidden-xs"><img src="{{asset($product->model->image)}}" alt="Image"
                          class="img-responsive" /></div>
                      <div class="col-sm-10">
                        <p class="nomargin"><b>{{$product->name}}</b></p>
                      </div>
                    </div>
                  </td>
                  <td data-th="Price">{{$product->price}}</td>

                  <form action="{{route('cart.update')}} " method="post">
                    {{csrf_field()}}
                    <td data-th="Quantity">
                      <input type="number" readonly name="quantity" min="1" max="{{$product->model->stock}}"
                        class="form-control text-center" value="{{$product->qty}}">
                      <input type="hidden" name="id" value="{{$product->rowId}}">
                    </td>
                    <td data-th="Subtotal" class="text-center">{{$product->subtotal()}}
                    </td>
                    <td class="actions" data-th="">
                  </form>
                  </td>

                </tr>
                @endforeach


              </tbody>
              <tfoot>
                <tr class="visible-xs">
                </tr>
                <tr>
                  <td><a href="{{ url('/cart') }}" class="btn btn-warning"><i class="fa fa-angle-left"></i>
                      {{ __('Return to Cart') }}<i class="fa fa-cart-plus"> </a></td>
                  <td colspan="2" class="hidden-xs"></td>
                  <td class="hidden-xs text-center"><strong>{{ __('Total') }}
                      {{Cart::subtotal()}}</strong></td>
                  <!-- <td><a href="{{ url('/checkout') }}" class="btn btn-success btn-block">Checkout <i class="fa fa-angle-right"></i></a></td> -->
                </tr>
              </tfoot>

              @else
              <center>
                <p>
                  <div class="alert alert-warning text-center">
                    <strong>{{ __('Cart is  Empty') }}</strong>.
                  </div>
                </p> <a href="{{ url('/products') }}" class="btn btn-warning"><i class="fa fa-angle-left"></i>
                  {{ __('Continue Shopping') }}</a>
              </center>
              @endif
            </table>


            <hr />


            <!--Expand-->


            <!--  ***********CART TOTALS*************-->
            @if(count(Cart::content()) >0)
            <div class="container-fluid">
              <div class="row">
                @if (Auth::check())
                <div class="col-sm-6">
                  <center>
                    <p>
                      <div class="alert alert-info text-center">
                        <strong>{{ __('Billing Details') }}.</strong>
                      </div>
                    </p>
                  </center>
                  <div class="form-group">
                    <strong><label class="control-label" for="country_id">{{ __('Country') }} :<span
                          class="required">*</span></strong>
                    </label>
                    <div class="info">
                      <input type="text" name="country" readonly="" required="required" id="country"
                        class="form-control" title="Country" size="35" placeholder="Please Select your Country"
                        value="{{Auth::user()->country}}">
                    </div>
                  </div>
                  <div class="form-group">
                    <strong><label class="control-label" for="address">{{ __('Address') }} :<span
                          class="required">*</span></strong>
                    </label>
                    <hr />
                    <div class="addy">
                      {!!Auth::user()->address!!}
                    </div>
                  </div>

                  <div class="form-group">
                    <strong><label class="control-label" for="mobile">{{ __('Phone') }} :<span
                          class="required">*</span> </label></strong>
                    <div class="info">
                      <input type="text" name="phone_number" id="mobile" readonly="" class="form-control"
                        title="Mobile No" required="required" size="35" placeholder="Phone Number"
                        value="{{Auth::user()->phone}}">
                    </div>
                  </div>
                  <div class="form-group">
                    <strong><label class="control-label" for="state">{{ __('State') }} :<span
                          class="required">*</span></strong>
                    </label>
                    <div class="info">
                      <input type="text" name="state" readonly="" required="required" id="state" class="form-control"
                        title="" size="35" placeholder="Enter State" value="{!!Auth::user()->town!!}">
                    </div>
                  </div>
                  <div class="form-group">
                    <strong><label class="control-label" for="city">{{ __('City') }} :<span
                          class="required">*</span></strong>
                    </label>
                    <div class="info">
                      <input type="text" name="city" readonly="" required="required" id="city" class="form-control"
                        title="" size="35" placeholder="Enter City" value="{!!Auth::user()->town!!}">
                    </div>
                  </div>
                  <div class="form-group">
                    <strong><label class="control-label" for="postal_code">{{ __('Postal Code') }} :<span
                          class="required">*</span></strong>
                    </label>
                    <div class="info">
                      <input type="text" name="postal_code" readonly="" required="required" id="postal_code"
                        class="form-control" title="Please Type your Postal Code" size="35"
                        placeholder="Enter Postal Code" value="{{Auth::user()->postcode}}">
                    </div>
                  </div>

                  <center><a href="{{url('/profile')}}"><button type="submit" class="btn btn-info"><i
                          class="fa fa-pencil-square-o"
                          aria-hidden="true"></i>{{ __('Edit Address') }}</button></a></center>
                </div>
                @else
                <div class="col-sm-6">
                  <center>
                    <p>
                      <div class="alert alert-danger text-center">
                        <strong> {{ __('You Have to Be Logged! In To Continue') }}.</strong>
                      </div>
                    </p>
                  </center>
                  <div id="shipping-calculator">
                    <fieldset>
                      <br />
                      <a href="{{ url('/register') }}" class="pull-left btn btn-primary"><i
                          class="fa fa-chevron-left"></i> {{ __('Register') }}</a>
                      <a href="{{ url('/login') }}" class="pull-right btn btn-primary"><i
                          class="fa fa-chevron-right"></i> {{ __('login') }}</a>
                    </fieldset>
                    <!-- end billing details  -->
                  </div>
                </div>
                <hr />
                @endif

                <div class="col-sm-6">
                  <p>
                    <div class="alert alert-info">
                      <strong>{{ __('Delivery Information') }}</strong>
                      <p>
                        {!!$settings->delivery_terms !!}
                      </p>

                    </div>
                  </p>
                  <p>
                    <div class="alert alert-info text-center">
                      <strong>{{ __('Cart Totals') }}</strong>
                    </div>
                  </p>

                  <table class="table table-bordered" cellspacing="0">
                    <tr class="cart-subtotal">
                      <th>{{ __('products') }}:</th>
                      <td><span class="amount">{{Cart::content()->count()}}</span></td>
                    </tr>
                    <tr class="cart-subtotal">
                      <th>{{ __('Items') }}:</th>
                      <td><span class="amount">{{Cart::count()}}</span></td>
                    </tr>

                    @if (Cart::discount() > 0)
                    <tr class="cart-subtotal">
                      <th>{{ __('Initial Order') }}:</th>
                      <td><span
                          class="amount">{!!$settings->currency->symbol!!}<strike>{{Cart::priceTotal()}}</strike></span>
                      </td>
                    </tr>

                    <tr class="cart-subtotal">
                      <th>
                        <i class="fa fa-gift" aria-hidden="true"></i>
                        @if (Session::exists('coupon_code'))
                        {{Session::get('coupon_code')}}
                        @else
                        {{ __('Discount') }}
                        @endif
                        (-
                        @if (Session::exists('coupon_percentage_off'))
                        {{Session::get('coupon_percentage_off')}}
                        @endif
                        %):
                      </th>
                      <td><span class="amount">${{Cart::discount()}} </span>
                      </td>
                    </tr>
                    @endif

                    <tr class="order-total">
                      <th>{{ __('Order') }}</th>
                      <td><strong><span class="amount">{{Cart::subtotal()}}
                          </span></strong>
                      </td>
                    </tr>
                    <tr class="cart-subtotal">
                      <th>{{ __('Tax') }} ({{$settings->tax}}%):</th>
                      <td><span class="amount">{{Cart::tax()}}</span></td>
                    </tr>
                    <!-- <h5> Adds Vat</h5> -->
                    <tr class="order-total">
                      <th>{{ __('Order Total') }}</th>
                      <td><strong><span class="amount">{{Cart::total()}}
                          </span></strong>
                      </td>
                    </tr>
                    </tbody>
                  </table>
                  @if (Auth::check())
                  <div class="alert alert-info text-center">
                    <strong>{{ __('Info') }}!</strong>
                    {{ __('Please verify that Billing information is correct') }}.
                  </div>
                  @endif





                </div>

                @endif


              </div>
            </div>


            <!--Expand-->



            <!-- </form> -->
          </div>
          <hr />




          @if(empty(Auth::user()->country) || empty(Auth::user()->address) || empty(Auth::user()->phone) ||
          empty(Auth::user()->town)|| empty(Auth::user()->town) || empty(Auth::user()->postcode) )
          <div class="alert alert-warning text-center">
            <strong>{{ __('Empty Field') }}</strong>{{ __('One or more elements from your shipping address is empty') }}

          </div>

          @else
          <div class="row">
            @if($gateway->stripe_active == 1)
            <?php $cart_total = Cart::total();
                      $cart_total = str_replace(',', '', $cart_total);
                       ?>
            <div class="col-xs-12 col-md-4 col-lg-4 pull-left">
              <div class="text-center">
                <form action="{{route('account.gateway.stripe')}}" method="POST">
                  {{csrf_field()}}
                  <script src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                    data-key="{{$gateway->stripe_publishable_key}}" data-amount="{{$cart_total * 100}}"
                    data-name="{{$settings->site_name}}" data-description="Product Payment"
                    data-email="{{Auth::user()->email}}" data-currency="usd"
                    data-image="https://stripe.com/img/documentation/checkout/marketplace.png" data-locale="auto">
                  </script>


                  <script>
                    // Hide default stripe button, be careful there if you
                              // have more than 1 button of that class
                              document.getElementsByClassName("stripe-button-el")[0].style.display = "none";
                  </script>
                  <button title="Pay with Stripe" type="submit" class="btn btn-primary"><i class="fa fa-cc-stripe"
                      aria-hidden="true"></i> Stripe</button>
                  <input type="hidden" name="price" value="{{Cart::total()}}">
                  <input type="hidden" name="total_supplier_price" value="{{$total_supplier_price}}">
                  <input type="hidden" name="pro_id"
                    value="@foreach (Cart::content() as $product){{$product->model->stock}},@endforeach">
                  {{-- temp --}}
                  <input type="hidden" name="initial_amount" value="{{Cart::priceTotal()}}">
                  <input type="hidden" name="coupon_id"
                    value="{{(Session::exists('coupon_id'))? Session::get('coupon_id'):0}}">
                  <input type="hidden" name="coupon_code"
                    value="{{(Session::exists('coupon_code'))? Session::get('coupon_code') :0}}">
                  <input type="hidden" name="coupon_percentage_off"
                    value="{{(Session::exists('coupon_percentage_off'))? Session::get('coupon_percentage_off'):0}}">
                  {{-- temp --}}
                </form>
              </div>
            </div>
            @endif

            @if($gateway->paypal_active == 1)
            <!-- paypal -->
            <div class="col-xs-12 col-md-4 col-lg-4">
              <div class="text-center">
                <form action="{{route('account.gateway.paypal')}}" method="post" name="frmPayPal1">
                  {{csrf_field()}}
                  <input type="hidden" name="cmd" value="_xclick">
                  <input type="hidden" name="item_name" value="Product Payment">
                  {{-- temp --}}
                  <input type="hidden" name="initial_amount" value="{{Cart::priceTotal()}}">
                  <input type="hidden" name="coupon_id"
                    value="{{(Session::exists('coupon_id'))? Session::get('coupon_id'):0}}">
                  <input type="hidden" name="coupon_code"
                    value="{{(Session::exists('coupon_code'))? Session::get('coupon_code') :0}}">
                  <input type="hidden" name="coupon_percentage_off"
                    value="{{(Session::exists('coupon_percentage_off'))? Session::get('coupon_percentage_off'):0}}">
                  {{-- temp --}}
                  <!--inv name -->
                  <input type="hidden" name="item_number" value="{{$total_supplier_price}}">
                  <input type="hidden" name="amount" value="{{$cart_total}}">
                  <input type="hidden" name="no_shipping" value="0">
                  <input type="hidden" name="currency_code" value="usd">
                  <input type="hidden" name="handling" value="0">
                  <input type="hidden" name="cancel_return" value="">
                  <input title="Pay with PayPal" type="hidden" name="return" value=""><button type="submit"
                    class="btn btn-info" onclick="return confirm('{{ __('Pay Via') }} PayPal ?');"><i
                      class="fa fa-paypal" aria-hidden="true"></i> PayPal</button>
                  <img alt="" border="0" src="https://www.sandbox.paypal.com/en_US/i/scr/pixel.gif" width="1"
                    height="1">
                </form>
              </div>
            </div>
            @endif
            @if($gateway->voguepay_active == 1)
            <!-- VoguePay -->
            <div class="col-xs-12 col-md-4 col-lg-4 pull-right">
              <div class="text-center">
                <form action="https://voguepay.com/pay/" method="post">
                  <input type="hidden" name="total" readonly value="{{$cart_total}}" />
                  <input type="hidden" name="store_id" value="{{Cart::count()}}" />
                  <input type="hidden" name="v_merchant_id" value="{{$gateway->voguepay_merchant_id}}" />
                  <input type="hidden" name="memo" value="Product Payment" />
                  <input type="hidden" name="developer_code" value="5a87c27f2d48a" />
                  <input type="hidden" name="cur" value="usd" />
                  <input type="hidden" name="merchant_ref" value="{{$total_supplier_price}}" />
                  <input type="hidden" name="success_url" value="{{route('account.gateway.voguepay_success')}}" />
                  <input type="hidden" name="fail_url" value="{{route('account.gateway.voguepay_fail')}}" />
                  {{-- temp --}}
                  <input type="hidden" name="initial_amount" value="{{Cart::priceTotal()}}">
                  <input type="hidden" name="coupon_id"
                    value="{{(Session::exists('coupon_id'))? Session::get('coupon_id'):0}}">
                  <input type="hidden" name="coupon_code"
                    value="{{(Session::exists('coupon_code'))? Session::get('coupon_code') :0}}">
                  <input type="hidden" name="coupon_percentage_off"
                    value="{{(Session::exists('coupon_percentage_off'))? Session::get('coupon_percentage_off'):0}}">
                  {{-- temp --}}
                  <button title="Pay with VoguePay" type="submit" name="submit" class="btn btn-primary"
                    onclick="return confirm('{{ __('Pay Via') }} VoguePay ?');"><i class="fa fa-check"></i>
                    VoguePay</button>
                </form>
              </div>
            </div>
            @endif

          </div>
          <hr />
          @endif





        </div>

      </div>

    </div>

  </div>




















  <style>
    @media screen and (max-width: 800px) {
      table#cart tbody td .form-control {
        width: 20%;
        display: inline !important;
      }

      .actions .btn {
        width: 36%;
        margin: 1.5em 0;
      }

      .actions .btn-info {
        float: left;
      }

      .actions .btn-danger {
        float: right;
      }

      table#cart thead {
        display: none;
      }

      table#cart tbody td {
        display: block;
        padding: .6rem;
        min-width: 240px;
      }

      table#cart tbody tr td:first-child {
        background: #333;
        color: #fff;
      }

      table#cart tbody td:before {
        content: attr(data-th);
        font-weight: bold;
        display: inline-block;
        width: 6rem;
      }



      table#cart tfoot td {
        display: block;
      }

      table#cart tfoot td .btn {
        display: block;
      }

    }
  </style>

  <!--container end.//-->
</section>
@endsection