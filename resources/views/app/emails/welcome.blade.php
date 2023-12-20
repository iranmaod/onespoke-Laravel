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
                            <h1 class="text-center">{{__('messages.Welcome Email')}}!</h1>
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
                            <h1>{{__('messages.Hello')}}, {{$contact_name}}</h1>
                            <p>{{__('messages.Hearty welcome')}}</p>
                            <center><u><b>{{__('messages.Details')}}</b></u></center>
                            <p><b>{{__('messages.Username')}}:</b> {{$name}}</p>
                            <p><b>{{__('messages.Email')}}:</b> {{$email}}</p>
                            <br>
                            <div class="button">
                                <a href="{{url('/login')}}"
                                    style="background-color:#f7931d;border:0px solid #f7931d;border-radius:3px;color:#ffffff;display:inline-block;font-family:sans-serif;font-size:16px;font-weight:bold;line-height:35px;text-align:center;text-decoration:none;width:150px;-webkit-text-size-adjust:none;mso-hide:all;">Login</a>
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