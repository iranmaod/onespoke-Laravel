@extends('emails.layouts.app')
@section('content')
<table class="row masthead">
    <tbody>
        <tr>
            <!-- Masthead -->
            <th class="small-12 large-12 columns first last">
                <table>
                    <tr>
                        <th>
                            <h1 class="text-center">{{__('messages.Tracking Code')}}!</h1>
                        </th>
                        <th class="expander"></th>
                    </tr>
                </table>
            </th>
        </tr>
    </tbody>
</table>
<table class="row">
    <tbody>
        <tr>
            <!--This container adds the gap between masthead and digest content -->
            <th class="small-12 large-12 columns first last">
                <table>
                    <tr>
                        <th>
                            &#xA0;
                        </th>
                        <th class="expander"></th>
                    </tr>
                </table>
            </th>
        </tr>
    </tbody>
</table>
<table class="row">
    <tbody>
        <tr>
            <!-- main Email content -->
            <th class="small-12 large-12 columns first last">
                <table>
                    <tr>
                        <th>
                            <h1>Hello, {{$contact_name}}</h1>
                            <p>{{__('messages.Details of your tracking code are listed below')}}.</p>
                            <b>==========================================</b>
                            <p><b>{{__('messages.Invoice Number')}}:</b> {{$invoice_number}}</p>
                            <p><b>{{__('messages.Product')}}:</b> {{$product_name}}</p>
                            <p><b>{{__('messages.Quantity')}}:</b> {{$quantity}}</p>
                            <p><b>{{__('messages.Tracking Code')}}:</b> {{$tracking_code}}</p>
                            <p>{{__('messages.Now input your tracking code')}} "{{$tracking_code}}" {{__('messages.in any of the Package trackers a few are listed below')}} </p>
                            <p><a href="https://www.17track.net/en">https://www.17track.net/en</a></p>
                            <p><a
                                    href="https://packageradar.com/china/aliexpress">https://packageradar.com/china/aliexpress</a>
                            </p>
                            <br>
                            <div class="button">
                                <a href="{{url('account/invoice/view/'.$invoice_number)}}"
                                    style="background-color:#f7931d;border:0px solid #f7931d;border-radius:3px;color:#ffffff;display:inline-block;font-family:sans-serif;font-size:16px;font-weight:bold;line-height:35px;text-align:center;text-decoration:none;width:150px;-webkit-text-size-adjust:none;mso-hide:all;">
                                    {{__('messages.View Invoice')}} 
                                </a>
                            </div>
                            <hr />
                            <div class="button">
                                <a href="{{url('/login')}}"
                                    style="background-color:#f7931d;border:0px solid #f7931d;border-radius:3px;color:#ffffff;display:inline-block;font-family:sans-serif;font-size:16px;font-weight:bold;line-height:35px;text-align:center;text-decoration:none;width:150px;-webkit-text-size-adjust:none;mso-hide:all;">
                                    {{__('messages.login')}}
                                </a>
                            </div>
                            <hr />
                            <b>
                                <h5>{{__('messages.Thank You')}}!</h5>
                            </b>
                        </th>
                        <th class="expander"></th>
                    </tr>
                </table>
            </th>
        </tr>
    </tbody>
</table>

<!-- end main email content -->
@endsection