@extends('app.account.layouts.app')
@section('content')
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jodit/3.1.92/jodit.min.css">

<form action="{{route('account.user.update')}}" method="post" enctype="multipart/form-data">
  {{csrf_field()}}
  <div class="card">
    <div class="card-block">
      <h5>{{ __('messages.Account') }}: {{$user->name}}
        <button type="submit" class="btn btn-primary m-t-15 waves-effect"><i class="fa fa-save"></i>{{ __('messages.Save') }}</button>

        <a href="">
          <button type="button" class=" pull-right btn btn-warning waves-effect">
            <i class="fa fa-refresh"></i><span>{{ __('messages.Refresh') }}</span>
          </button>
        </a>
      </h5>
    </div>
  </div>




  <div class="card">
    <div class="card-header">
      <h3>{{ __('messages.Email') }}{{ __('messages.Account') }} {{ __('messages.Information') }}</h3>
    </div>
    <div class="card-block">
      <h4 class="sub-title"></h4>
      {{-- start catch errors --}}
      <div class="body">
        @if (count($errors)>0)
        <ul class="list-group">
          @foreach($errors->all() as $error)
          <li class="list-group-item text-danger">
            {{$error}}
          </li>
          @endforeach
        </ul>
        @endif
      </div>
      {{-- end catch errors --}}

      {{-- start 1 --}}
      <div class="row">
        <div class="col-lg-12 col-xl-12">

          <div class="card">
            <div class="card-header">
              <h5>{{ __('messages.login') }} {{ __('messages.Information') }}</h5>
            </div>

            <div class="card-block">
              <div class="row form-group">
                <div class="col-sm-3">
                  <label class="col-form-label">{{ __('messages.Username') }}:<span style="color:red">*</span></label>
                </div>
                <div class="col-sm-9">
                  <input type="text" value="{{$user->name}}" readonly maxlength="255" class="form-control fill" required
                    name="name" placeholder="name">
                </div>
              </div>
              <div class="row form-group">
                <div class="col-sm-3">
                  <label class="col-form-label">{{ __('messages.Email') }}:<span style="color:red">*</span></label>
                </div>
                <div class="col-sm-9">
                  <input type="email" readonly value="{{$user->email}}" maxlength="255" class="form-control fill"
                    required name="email" placeholder="Email">
                </div>
              </div>


              <div class="row">
                <div class="col-sm-3">
                  <label class="col-form-label">{{ __('messages.Password') }}:</label>
                </div>
                <div class="col-sm-9">
                  <input id="password" class="form-control fill" name="password" type="password">
                </div>
              </div>
              <div class="row form-group">
                <div class="col-sm-3">
                  <label class="col-form-label"></label>
                </div>
                <div class="col-sm-9">
                  <span style="color:orange">** {{ __('messages.Password_helper_text') }} **</span>
                </div>
              </div>
              {{-- hidden --}}
              {{-- hidden --}}
            </div>
          </div>

        </div>

      </div>
      {{-- end 1 --}}





      <div class="card">
        <div class="card-header">
          <h5> {{ __('messages.Information') }}</h5>
        </div>
        <div class="card-block">

          <div class="row">
            <label class="col-sm-4 col-lg-2 col-form-label">{{ __('messages.Full Name') }}:<span style="color:red">*</span></label>
            <div class="col-sm-8 col-lg-10">
              <div class="input-group">
                <input type="text" class="form-control fill" required value="{{$user->contact_name}}"
                  name="contact_name" placeholder="Contact Name">
              </div>
            </div>
          </div>

          <div class="row">
            <label class="col-sm-4 col-lg-2 col-form-label">{{ __('messages.Phone Number') }}:<span style="color:red">*</span></label>
            <div class="col-sm-8 col-lg-10">
              <div class="input-group">
                <input type="text" class="form-control fill" required value="{{$user->phone_number}}"
                  name="phone_number" placeholder="">
              </div>
            </div>
          </div>


          <div class="row">
            <label class="col-sm-4 col-lg-2 col-form-label">{{ __('messages.Postal Code') }}:<span style="color:red">*</span></label>
            <div class="col-sm-8 col-lg-10">
              <div class="input-group">
                <input type="text" class="form-control fill" required value="{{$user->postal_code}}" name="postal_code"
                  placeholder="">
              </div>
            </div>
          </div>

          <div class="row">
            <label class="col-sm-4 col-lg-2 col-form-label">{{ __('messages.City') }}:<span style="color:red">*</span></label>
            <div class="col-sm-8 col-lg-10">
              <div class="input-group">
                <input type="text" class="form-control fill" required value="{{$user->city}}" name="city"
                  placeholder="">
              </div>
            </div>
          </div>

          <div class="row">
            <label class="col-sm-4 col-lg-2 col-form-label">{{ __('messages.State') }}:<span style="color:red">*</span></label>
            <div class="col-sm-8 col-lg-10">
              <div class="input-group">
                <input type="text" class="form-control fill" required value="{{$user->state}}" name="state"
                  placeholder="">
              </div>
            </div>
          </div>

          <div class="row">
            <label class="col-sm-4 col-lg-2 col-form-label">{{ __('messages.Country') }}<span style="color:red">*</span></label>
            <div class="col-sm-8 col-lg-10">
              <div class="input-group">
                <select id="country_id" required name="country_id" class="form-control form-control-primary fill">
                  @foreach($countries as $country)
                  <option value="{{$country->id}}" @if($user->country_id == $country->id)
                    selected
                    @endif
                    >{{$country->name}}</option>
                  @endforeach
                </select>
              </div>
            </div>
          </div>


          <div class="row">
            <label class="col-sm-4 col-lg-2 col-form-label">{{ __('messages.Address') }}:</label>
            <div class="col-sm-8 col-lg-10">
              <textarea rows="5" cols="5" id="about" name="address" class="form-control editor"
                placeholder="Input Shop Address...">
                {!!$user->address!!}
              </textarea>
            </div>
          </div>

        </div>
      </div>


      <input id="active" class="form-control" name="active" readonly value="{{$user->active}}" min="0" max="1" hidden
        required type="hidden">
      <input id="name" class="form-control" readonly name="name" value="{{$user->name}}" required type="hidden">
      <input id="email_address" readonly class="form-control" required name="email" value="{{$user->email}}"
        type="hidden">


      <div class="card">
        <div class="card-block">
          <center><button type="submit" class="btn btn-primary m-t-15 waves-effect"><i
                class="fa fa-save"></i>{{ __('messages.Save') }}</button>
          </center>
</form>
</div>
</div>



</div>
</div>





@endsection

@section('mainjs_script')
<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>

<script>
  tinymce.init({
        selector: '.editor',
    });
</script>
@endsection