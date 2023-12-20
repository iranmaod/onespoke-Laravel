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
                            <h1 class="text-center">{{__('messages.Contact Email')}}!</h1>
                            <center data-parsed="">
                                <img src="{{asset('uploads\defaults\mail_pix.png')}}" valign="bottom" align="center"
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
                            <center><u><b>{{__('messages.Details')}}</b></u></center>
                            <p><b>{{__('messages.Sender')}}:</b> {{$name}}</p>
                            <p><b>{{__('messages.Email')}}:</b> {{$email}}</p>
                            <p><b>{{__('messages.Subject')}}:</b> {{$subject}}</p>
                            <p>{!!$content!!}</p>

                            <br>
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