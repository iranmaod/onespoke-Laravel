@extends('app.work.layouts.app')
@section('content')

<div class="card">
    <div class="card-header">
        <h5>Create Admin User</h5>
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
            <form action="{{route('work.admin.store')}}" method="post">
                {{csrf_field()}}
                <div class="row">
                    <label class="col-sm-4 col-lg-2 col-form-label">Username</label>
                    <div class="col-sm-8 col-lg-10">
                        <div class="input-group">
                            <input id="name" class="form-control fill" name="name" required type="text">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <label class="col-sm-4 col-lg-2 col-form-label">Display Name</label>
                    <div class="col-sm-8 col-lg-10">
                        <div class="input-group">
                            <input id="display_name" class="form-control fill" name="display_name" required type="text">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <label class="col-sm-4 col-lg-2 col-form-label">Email Address</label>
                    <div class="col-sm-8 col-lg-10">
                        <div class="input-group">
                            <input id="email_address" class="form-control fill" required name="email" type="email">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <label class="col-sm-4 col-lg-2 col-form-label">Password</label>
                    <div class="col-sm-8 col-lg-10">
                        <div class="input-group">
                            <input id="password" class="form-control fill" required name="password" type="password">
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