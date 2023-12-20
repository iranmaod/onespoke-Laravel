@extends('work.layouts.app')

@section('content')

<div class="card">
  <div class="card-header">
    <h4>Create New Variant <i class="fa fa-plus-circle" aria-hidden="true"></i> <i class="fa fa-random"
        aria-hidden="true"></i> </h4>
    <h5>Main Product: {{$product->name}}</h5>
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
    <form action="{{route('work.product.store.variant')}}" method="post" enctype="multipart/form-data">
      {{csrf_field()}}
      <div class="row">
        <label class="col-sm-4 col-lg-2 col-form-label">Sub Product Name</label>
        <div class="col-sm-8 col-lg-10">
          <div class="input-group">
            <input id="name" class="form-control" name="name" title="name" value="{{$product->name}}" required
              type="text">
          </div>
        </div>
      </div>

      <input id="supplier_id" class="form-control" name="supplier_id" value="{{$product->supplier->id}}" type="hidden">
      <input id="category_id" class="form-control" name="category_id" value="{{$product->category->id}}" type="hidden">
      <input id="parent_id" class="form-control" name="parent_id" value="{{$product->id}}" type="hidden">

      <div class="row">
        <label class="col-sm-4 col-lg-2 col-form-label">Select Varient Type</label>
        <div class="col-sm-8 col-lg-10">
          <div class="input-group">
            <select id="variant_id" name="variant_id" class="form-control show-tick">
              @foreach($variant_types as $variant_type)
              <option value="{{$variant_type->id}}">{{$variant_type->name}}</option>
              @endforeach
            </select>
          </div>
        </div>
      </div>

      <div class="row">
        <label class="col-sm-4 col-lg-2 col-form-label">Variant name</label>
        <div class="col-sm-8 col-lg-10">
          <div class="input-group">
            <input id="variant_name" class="form-control" name="variant_name" title="" type="text">

          </div>
        </div>
      </div>

      <div class="row">
        <label class="col-sm-4 col-lg-2 col-form-label">Featured image</label>
        <div class="col-sm-8 col-lg-10">
            <div class="input-group">
                <input id="image" class="form-control" name="image" required type="file" accept="image/*">
            </div>
        </div>
    </div>
    <!-- more images -->
      <div class="row">
        <label class="col-sm-4 col-lg-2 col-form-label">(Optional)More Images </label>
        <div class="col-sm-8 col-lg-10">
          <div class="input-group">

            <div class="panel panel-primary">
              <div class="panel-heading" role="tab" id="headingOne_1">
                <h4 class="panel-title">
                  <a role="button" data-toggle="collapse" data-parent="#accordion_1" href="#collapseOne_1"
                    aria-expanded="false" aria-controls="collapseOne_1" class="collapsed">
                    Click to Add More Images <i class="fa fa-arrow-down"></i>
                  </a>
                </h4>
              </div>
              <div id="collapseOne_1" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne_1"
                aria-expanded="false" style="height: 0px;">
                <div class="panel-body">
                  <div class="row">
                    <div class="col-sm-8 col-lg-10">
                      <div class="input-group">
                        <input id="image_ex1" class="form-control" name="image_ex1" type="file" accept="image/*">
                        <input id="image_ex2" class="form-control" name="image_ex2" type="file" accept="image/*">
                        <input id="image_ex3" class="form-control" name="image_ex3" type="file" accept="image/*">
                        <input id="image_ex4" class="form-control" name="image_ex4" type="file" accept="image/*">
                        <input id="image_ex5" class="form-control" name="image_ex5" type="file" accept="image/*">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
      <!-- end more images -->
      <div class="row">
        <label class="col-sm-4 col-lg-2 col-form-label">Original Link</label>
        <div class="col-sm-8 col-lg-10">
          <div class="input-group">
            <input id="original_url" class="form-control" name="original_url" title="For Update Purposes" type="text">
          </div>
        </div>
      </div>



      <input id="active" class="form-control" name="active" value="1" type="hidden">
      <div class="row">
        <label class="col-sm-4 col-lg-2 col-form-label">Description</label>
        <div class="col-sm-8 col-lg-10">
          <textarea rows="5" required="" id="address" class="form-control no-resize editor" name="description"
            placeholder="Description ...">

                                          </textarea>
        </div>
      </div>
      <br>

      <div class="row">
        <label class="col-sm-4 col-lg-2 col-form-label">Stock</label>
        <div class="col-sm-8 col-lg-10">
          <div class="input-group">
            <input id="stock" class="form-control" required name="stock" type="number">
          </div>
        </div>
      </div>
      <div class="row">
        <label class="col-sm-4 col-lg-2 col-form-label">Supplier Price</label>
        <div class="col-sm-8 col-lg-10">
          <div class="input-group">
            <input id="price" class="form-control" required name="price" type="text">
          </div>
        </div>
      </div>

      <br>
      <button type="submit" class="btn btn-primary m-t-15 waves-effect">Create</button>
    </form>
    <hr />
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