@extends('work.layouts.app')
@section('content')
<div class="card">
  <div class="card-header">
    <h5>
      <p>Edit Tracing Code for {{$sub_invoice->product_name}} <i class="fa fa-magnet"></i></p>
      <p>Qty: {{$sub_invoice->product_quantity}}</p>
      <p>Supplier: {{$sub_invoice->supplier}}</p>
    </h5>
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
    <form action="{{route('work.invoice.save')}}" method="post" enctype="multipart/form-data">
      {{csrf_field()}}
      <div class="row">
        <label class="col-sm-4 col-lg-2 col-form-label">Tracking Code</label>
        <div class="col-sm-8 col-lg-10">
          <div class="input-group">
            <input id="id" class="form-control" name="id"  value="{{$sub_invoice->id}}" type="hidden">
            <input type="text" class="form-control fill" name="tracking_code"  value="{{$sub_invoice->tracking_code}}" placeholder="Name">
          </div>
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