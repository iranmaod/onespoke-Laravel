@extends('work.layouts.app')
@section('content')

<div class="card">
    <div class="card-header">
        <h5>Ebay Crawler</h5>
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


        <div class="row">
            <label class="col-sm-4 col-lg-2 col-form-label"></label>
            <div class="col-sm-8 col-lg-10">
                <div class="input-group">

                    <div class="panel panel-primary">
                        <div class="panel-heading" role="tab" id="headingOne_1">
                            <h4 class="panel-title">
                                <a role="button" class="btn btn-primary waves-effect" data-toggle="collapse" data-parent="#accordion_1" href="#collapseOne_1"
                                    aria-expanded="false" aria-controls="collapseOne_1" class="collapsed">
                                    Click to Preview Regex Settings <i class="fa fa-angle-down"></i>
                                </a>
                                <a href="{{ route('work.edit.ebay') }}" title="Edit">
                                    <button type="button" class="btn btn-warning waves-effect">
                                        <span>Edit Ebay Settings</span>
                                    </button>
                                </a>
                            </h4>
                        </div>
                        <div id="collapseOne_1" class="panel-collapse collapse" role="tabpanel"
                            aria-labelledby="headingOne_1" aria-expanded="false" style="height: 0px;">
                            <div class="panel-body">

                                <p><h5><u>Settings</u></h5></p>
                                <p><strong>Product Block ini: {{$crawler_ebay->product_block_ini}}</strong></p>
                                <p><strong>Product Name Element: {{$crawler_ebay->product_name_element}}</strong></p>
                                <p><strong>Product Url Element: {{$crawler_ebay->product_url_element}}</strong></p>
                                <p><strong>Product Image Element: {{$crawler_ebay->product_image_element}}</strong></p>
                                <p><strong>Product Price Element: {{$crawler_ebay->product_price_element}}</strong></p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
<hr/>
        <h6>{!!Session::get('message')!!}</h6>
        <form action="{{route('work.crawl.ebay_run')}}" method="post" enctype="multipart/form-data">
            {{csrf_field()}}

            <div class="row">
                <label class="col-sm-4 col-lg-2 col-form-label">Assign Supplier</label>
                <div class="col-sm-8 col-lg-10">
                    <div class="input-group">
                        <select id="supplier_id" name="supplier_id" class="form-control show-tick">
                            @foreach($suppliers as $supplier)
                            <option value="{{$supplier->id}}">{{$supplier->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="row">
                <label class="col-sm-4 col-lg-2 col-form-label">Select a Category</label>
                <div class="col-sm-8 col-lg-10">
                    <div class="input-group">
                        {!!$categories!!}
                    </div>
                </div>
            </div>

            <div class="row">
                <label class="col-sm-4 col-lg-2 col-form-label">Keywords</label>
                <div class="col-sm-8 col-lg-10">
                    <div class="input-group">
                        <input id="keywords" class="form-control" name="keywords" required type="text">
                    </div>
                </div>
            </div>
            <div class="row">
                <label class="col-sm-4 col-lg-2 col-form-label">Minimum Price </label>
                <div class="col-sm-8 col-lg-10">
                    <div class="input-group">
                        <input id="product_block" class="form-control" name="minimum_price" value="20" required
                            type="number">
                    </div>
                </div>
            </div>
            <div class="row">
                <label class="col-sm-4 col-lg-2 col-form-label">Products Per Page </label>
                <div class="col-sm-8 col-lg-10">
                    <div class="input-group">
                        <input id="depth" class="form-control" name="depth" value="25" min="1" max="50" required
                            type="number">
                    </div>
                </div>
            </div>
            <div class="row">
                <label class="col-sm-4 col-lg-2 col-form-label">Start Page </label>
                <div class="col-sm-8 col-lg-10">
                    <div class="input-group">
                        <input id="page" class="form-control" name="page" value="1" required type="number">
                    </div>
                </div>
            </div>
            <div class="row">
                <label class="col-sm-4 col-lg-2 col-form-label">Max Page </label>
                <div class="col-sm-8 col-lg-10">
                    <div class="input-group">
                        <input id="max_page" class="form-control" name="max_page" value="25" min="1" max="25" required
                            type="number">
                    </div>
                </div>
            </div>
            <br>
            <button type="submit" class="btn btn-primary m-t-15 waves-effect">Crawl</button>
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