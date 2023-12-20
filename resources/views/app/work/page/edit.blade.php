@extends('work.layouts.app')
@section('content')
<div class="card">
  <div class="card-header">
    <h5>Edit: {{$page->title}}</h5>
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
    <form action="{{route('work.page.update',['id'=>$page->id])}}" method="post" enctype="multipart/form-data">
      {{csrf_field()}}
      <div class="row">
        <label class="col-sm-4 col-lg-2 col-form-label">Page Title</label>
        <div class="col-sm-8 col-lg-10">
          <div class="input-group">
            <input type="text" value="{{$page->title}}" class="form-control fill" required name="title"
              placeholder="Name">
          </div>
        </div>
      </div>


      <div class="row">
        <label class="col-sm-4 col-lg-2 col-form-label">Contents</label>
        <div class="col-sm-8 col-lg-10">
          <textarea rows="5" required id="content" class="form-control no-resize editor" name="content"
            placeholder="Description ...">
                                {{$page->content}}
                        </textarea>
        </div>
      </div>
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