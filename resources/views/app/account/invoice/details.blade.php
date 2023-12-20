@extends('account.layouts.app')

@section('content')


<!-- for pinting puroses -->
<div id="div1">
    <!-- for pinting puroses -->
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header text-center">
                <a href="" onclick="printContent('div1')">
                    <button type="button" class="btn btn-primary waves-effect" title="PDF">
                        <i class="fa fa-print"></i>
                    </button>
                </a>
            </div>
            <!-- body start -->


            <div class="panel panel-default">
                <div class="panel-heading">
                </div>


                <div class="container">

                    <div class="row">
                        <div class="col-md-6 col-lg-6">
                            <img img src="{{asset($settings->logo)}}" alt="{{$settings->site_name}}" width="100"
                                height="50" align="left">
                        </div>
                        <div class="col-md-6 col-lg-6">
                            @if ($invoice->status == 1)
                            <h4>
                                <font color="779500" class="pull-right" align="right">{{ __('messages.PAID') }}</font>
                            </h4>
                            @elseif($invoice->status==0 && $invoice->validity > Carbon::now())
                            <h4>
                                <font color="B20B0B" class="pull-right" align="right">{{ __('messages.UNPAID') }}</font>
                            </h4>
                            @endif

                        </div>
                        <hr>
                        <div class="col-md-12 col-lg-12">
                            <div class="text-center">
                                <h1> {{$settings->site_name}} {{ __('messages.Invoice') }} </h1>
                                {{-- <i class="fa fa-search-plus pull-left icon"></i> --}}
                                <h3>{{$invoice->invoice_number}}</h3>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-6 col-lg-4">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>{{ __('messages.Billing Details') }}</h5>
                                        </div>
                                        <div class="card-block">
                                            <strong>{{ __('messages.Username') }}:</strong> {{$invoice_user->name}}<br>
                                            <strong>{{ __('messages.Contact') }}:</strong>
                                            {{$invoice_user->contact_name}}<br>
                                            <strong>{{ __('messages.Mail') }}:</strong> {{$invoice_user->email}}<br>
                                            <strong>{{ __('messages.Phone') }}:</strong> {{$invoice->phone}}<br>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-4">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>{{ __('messages.Address') }}</h5>
                                        </div>
                                        <div class="card-block">
                                            <strong>{{ __('messages.State') }}:</strong> {{$invoice->state}}<br>
                                            <strong>{{ __('messages.City') }}:</strong> {{$invoice->city}}<br>
                                            <strong>{{ __('messages.Postal Code') }}:</strong>
                                            {{$invoice->postal_code}}<br>
                                            <strong>{{ __('messages.Address') }}:</strong> {!!$invoice->address!!},
                                            {{$invoice->country}}<br>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-4">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>{{ __('messages.Payment Information') }}</h5>
                                        </div>
                                        <div class="card-block">
                                            <strong>{{ __('messages.Payment Status') }}:</strong>
                                            @if ($invoice->status == 1)
                                            <font color="green">{{ __('messages.PAID') }}</font>
                                            @elseif($invoice->status==0 && $invoice->validity > Carbon::now())
                                            <font color="red">{{ __('messages.UNPAID') }}</font>
                                            @endif<br>
                                            <strong>{{ __('messages.Method') }}:</strong>
                                            {{$invoice->payment_method}}<br>
                                            <strong>{{ __('messages.Date') }}:</strong> {{$invoice->created_at}}<br>

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="text-center"><strong>{{ __('messages.Order Summary') }}</strong></h3>
                                </div>
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-condensed">
                                            <thead>
                                                <tr>
                                                    <td><strong>{{ __('messages.Name') }}</strong></td>
                                                    <td class="text-center"><strong>{{ __('messages.Price') }}</strong>
                                                    </td>
                                                    <td class="text-center">
                                                        <strong>{{ __('messages.Quantity') }}</strong></td>
                                                    <td class="text-right">
                                                        <strong>{{ __('messages.Sub-Total') }}</strong></td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($sub_invs as $sub_invoice)
                                                <tr>
                                                    <td>{{$sub_invoice->product_name}}</td>
                                                    <td class="text-center">
                                                        <p>{!!$settings->currency->symbol!!}{{number_format(($sub_invoice->price_without_tax/$sub_invoice->product_quantity),2)}}
                                                        </p>
                                                    </td>
                                                    <td class="text-center">x {{$sub_invoice->product_quantity}}</td>
                                                    <td class="text-right">
                                                        {!!$sub_invoice->currency_symbol!!}{{number_format($sub_invoice->price_without_tax,2)}}
                                                    </td>
                                                </tr>
                                                @endforeach


                                                <tr>
                                                    <td class="highrow"></td>
                                                    <td class="highrow"></td>
                                                    <td class="highrow text-center">
                                                        <p><strong
                                                                title="Product Type">{{ __('messages.Types') }}:</strong>
                                                        </p>
                                                        <p><strong
                                                                title="Total Items">{{ __('messages.Items') }}:<strong>
                                                        </p>
                                                        @if($invoice->coupon_amount >0)
                                                            <p><strong>Coupon Used:<strong></p>
                                                        @endif
                                                        <p><strong>{{ __('messages.Order') }}:<strong></p>
                                                        <p><strong>{{ __('messages.Tax') }}({{$invoice->tax}}%):<strong>
                                                        </p>
                                                    </td>
                                                    <td class="highrow text-right">
                                                        <p>{{$invoice->total_products}}</p>
                                                        <p>{{$invoice->total_items}}</p>
                                                        @if($invoice->coupon_amount >0)
                                                            <p>{!!$invoice->currency_symbol!!}{{number_format($invoice->coupon_amount,2)}}
                                                        @endif
                                                        <p>{!!$invoice->currency_symbol!!}{{number_format($invoice->total_amount_without_tax,2)}}
                                                        </p>
                                                        <p>{!!$invoice->currency_symbol!!}{{number_format($invoice->tax_amount,2)}}
                                                        </p>
                                                    </td>
                                                </tr>


                                                <tr>
                                                    <td class="emptyrow"><i class="fa fa-barcode iconbig"></i></td>
                                                    <td class="emptyrow"></td>
                                                    <td class="emptyrow text-center">
                                                        <strong>{{ __('messages.Total') }}</strong></td>
                                                    <td class="emptyrow text-right"><strong>
                                                            {!!$invoice->currency_symbol!!}{{number_format($invoice->total_amount_with_tax,2)}}</strong>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <br />

                </div>



            </div>


        </div>

        <style>
            .table {
                width: 100%;
            }

            .container {
                width: auto;
            }

            .height {
                min-height: 200px;
            }

            .icon {
                font-size: 47px;
                color: #5CB85C;
            }

            .iconbig {
                font-size: 77px;
                color: #5CB85C;
            }

            .table>tbody>tr>.emptyrow {
                border-top: none;
            }

            .table>thead>tr>.emptyrow {
                border-bottom: none;
            }

            .table>tbody>tr>.highrow {
                border-top: 3px solid;
            }
        </style>

        <!-- body end -->
    </div>
</div>

@endsection
@section('mainjs_script')
<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
<script>
    function printContent(el){
	var restorepage = document.body.innerHTML;
	var printcontent = document.getElementById(el).innerHTML;
	document.body.innerHTML = printcontent;
	window.print();
	document.body.innerHTML = restorepage;
}
</script>
@endsection