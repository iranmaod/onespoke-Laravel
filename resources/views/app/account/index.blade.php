@extends('app.account.layouts.app')
@section('content')

<!-- CPU Usage -->
<div class="row">
    <div class="col-sm-12">

        <div class="card">
            <div class="card-header">
                <h5>
                    <font color="red">{{ __('messages.Account') }}</font>
                </h5>
            </div>
            <div class="row card-block">
                <div class="col-md-12">
                    <ul class="list-view">
                        <li>

                            {{-- customization --}}
                            <div class="row">



                                <div class="col-xl-6 col-md-12">
                                    <div class="card comp-card">
                                        <div class="card-body">
                                            <div class="row align-items-center">
                                                <div class="col">
                                                    <h6 class="m-b-25">{{ __('messages.Transactions') }}</h6>
                                                    <h3 class="f-w-700 text-c-blue">
                                                        {{$invoices_count}}
                                                        <div class="number count-to" data-from="0"
                                                            data-to="{{$invoices_count}}" data-speed="15"
                                                            data-fresh-interval="20"></div>
                                                    </h3>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fa fa-eye bg-c-blue"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-6 col-md-6">
                                    <div class="card comp-card">
                                        <div class="card-body">
                                            <div class="row align-items-center">
                                                <div class="col">
                                                    <h6 class="m-b-25">{{ __('messages.Amount Spent') }}!
                                                        {{-- ({!!$settings->currency->symbol !!})</h6> --}}
                                                    <h3 class="f-w-700 text-c-yellow">
                                                        {{$amount_spent}}
                                                    </h3>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fa fa-money bg-c-yellow"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-6 col-md-12">
                                    <div class="card comp-card">
                                        <div class="card-body">
                                            <div class="row align-items-center">
                                                <div class="col">
                                                    <h6 class="m-b-25">{{ __('messages.Products Bought') }}!</h6>
                                                    <h3 class="f-w-700 text-c-blue">
                                                        {{$total_products_bought}}
                                                    </h3>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fa fa-tag bg-c-blue"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-6 col-md-6">
                                    <div class="card comp-card">
                                        <div class="card-body">
                                            <div class="row align-items-center">
                                                <div class="col">
                                                    <h6 class="m-b-25">{{ __('messages.Items Bought') }}!</h6>
                                                    <h3 class="f-w-700 text-c-yellow">
                                                        {{$total_items_bought}}
                                                    </h3>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fa fa-tag bg-c-yellow"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>



                            </div>


                        </li>


                    </ul>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection

@section('mainjs_script')
<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
@endsection