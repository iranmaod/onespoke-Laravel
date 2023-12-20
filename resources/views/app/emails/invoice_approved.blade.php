@extends('app.emails.layouts.app')
@section('content')
<table class="row masthead">
    <tbody>
        <tr>
            <!-- Masthead -->
            <th class="small-12 large-12 columns first last">
                <table>
                    <tr>
                        <th>
                            <h1 class="text-center">{{__('Invoice Approved')}}!</h1>
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
                            <h1>{{__('Hello')}}, {{$contact_name}}</h1>
                            <p>{{__('Your Invoice Has Been Approved')}}.</p>
                            <center><u><b>{{__('Details')}}</b></u></center>
                            <p><b>{{__('Username')}}:</b> {{$name}}</p>
                            <p><b>{{__('Date')}}:</b> {{$time}}</p>
                            <p><b>{{__('Number')}}:</b> {{$invoice_number}}</p>
                            <p><b>{{__('Amount')}}:</b> {{$currency}}{{number_format($amount,2)}}</p>
                            <p><b>{{__('Status')}}: <font color="green">{{__('Success')}}!</font></b></p>
                            <p><b>{{__('Processor')}}:</b> {{$processor}}</p>
                            <p><b>{{__('login')}}</b>{{__('to view full details')}} </p>
                            <br>
                            <div class="button">
                                <a href="{{url('account/invoice/view/'.$invoice_number)}}"
                                    style="background-color:#f7931d;border:0px solid #f7931d;border-radius:3px;color:#ffffff;display:inline-block;font-family:sans-serif;font-size:16px;font-weight:bold;line-height:35px;text-align:center;text-decoration:none;width:150px;-webkit-text-size-adjust:none;mso-hide:all;">
                                    {{__('View Invoice')}}</a>
                            </div>
                            <hr />
                            <div class="button">
                                <a href="{{url('/login')}}"
                                    style="background-color:#f7931d;border:0px solid #f7931d;border-radius:3px;color:#ffffff;display:inline-block;font-family:sans-serif;font-size:16px;font-weight:bold;line-height:35px;text-align:center;text-decoration:none;width:150px;-webkit-text-size-adjust:none;mso-hide:all;">
                                    {{__('login')}}</a>
                            </div>
                            <hr />
                            <b>
                                <h5>{{__('Thank You')}}!</h5>
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