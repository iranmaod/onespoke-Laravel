@extends('layouts.app')
@section('title', 'Signup')
@section('content')
<br>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('messages.Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}" aria-label="{{ __('messages.Register') }}">
                        @csrf
                        @if (count($errors)>0)
                          <ul class="list-group">
                            @foreach($errors->all() as $error)
                              <li class="list-group-item text-danger">
                                {{$error}}
                              </li>
                            @endforeach

                          </ul> <br />
                        @endif

                      <div class="form-group row">
                          <label for="category" class="col-md-4 col-form-label text-md-right">{{ __('messages.Select Country') }}</label>
                          <div class="col-md-6">
                              <select id="country_id" name="country_id" class="form-control" value="{{ old('country_id') }}" required autofocus>
                                  @foreach($countries as $country)
                                    <option value="{{$country->id}}">{{$country->name}}</option>
                                  @endforeach
                              </select>
                          </div>
                      </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('messages.Username') }}</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required >
                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="contact_name" class="col-md-4 col-form-label text-md-right">{{ __('messages.Full Name') }}</label>
                            <div class="col-md-6">
                                <input id="contact_name" type="text" class="form-control" name="contact_name"  required >
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('messages.E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('messages.Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('messages.Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right"></label>

                            <div class="col-md-6">
                               {!! NoCaptcha::display(['data-theme' => 'dark']) !!}
                               @if ($errors->has('g-recaptcha-response'))
                                   <span class="invalid-feedback" role="alert">
                                       <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                                   </span>
                               @endif
                            </div>
                        </div>



                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                    {{ __('messages.Register') }}
                            </button>
                            </div>
                        </div><hr />
                        <div class="wd-policy">
                          <p>
                            {{ __('messages.By_Continuing_registration') }} <a href="{{route('single_page', ['slug'=>'tos'])}}">{{ __('messages.terms of uses') }}</a> {{ __('messages.and') }} <a href="{{route('single_page', ['slug'=>'policy-privacy'])}}">{{ __('messages.Privacy Policy') }}</a>.
                          </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<br>
@endsection
