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
                            <h1 class="text-center">{{__('messages.Verification Email')}}!</h1>
                            <center data-parsed="">
                                <img src="{{asset('uploads/defaults/mail_pix.png')}}" valign="bottom" align="center"
                                    class="text-center">
                            </center>
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
                            <h2>{{__('messages.Verify Your Email Address')}}</h2>
                            <p>
                                {{__('messages.Thanks for creating an account with')}} {{$settings->site_name}}.
                                {{__('messages.Please follow the link below to verify your email address')}}
                            </p>
                            <p><b>Email:</b> {{$email}}</p>
                            <br>
                            <div class="button">
                                <a href="{{url('register/verify', $confirmation_code)}}"
                                    style="background-color:#f7931d;border:0px solid #f7931d;border-radius:3px;color:#ffffff;display:inline-block;font-family:sans-serif;font-size:16px;font-weight:bold;line-height:35px;text-align:center;text-decoration:none;width:150px;-webkit-text-size-adjust:none;mso-hide:all;">
                                    {{__('messages.Verify Email')}}</a>
                            </div>
                            <hr />
                            <p>
                                {{__('messages.If you’re having trouble clicking the button, copy and paste the URL below into your web browser')}}
                                : <a
                                    href="{{url('register/verify', $confirmation_code)}}">{{url('register/verify', $confirmation_code)}}</a>
                            </p>

                            <br>
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