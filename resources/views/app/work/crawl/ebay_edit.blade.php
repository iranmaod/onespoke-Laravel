@extends('work.layouts.app')
@section('content')

<div class="card">
    <div class="card-header">
        <h5>Ebay Regex </h5>
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
        <form action="{{route('work.save.ebay')}}" method="post" enctype="multipart/form-data">
            {{csrf_field()}}
            <div class="row">
                <label class="col-sm-4 col-lg-2 col-form-label">Product Block ini</label>
                <div class="col-sm-8 col-lg-10">
                    <div class="input-group">
                        <input id="product_block_ini" class="form-control" name="product_block_ini"
                            value="{{$crawler_ebay->product_block_ini}}" required type="text">
                    </div>
                </div>
            </div>
            <div class="row">
                <label class="col-sm-4 col-lg-2 col-form-label">Product Name Element</label>
                <div class="col-sm-8 col-lg-10">
                    <div class="input-group">
                        <input id="product_name_element" class="form-control" name="product_name_element"
                            value="{{$crawler_ebay->product_name_element}}" required type="text">
                    </div>
                </div>
            </div>
            <div class="row">
                <label class="col-sm-4 col-lg-2 col-form-label">Product Url Element</label>
                <div class="col-sm-8 col-lg-10">
                    <div class="input-group">
                        <input id="product_url_element" class="form-control" name="product_url_element"
                            value="{{$crawler_ebay->product_url_element}}" required type="text">
                    </div>
                </div>
            </div>
            <div class="row">
                <label class="col-sm-4 col-lg-2 col-form-label">Product Image Element</label>
                <div class="col-sm-8 col-lg-10">
                    <div class="input-group">
                        <input id="product_image_element" class="form-control" name="product_image_element"
                            value="{{$crawler_ebay->product_image_element}}" required type="text">
                    </div>
                </div>
            </div>
            <div class="row">
                <label class="col-sm-4 col-lg-2 col-form-label">Product Price Element</label>
                <div class="col-sm-8 col-lg-10">
                    <div class="input-group">
                        <input id="product_price_element" class="form-control" name="product_price_element"
                            value="{{$crawler_ebay->product_price_element}}" required type="text">
                    </div>
                </div>
            </div>
            <br>
            <button type="submit" class="btn btn-primary m-t-15 waves-effect">Save</button>
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