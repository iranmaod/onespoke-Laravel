@extends('work.layouts.app')

@section('content')

<div class="card">
    <div class="card-header">
        <h4>Product: {{$product->name}} <i class="fa fa-random" aria-hidden="true"></i> </h4>
        <h5>Sub/Variant of: {{$product->parent->name}}</h5>
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
        <form action="{{route('work.product.update.variant',['id'=>$product->id])}}" method="post"
            enctype="multipart/form-data">
            {{csrf_field()}}

            <div class="row">
                <label class="col-sm-4 col-lg-2 col-form-label">Sub Product Name</label>
                <div class="col-sm-8 col-lg-10">
                    <div class="input-group">
                        <input id="name" class="form-control" value="{{$product->name}}" name="name" required title=""
                            type="text">
                    </div>
                </div>
            </div>

            <input id="supplier_id" class="form-control" name="supplier_id" value="{{$product->supplier->id}}"
                type="hidden">
            <input id="category_id" class="form-control" name="category_id" value="{{$product->category->id}}"
                type="hidden">


            <div class="row">
                <label class="col-sm-4 col-lg-2 col-form-label">Select Varient Type</label>
                <div class="col-sm-8 col-lg-10">
                    <div class="input-group">
                        <select id="variant_id" name="variant_id" class="form-control show-tick">
                            @foreach($variant_types as $variant_type)
                            <option value="{{$variant_type->id}}" @if($product->variant_id == $variant_type->id)
                                selected
                                @endif

                                >{{$variant_type->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="row">
                <label class="col-sm-4 col-lg-2 col-form-label">Variant name</label>
                <div class="col-sm-8 col-lg-10">
                    <div class="input-group">
                        <input id="variant_name" class="form-control" value="{{$product->variant_name}}"
                            name="variant_name" required title="" type="text">
                    </div>
                </div>
            </div>


            <div class="row">
                <label class="col-sm-4 col-lg-2 col-form-label">Featured image</label>
                <div class="col-sm-4 col-lg-5">
                    <div class="input-group">
                        <input id="image" class="form-control" name="image" type="file" accept="image/*">
                    </div>
                </div>
                <div class="col-sm-4 col-lg-5">
                    <div class="input-group">
                        <img src="{{asset($product_image)}}" alt="{{$product->name}}" width="100px" height="50px" />
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
                                    <a role="button" data-toggle="collapse" data-parent="#accordion_1"
                                        href="#collapseOne_1" aria-expanded="false" aria-controls="collapseOne_1"
                                        class="collapsed">
                                        Click to Add More Images <i class="fa fa-arrow-down"></i>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseOne_1" class="panel-collapse collapse" role="tabpanel"
                                aria-labelledby="headingOne_1" aria-expanded="false" style="height: 0px;">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-sm-4 col-lg-5">
                                            <div class="input-group">
                                                <input id="image_ex1" class="form-control" name="image_ex1" type="file"
                                                    accept="image/*">
                                            </div>
                                        </div>
                                        <div class="col-sm-4 col-lg-5">
                                            <div class="input-group">
                                                <img src="{{asset($product->image_ex1)}}" alt="not set" width="100px"
                                                    height="50px" />
                                            </div>
                                        </div>
                                        <div class="col-sm-4 col-lg-5">
                                            <div class="input-group">
                                                <input id="image_ex2" class="form-control" name="image_ex2" type="file"
                                                    accept="image/*"></div>
                                        </div>
                                        <div class="col-sm-4 col-lg-5">
                                            <div class="input-group">
                                                <img src="{{asset($product->image_ex2)}}" alt="not set" width="100px"
                                                    height="50px" />
                                            </div>
                                        </div>
                                        <div class="col-sm-4 col-lg-5">
                                            <div class="input-group">
                                                <input id="image_ex3" class="form-control" name="image_ex3" type="file"
                                                    accept="image/*"></div>
                                        </div>
                                        <div class="col-sm-4 col-lg-5">
                                            <div class="input-group">
                                                <img src="{{asset($product->image_ex3)}}" alt="not set" width="100px"
                                                    height="50px" />
                                            </div>
                                        </div>
                                        <div class="col-sm-4 col-lg-5">
                                            <div class="input-group">
                                                <input id="image_ex4" class="form-control" name="image_ex4" type="file"
                                                    accept="image/*"></div>
                                        </div>
                                        <div class="col-sm-4 col-lg-5">
                                            <div class="input-group">
                                                <img src="{{asset($product->image_ex4)}}" alt="not set" width="100px"
                                                    height="50px" />
                                            </div>
                                        </div>
                                        <div class="col-sm-4 col-lg-5">
                                            <div class="input-group">
                                                <input id="image_ex5" class="form-control" name="image_ex5" type="file"
                                                    accept="image/*"></div>
                                        </div>
                                        <div class="col-sm-4 col-lg-5">
                                            <div class="input-group">
                                                <img src="{{asset($product->image_ex5)}}" alt="not set" width="100px"
                                                    height="50px" />
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
                        <input id="original_url" class="form-control" value="{{$product->original_url}}"
                            name="original_url" title="For Update Purposes" type="text">
                    </div>
                </div>
            </div>
            <input id="active" class="form-control" name="active" value="1" type="hidden">
            <div class="row">
                <label class="col-sm-4 col-lg-2 col-form-label">Description</label>
                <div class="col-sm-8 col-lg-10">
                    <textarea rows="5" required="" id="address" class="form-control no-resize editor" name="description"
                        placeholder="Description ...">
                            {!!$product->description!!}
                        </textarea>
                </div>
            </div>
            <div class="row">
                <label class="col-sm-4 col-lg-2 col-form-label">Stock</label>
                <div class="col-sm-8 col-lg-10">
                    <div class="input-group">
                        <input id="stock" class="form-control" required value="{{$product->stock}}" name="stock"
                            type="number">
                    </div>
                </div>
            </div>
            <div class="row">
                <label class="col-sm-4 col-lg-2 col-form-label">Supplier Price</label>
                <div class="col-sm-8 col-lg-10">
                    <div class="input-group">
                        <input id="supplier_price" class="form-control" required value="{{$product->supplier_price}}"
                            name="supplier_price" type="text">
                    </div>
                </div>
            </div>
            <div class="row">
                <label class="col-sm-4 col-lg-2 col-form-label">Sale Price</label>
                <div class="col-sm-8 col-lg-10">
                    <div class="input-group">
                        <input id="price" class="form-control" required value="{{$product->price}}" name="price"
                            type="text">
                    </div>
                </div>
            </div>
            <br>
            <button type="submit" class="btn btn-primary m-t-15 waves-effect">Update</button>
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