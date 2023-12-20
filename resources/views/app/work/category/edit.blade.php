@extends('work.layouts.app')
@section('content')

<div class="card">
    <div class="card-header">
        <h5>Edit Category: {{$category->name}}</h5>
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

        <form action="{{route('work.category.update',['id'=>$category->id])}}" method="post">
            {{csrf_field()}}
            <div class="row">
                <label class="col-sm-4 col-lg-2 col-form-label">Select Category Level</label>
                <div class="col-sm-8 col-lg-10">
                    <div class="input-group">
                        {!!$cat!!}
                    </div>
                </div>
            </div>
            <div class="row">
                <label class="col-sm-4 col-lg-2 col-form-label">Name</label>
                <div class="col-sm-8 col-lg-10">
                    <div class="input-group">
                        <input id="name" class="form-control" name="name" value="{{$category->name}}" required
                            type="text">
                    </div>
                </div>
            </div>
            <div class="row">
                <label class="col-sm-4 col-lg-2 col-form-label">Description</label>
                <div class="col-sm-8 col-lg-10">
                    <div class="input-group">
                        <input id="description" class="form-control" name="description"
                            value="{{$category->description}}" required type="text">
                    </div>
                </div>
            </div>

            <br>
            <button type="submit" class="btn btn-primary m-t-15 waves-effect"><i
                    class="material-icons">save</i>Update</button>
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