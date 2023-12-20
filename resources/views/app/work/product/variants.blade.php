@extends('work.layouts.app')
@section('content')

@include('work.layouts.includes.datatables')

<div class="card">
    <div class="card-header">
        <h1>{{$product->name}}</h1>
    </div>
    <div class="icon-and-text-button-demo">
        <a href="{{ route('work.product.create.variant',$product->id) }}">
            <button type="button" class="btn btn-primary waves-effect">
                <i class="fa fa-plus-circle"></i>
                <span>Add New Variant</span>
            </button>
        </a>
        <a href="">
            <button type="button" class="btn btn-warning waves-effect">
                <i class="fa fa-refresh"></i><span>{{ __('messages.Refresh') }}</span>
            </button>
        </a>
    </div>
    <br>

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="container">
            <div class="card"><br />
                <div class="col-md-12">
                    <h3 class="text-center">
                        <u>Main Product</u> <i class="fa fa-product-hunt" aria-hidden="true"></i>
                    </h3>
                    <div class="body table-responsive">
                        <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Supplier</th>
                                    <th>Category</th>
                                    <th>Views</th>
                                    <th>Cart+</th>
                                    <th>Stock</th>
                                    <th>Created</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                       $product_image_type= substr( $product->image, 0, 4 ) === "http";
                                       $product_image     = $product_image_type==1 ? $product->image : asset($product->image);
                                       $product_name      = $product->name;
                                       $product_name      = strlen($product_name) > 30 ? substr($product_name,0,30)."..." : $product_name;
                                       $product_page_link = url('/').'/'.$product->slug.'-'.$product->id;
                                       $delete_confirmation          = '\'Do You Want to Delete: '.$product->name.' ? \'';
                                       $update_confirmation          = '\'Do You Want to Update Price ? \'';
                                 ?>
                                <tr>
                                    <td><a href="{{$product_page_link}}" target="_blank"> {{$product_name}}</a><br>
                                        <img src="{{$product_image}}" alt="" width="100" height="50" />
                                    </td>
                                    <td>{!!$settings->currency->symbol!!}{{number_format($product->price,2)}}</td>
                                    <td>{!!$product->supplier->name!!}</td>
                                    <td><b>{!!$product->category->name!!}</b></td>
                                    <td>{{$product->views_count}}</td>
                                    <td>{{$product->cart_count}}</td>
                                    <td>{{$product->stock}}</td>
                                    <td>{{$product->created_at->toDateString()}}</td>
                                    <td>
                                        <a href="{{route('work.product.update_product',$product->id)}}"
                                            class="btn btn-primary btn-xs" title="Update Price"
                                            onclick="return confirm({{$update_confirmation}});"><i class="fa fa-refresh" aria-hidden="true"></i></a>
                                        <a href="{{$product->original_url}}" target="_blank" class="btn btn-info btn-xs"
                                            title="Visit Product On Supplier's Page"><i class="fa fa-globe" aria-hidden="true"></i></a>
                                        <a href="{{route('work.product.edit',$product->id)}}"
                                            class="btn btn-warning btn-xs" title="Edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                        <a href="{{route('work.product.delete',$product->id)}}"
                                            class="btn btn-danger btn-xs" title="Delete"
                                            onclick="return confirm({{$delete_confirmation}});"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div><hr/>

                @if(count($variants)>0)
                <h3 class="text-center">
                    <u>Variations</u> <i class="fa fa-random" aria-hidden="true"></i>
                </h3>
                <div class="col-md-12">
                    <div class="col-md-9">
                    </div>
                    <div class="col-md-3">
                        <h6 class="result"><b>Total</b> {{count($variants)}} </h6>
                    </div>
                </div>

                <div class="body table-responsive">
                    <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Price</th>
                                <th>Group</th>
                                <th>Varient</th>
                                <th>Views</th>
                                <th>Cart+</th>
                                <th>Stock</th>
                                <th>Created</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($variants as $variant)
                            <?php
                                   $variant_image_type= substr( $variant->image, 0, 4 ) === "http";
                                   $variant_image     = $variant_image_type==1 ? $variant->image : asset($variant->image);
                                   $variant_name      = $variant->name;
                                   $variant_name      = strlen($variant_name) > 30 ? substr($variant_name,0,30)."..." : $variant_name;
                                   $variant_page_link = url('/').'/'.$variant->slug.'-'.$variant->id;
                                   $delete_confirmation          = '\'Do You Want to Delete: '.$variant->name.' ? \'';
                                   $update_confirmation          = '\'Do You Want to Update Price ? \'';
                                    // get varient type

                                    ?>
                            <tr>
                                <td><a href="{{$variant_page_link}}" target="_blank"> {{$variant_name}}</a><br>
                                    <img src="{{$variant_image}}" alt="" width="100" height="50" />
                                </td>
                                <td>{!!$settings->currency->symbol!!}{{number_format($variant->price,2)}}</td>
                                <td><b>{{$variant->variant_type->name}}</b></td>
                                <td><b>{!!$variant->variant_name!!}</b></td>
                                <td>{{$variant->views_count}}</td>
                                <td>{{$variant->cart_count}}</td>
                                <td>{{$variant->stock}}</td>
                                <td>{{$variant->created_at->toDateString()}}</td>
                                <td>
                                    <a href="{{route('work.product.update_product',$variant->id)}}"
                                        class="btn btn-primary btn-xs" title="Update Price"
                                        onclick="return confirm({{$update_confirmation}});"><i class="fa fa-refresh" aria-hidden="true"></i></a>
                                    <a href="{{$variant->original_url}}" target="_blank" class="btn btn-info btn-xs"
                                        title="Visit Product On Supplier's Page"><i class="fa fa-globe" aria-hidden="true"></i></a>
                                    <a href="{{route('work.product.edit.variant',$variant->id)}}"
                                        class="btn btn-warning btn-xs" title="Edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                    <a href="{{route('work.product.delete',$variant->id)}}"
                                        class="btn btn-danger btn-xs" title="Delete"
                                        onclick="return confirm({{$delete_confirmation}});"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{$variants->appends(request()->query())->links()}}
                </div>
                @else
                <h2 class="text-center">This Product Has No Variations</h2>
                @endif

            </div>


        </div>
    </div>
</div>
<style>
    div.container {
        width: 100%;
    }
</style>




<hr />
<style>
    form.example input[type=text] {
        padding: 10px;
        font-size: 17px;
        border: 1px solid grey;
        float: left;
        width: 80%;
        background: #f1f1f1;
    }

    form.example button {
        float: left;
        width: 20%;
        padding: 10px;
        background: #2196F3;
        color: white;
        font-size: 17px;
        border: 1px solid grey;
        border-left: none;
        cursor: pointer;
    }

    form.example button:hover {
        background: #0b7dda;
    }

    form.example::after {
        content: "";
        clear: both;
        display: table;
    }
</style>
@endsection