@extends('app.work.layouts.app')
@section('content')

<!-- CPU Usage -->
<div class="row">
    <div class="col-sm-12">

        <div class="card">
            <div class="card-header">
                <h5>
                    <font color="red">{{ __('Account') }}</font>
                </h5>
            </div>
            <div class="row card-block">
                <div class="col-md-12">
                    <ul class="list-view">
                        <li>

                            {{-- customization --}}
                            <div class="row">



                                <div class="col-xl-4 col-md-12">
                                    <div class="card comp-card">
                                        <div class="card-body">
                                            <div class="row align-items-center">
                                                <div class="col">
                                                    <h6 class="m-b-25">{{ __('Products') }}</h6>
                                                    <h3 class="f-w-700 text-c-blue">
                                                        {{$products_count}}
                                                    </h3>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fa fa-list bg-c-blue"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-4 col-md-12">
                                    <div class="card comp-card">
                                        <div class="card-body">
                                            <div class="row align-items-center">
                                                <div class="col">
                                                    <h6 class="m-b-25">{{ __('Impressions') }}</h6>
                                                    <h3 class="f-w-700 text-c-blue">
                                                        {{$products_impressions}}
                                                    </h3>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fa fa-eye bg-c-blue"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-xl-4 col-md-6">
                                    <div class="card comp-card">
                                        <div class="card-body">
                                            <div class="row align-items-center">
                                                <div class="col">
                                                    <h6 class="m-b-25">{{ __('Items Sold') }}!</h6>
                                                    <h3 class="f-w-700 text-c-blue">
                                                        {{$total_items_bought}}
                                                    </h3>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fa fa-tag bg-c-blue"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                

                                <div class="col-xl-4 col-md-6">
                                    <div class="card comp-card">
                                        <div class="card-body">
                                            <div class="row align-items-center">
                                                <div class="col">
                                                    <h6 class="m-b-25">{{ __('Amount') }}!
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

                                <div class="col-xl-4 col-md-12">
                                    <div class="card comp-card">
                                        <div class="card-body">
                                            <div class="row align-items-center">
                                                <div class="col">
                                                    <h6 class="m-b-25">{{ __('Users') }}!</h6>
                                                    <h3 class="f-w-700 text-c-green">
                                                        {{$users_count}}
                                                    </h3>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fa fa-users bg-c-green"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-4 col-md-12">
                                    <div class="card comp-card">
                                        <div class="card-body">
                                            <div class="row align-items-center">
                                                <div class="col">
                                                    <h6 class="m-b-25">{{ __('Inactive Users') }}!</h6>
                                                    <h3 class="f-w-700 text-c-red">
                                                        {{$inactive_users}}
                                                    </h3>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fa fa-times bg-c-red"></i>
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