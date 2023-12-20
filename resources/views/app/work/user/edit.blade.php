@extends('work.layouts.app')
@section('content')

<div class="card">
  <div class="card-header">
    <h5>Customer: {{$user->name}}</h5>
  </div>
  <div class="card-block">
    @if (count($errors)>0)
    <ul class="list-group">
      @foreach($errors->all() as $error)
      <li class="list-group-item text-danger">
        {{$error}}
      </li>
      @endforeach
    </ul>
    <hr>
    @endif
    <div class="body">
      <form action="{{route('work.user.update',['id'=>$user->id])}}" method="post" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="row">
          <label class="col-sm-4 col-lg-2 col-col-sm-4 col-lg-2 col-form-label">Select Country</label>
          <div class="col-sm-8 col-lg-10">
            <div class="input-group">
              <select id="country_id" name="country_id" class="form-control fill show-tick">
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
    </div>

    <div class="row">
      <label class="col-sm-4 col-lg-2 col-form-label">Username</label>
      <div class="col-sm-8 col-lg-10">
        <div class="input-group">
          <input id="name" class="form-control" readonly name="name" value="{{$user->name}}" required type="text">
        </div>
      </div>
    </div>


    <div class="row">
      <label class="col-sm-4 col-lg-2 col-form-label">Full Name</label>
      <div class="col-sm-8 col-lg-10">
        <div class="input-group">
          <input id="contact_name" class="form-control" name="contact_name" value="{{$user->contact_name}}" required
            type="text">
        </div>
      </div>
    </div>

    <div class="row">
      <label class="col-sm-4 col-lg-2 col-form-label">Email Address</label>
      <div class="col-sm-8 col-lg-10">
        <div class="input-group">
          <input id="email_address" readonly class="form-control" required name="email" value="{{$user->email}}"
            type="email">
        </div>
      </div>
    </div>
    <div class="row">
      <label class="col-sm-4 col-lg-2 col-form-label">Phone Number</label>
      <div class="col-sm-8 col-lg-10">
        <div class="input-group">
          <input id="phone_number" class="form-control" name="phone_number" value="{{$user->phone_number}}" type="text">
        </div>
      </div>
    </div>


    <div class="row">
      <label class="col-sm-4 col-lg-2 col-form-label">Address</label>
      <div class="col-sm-8 col-lg-10">
              <textarea rows="5" required="" id="address" class="form-control no-resize editor" name="address" placeholder="Description ..." >                    
                {!!$user->address!!}
              </textarea>
      </div>
  </div>


    <div class="row">
      <label class="col-sm-4 col-lg-2 col-form-label">State</label>
      <div class="col-sm-8 col-lg-10">
        <div class="input-group">
          <input id="state" class="form-control" name="state" value="{{$user->state}}" type="text">
        </div>
      </div>
    </div>
    <div class="row">
      <label class="col-sm-4 col-lg-2 col-form-label">City</label>
      <div class="col-sm-8 col-lg-10">
        <div class="input-group">
          <input id="city" class="form-control" name="city" value="{{$user->city}}" type="text">
        </div>
      </div>
    </div>
    <div class="row">
      <label class="col-sm-4 col-lg-2 col-form-label">Postal Code</label>
      <div class="col-sm-8 col-lg-10">
        <div class="input-group">
          <input id="postal_code" class="form-control" name="postal_code" value="{{$user->postal_code}}" type="text">
        </div>
      </div>
    </div>

    <div class="row">
      <label class="col-sm-4 col-lg-2 col-form-label"></label>
      <div class="col-sm-8 col-lg-10">
        <div class="input-group">
          <span style="color:orange">**Leave Blank if you dont want to change **</span>
        </div>
      </div>
    </div>
    <div class="row">
      <label class="col-sm-4 col-lg-2 col-form-label">Password</label>
      <div class="col-sm-8 col-lg-10">
        <div class="input-group">
          <input id="password" class="form-control" name="password" type="password">
        </div>
      </div>
    </div>

    <div class="row">
      <label class="col-sm-4 col-lg-2 col-form-label">Active</label>
      <div class="col-sm-8 col-lg-10">
        <div class="input-group">
          <input id="active" class="form-control" name="active" value="{{$user->active}}" min="0" max="1" required
            type="number">
        </div>
      </div>
    </div>

    <br>
    <button type="submit" class="btn btn-primary m-t-15 waves-effect"><i class="material-icons">save</i>Update</button>
    </form>
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