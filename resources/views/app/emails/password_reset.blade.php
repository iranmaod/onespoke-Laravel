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
                            <h1 class="text-center">{{__('messages.Reset Password Email')}}!</h1>
                            <center data-parsed="">
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
                            <h1>{{__('messages.Hello')}}, {{$user->name}}</h1>
                            <p>{{__('messages.We are sending this email because we received a forgot password request')}}.</p>
                            <br>
                            <div class="button">
                                <a href="{{url('password/reset', $token)}}"
                                    style="background-color:#f7931d;border:0px solid #f7931d;border-radius:3px;color:#ffffff;display:inline-block;font-family:sans-serif;font-size:16px;font-weight:bold;line-height:35px;text-align:center;text-decoration:none;width:150px;-webkit-text-size-adjust:none;mso-hide:all;">
                                    {{__('messages.Reset Password')}}</a>
                            </div><br />
                            <p>{{__('messages.If you did not request a password reset, no further action is required. Please contact us if you did not submit this request')}}</p>
                            <hr />
                            <p>
                                {{__('messages.If you’re having trouble clicking the Reset Password button, copy and paste the URL below into your web browser')}}: <a
                                    href="{{url('password/reset', $token)}}">{{url('password/reset', $token)}}</a>
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