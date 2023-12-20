@extends('app.work.layouts.app')
@section('content')


<div class="card">
  <div class="card-header">
    <h3>Import</h3>
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
    @endif
    <h4>{!!Session::get('message')!!}</h4>
    @if($files)
    @foreach($files as $file)
    <div class="alert alert-success text-center">
      <strong>Found: {{$file}}<br></strong>
    </div>
    @endforeach
    @else
    <div class="alert alert-warning text-center">
      <strong>No uploads yet!</strong>
    </div>
    @endif
    <hr>
    <div class="row">

      <div class="col-md-6">
        <form role="form" action="{{route('work.product.csv_upload')}}" method="post" enctype="multipart/form-data">
          {{csrf_field()}}
          <div class="form-group">
            <center>
              <input type="file" name="csv_file" id="csv_file" accept=".csv,.gz,csv.gz">
              <label for="upload" class="control-label">Only .csv or .csv.gz and .gz files are allowed.
              </label><br /><br />
              <input type="submit" class="btn btn-primary" value="Upload" name="upload">
              <a href="{{ asset('uploads/imports/sample/import.csv') }}"
                class="btn waves-effect waves-light btn-dribbble">Sample</a>
            </center>
          </div>
        </form>
      </div>



      <div class="col-md-3">
        <form action="{{route('work.product.csv_import')}}" method="post" enctype="multipart/form-data">
          {{csrf_field()}}
          <div class="input-group">
            <select id="category_id" name="category_id" class="form-control show-tick">
              @foreach($categories as $item)
              <option value="{{$item->id}}">{{$item->name}}</option>
              @endforeach
          </select>
          </div>
        </form>
      </div>


      <div class="col-md-3">
        <form action="{{route('work.product.csv_import')}}" method="post" enctype="multipart/form-data">
          {{csrf_field()}}
          <div class="input-group">
            <select id="supplier_id" required name="supplier_id" class="form-control form-control-primary fill">
              <option value="">-- Select Account --</option>
              @foreach($suppliers as $supplier)
              <option value="{{$supplier->id}}">{{$supplier->name}}</option>
              @endforeach
            </select>

            <div class="input-group">
              <input type="hidden" id="selected_category" value="1" name="selected_category">
            </div>
          </div>
          <center>
            <input type="submit" required class="btn btn-success text-center" value="Import Data" name="import">
          </center>
        </form>
      </div>




    </div>
  </div>


</div>
</div>
@endsection

@section('mainjs_script')
<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
<script>
  function myFunction(e) {
    document.getElementById("selected_category").value = e.target.value
}
</script>
@endsection