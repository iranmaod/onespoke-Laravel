@extends('app.work.layouts.app')
@section('content')

<div class="card">
    <div class="card-header">
        <h5>Create Supplier</h5>
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
        <hr> @endif
        <form action="{{route('work.supplier.store')}}" method="post" enctype="multipart/form-data">
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
                <label class="col-sm-4 col-lg-2 col-form-label">business/warehouse name</label>
                <div class="col-sm-8 col-lg-10">
                    <div class="input-group">
                        <input type="text" class="form-control fill" required name="name"
                            placeholder="business/warehouse name">
                    </div>
                </div>
            </div>

            <div class="row">
                <label class="col-sm-4 col-lg-2 col-form-label">Contact Name</label>
                <div class="col-sm-8 col-lg-10">
                    <div class="input-group">
                        <input type="text" class="form-control fill" required name="contact_name"
                            placeholder="Contact Name">
                    </div>
                </div>
            </div>

            <div class="row">
                <label class="col-sm-4 col-lg-2 col-form-label">Email</label>
                <div class="col-sm-8 col-lg-10">
                    <div class="input-group">
                        <input type="email" class="form-control fill" required name="email" placeholder="Email">
                    </div>
                </div>
            </div>

            <input id="active" class="form-control" required name="active" value="1" type="hidden">
            <button type="submit" class="btn btn-primary m-t-15 waves-effect"><i class="fa fa-save"></i>Save</button>


        </form>
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