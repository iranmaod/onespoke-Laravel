@extends('app.account.layouts.app')
@section('content')


<div class="card">
  <div class="card-header">
    <h3>{{ __('messages.User') }}: {{ __('messages.Profile') }}</h3>
  </div>
  <div class="icon-and-text-button-demo">
    <a href="{{route('account.user.edit')}}">
      <button type="button" class="btn btn-primary waves-effect">
        <i class="fa fa-edit"></i>
        <span>{{ __('messages.Edit') }}</span>
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
            <h4 style="color:#00b1b1;">{!!$user->name!!}
          </td>
        </tr>
        <tr>
          <td>{{ __('messages.Full Name') }}:</td>
          <td>{!!$user->contact_name!!}</td>
        </tr>
        <tr>
          <td>{{ __('messages.Email') }}:</td>
          <td>{!!$user->email!!}</td>
        </tr>

        <tr>
          <td>{{ __('messages.Country') }}:</td>
          <td>{{$user->country}}</td>
        </tr>
        <tr>
          <td>{{ __('messages.Address') }}:</td>
          <td>{!!$user->address!!}</td>
        </tr>
        <tr>
          <td>{{ __('messages.State') }}:</td>
          <td>{!!$user->state!!}</td>
        </tr>
        <tr>
          <td>{{ __('messages.City') }}:</td>
          <td>{!!$user->city!!}</td>
        </tr>
        <tr>
          <td>{{ __('messages.Postal Code') }}:</td>
          <td>{!!$user->postal_code!!}</td>
        </tr>
        <tr>
          <td>{{ __('messages.Phone') }}:</td>
          <td>{!!$user->phone_number!!}</td>
        </tr>
        <tr>
          <td>{{ __('messages.Active') }}:</td>
          <td>@if ($user->active ==1 ) {{ __('messages.Yes') }} @else {{ __('messages.No') }} @endif</td>
        </tr>
        <tr>
          <td>{{ __('messages.Signup Date') }}:</td>
          <td>{{$user->created_at}}</td>
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