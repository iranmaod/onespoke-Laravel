@extends('work.layouts.app')
@section('content')

<div class="card">
    <div class="card-header">
        <h5>Create User</h5>
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
            <form action="{{route('work.user.store')}}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="row">
                    <label class="col-sm-4 col-lg-2 col-form-label">Select Country</label>
                    <div class="col-sm-8 col-lg-10">
                        <div class="input-group">
                            <select id="country_id" name="country_id" class="form-control form-control-primary fill">
                                @foreach($countries as $country)
                                <option value="{{$country->id}}">{{$country->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <label class="col-sm-4 col-lg-2 col-form-label">Username</label>
                    <div class="col-sm-8 col-lg-10">
                        <div class="input-group">
                            <input id="name" class="form-control" name="name" required type="text">
                        </div>
                    </div>
                </div>
                <!-- <div class="row">
                                  <label class="col-sm-4 col-lg-2 col-form-label">Featured image</label>
                                  <input id="image" class="form-control" name="image"  required type="file">
                              </div> -->
                <div class="row">
                    <label class="col-sm-4 col-lg-2 col-form-label">Contact Name </label>
                    <div class="col-sm-8 col-lg-10">
                        <div class="input-group">
                            <input id="contact_name" class="form-control" name="contact_name" required type="text">
                        </div>
                    </div>
                </div>
                <!-- <div class="row">
                                                      <div class="col-sm-8 col-lg-10">
                        <div class="input-group">
                                      <input id="url" class="form-control" name="url"  required type="text">
                                      <label class="col-sm-4 col-lg-2 col-form-label">Website</label>
                                  </div>
                              </div> -->

                <div class="row">
                    <label class="col-sm-4 col-lg-2 col-form-label">Email Address</label>
                    <div class="col-sm-8 col-lg-10">
                        <div class="input-group">
                            <input id="email_address" class="form-control" required name="email" type="email">
                        </div>
                    </div>
                </div>
                <input id="active" class="form-control" required name="active" value="1" type="hidden">
                <div class="row">
                    <label class="col-sm-4 col-lg-2 col-form-label">Password</label>
                    <div class="col-sm-8 col-lg-10">
                        <div class="input-group">
                            <input id="password" class="form-control" required name="password" type="password">
                        </div>
                    </div>
                </div>
                <br>
                <button type="submit" class="btn btn-primary m-t-15 waves-effect">Create</button>
            </form>
        </div>
    </div>
</div>

@endsection
@section('mainjs_script')
<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
@endsection