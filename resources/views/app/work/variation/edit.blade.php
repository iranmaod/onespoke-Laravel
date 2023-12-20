@extends('work.layouts.app')

@section('content')

<div class="card">
    <div class="card-header">
        <h5>Edit Variation Category: {{$variation->name}}</h5>
        </div>
    <div class="card-block">
    <form action="{{route('work.variation.update',['id'=>$variation->id])}}" method="post">
            {{csrf_field()}}
        <div class="row">
                <label class="col-sm-4 col-lg-2 col-form-label">Name</label>
                <div class="col-sm-8 col-lg-10">
                <div class="input-group">
                    <input type="text" value="{{$variation->name}}" class="form-control fill"  required name="name" placeholder="Name">
                </div>
                </div>
            </div>
            <button  type="submit" class="btn btn-primary m-t-15 waves-effect"><i class="fa fa-save"></i>Save</button>
        </form>
    </div>
</div>


@endsection
@section('mainjs_script')
<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
@endsection
