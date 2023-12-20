@extends('work.layouts.app')

@section('content')

<div class="card">
    <div class="card-header">
        <h3>{{ __('messages.User') }}: {{ __('messages.Profile') }}</h3>
    </div>
    <div class="icon-and-text-button-demo">
        <a href="{{route('work.supplier.edit',['id'=>$supplier->id])}}">
            <button type="button" class="btn btn-primary waves-effect">
                <i class="fa fa-edit"></i>
                <span>{{ __('messages.Edit') }}</span>
            </button>
        </a>
        <a href="{{ route('work.supplier.products_delete',['id'=>$supplier->id]) }}"
            onclick="return confirm('Do you want to delete all {{$supplier->name}}\'s products?');">
            <button type="button" class="btn btn-danger waves-effect">
                <i class="fa fa-trash"></i>
                <span>Delete {{$supplier->name}}'s Products</span>
            </button>
        </a>
    </div>

    <div class="card-block">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ __('messages.Username') }}</td>
                    <td>
                        <h4 style="color:#00b1b1;">{!!$supplier->name!!}
                    </td>
                </tr>
                <tr>
                    <td>{{ __('messages.Full Name') }}:</td>
                    <td>{!!$supplier->contact_name!!}</td>
                </tr>
                <tr>
                    <td>{{ __('messages.Email') }}:</td>
                    <td>{!!$supplier->email!!}</td>
                </tr>

                <tr>
                    <td>{{ __('messages.Country') }}:</td>
                    <td>{{$supplier->country->name}}</td>
                </tr>
                <tr>
                    <td>{{ __('messages.Address') }}:</td>
                    <td>{!!$supplier->address!!}</td>
                </tr>
                <tr>
                    <td>{{ __('messages.State') }}:</td>
                    <td>{!!$supplier->state!!}</td>
                </tr>
                <tr>
                    <td>{{ __('messages.City') }}:</td>
                    <td>{!!$supplier->city!!}</td>
                </tr>
                <tr>
                    <td>{{ __('messages.Postal Code') }}:</td>
                    <td>{!!$supplier->postal_code!!}</td>
                </tr>
                <tr>
                    <td>{{ __('messages.Phone') }}:</td>
                    <td>{!!$supplier->phone_number!!}</td>
                </tr>
                <tr>
                    <td>{{ __('messages.Active') }}:</td>
                    <td>@if ($supplier->active ==1 ) {{ __('messages.Yes') }} @else {{ __('messages.No') }} @endif</td>
                </tr>
                <tr>
                    <td>{{ __('messages.Signup Date') }}:</td>
                    <td>{{$supplier->created_at}}</td>
                </tr>
                <tr>
                    <td>REGEX</td>
                    <td>SETTINGS</td>
                </tr>
                <tr>
                    <td>Price Element:</td>
                    <td>{!!$supplier->price_update_element!!}</td>
                </tr>
                <tr>
                    <td>Stock Element:</td>
                    <td>{!!$supplier->stock_update_element!!}</td>
                </tr>
                <tr>
                    <td>Description Element:</td>
                    <td>{!!$supplier->description_update_element!!}</td>
                </tr>

                <tr>
                    <td>==</td>
                    <td>==</td>
                </tr>

                <tr>
                    <td>Amount Sold+Tax:</td>
                    <td><b> {!!$settings->currency->symbol!!}{!!number_format($amount_spent_with_tax,2)!!}</b></td>
                </tr>
                <tr>
                    <td>Amount Sold:</td>
                    <td>{!!$settings->currency->symbol!!}{!!number_format($amount_spent,2)!!}</b></td>
                </tr>
                <tr>
                    <td>Invoices:</td>
                    <td><b> {{$invoices_count}}</b></td>
                </tr>
                <tr>
                    <td>Items Sold:</td>
                    <td><b> {{$total_items_bought}}</b></td>
                </tr>

            </tbody>
        </table>
    </div>
</div>

<style>
    div.container {
        width: 100%;
    }

    .btn i {
        margin-right: 0%;
    }
</style>
<hr />

@endsection
@section('mainjs_script')
<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
@endsection