@extends('work.layouts.app')

@section('content')

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                      <div class="card">
                          <div class="header">
                              <h2>
                                  AliExpress Crawler <i class="fas fa-magnet"></i>
                              </h2>
                              <ul class="header-dropdown m-r--5">
                                  <li class="dropdown">
                                      <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                          <i class="material-icons">more_vert</i>
                                      </a>
                                      <ul class="dropdown-menu pull-right">
                                          <li><a href="" class=" waves-effect waves-block">Refresh</a></li>
                                      </ul>
                                  </li>
                              </ul>
                          </div>
                          <div class="body">
                            @if (count($errors)>0)
                              <ul class="list-group">
                                @foreach($errors->all() as $error)
                                  <li class="list-group-item text-danger">
                                    {{$error}}
                                  </li>
                                @endforeach

                              </ul>
                            @endif
                            <h6>{!!Session::get('message')!!}</h6>
                            <div class="panel panel-primary">
                               <div class="panel-heading" role="tab" id="headingOne_1">
                                   <h4 class="panel-title">
                                       <a role="button" data-toggle="collapse" data-parent="#accordion_1" href="#collapseOne_1" aria-expanded="false" aria-controls="collapseOne_1" class="collapsed">
                                        View Regex <i class="fas fa-angle-down"></i>
                                      </a><a href="{{ route('work.edit.aliexpress') }}" title="Edit">
                                        <button type="button" class="btn btn-warning waves-effect">
                                            <i class="material-icons">edit</i>
                                            <span>Edit</span>
                                        </button>
                                      </a>
                                   </h4>
                               </div>
                               <div id="collapseOne_1" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne_1" aria-expanded="false" style="height: 0px;">
                                 <div class="panel-body">
                                   <p><strong>AliExpress</strong></p>
                                   <p><strong>Product Block ini:     {{$crawler_aliexpress->product_block_ini}}</strong></p>
                                   <p><strong>Product Name Element:  {{$crawler_aliexpress->product_name_element}}</strong></p>
                                   <p><strong>Product Url Element:   {{$crawler_aliexpress->product_url_element}}</strong></p>
                                   <p><strong>Product Image Element: {{$crawler_aliexpress->product_image_element}}</strong></p>
                                   <p><strong>Product Price Element: {{$crawler_aliexpress->product_price_element}}</strong></p>
                                 </div>
                               </div>
                           </div>
                            <form action="{{route('work.crawl.aliexpress_run')}}" method="post" enctype="multipart/form-data">
                                {{csrf_field()}}

                                <div class="form-group">
                                    <label for="category">Assign Supplier</label>
                                    <select id="supplier_id" name="supplier_id" class="form-control show-tick" >
                                      @foreach($suppliers as $supplier)
                                        <option value="{{$supplier->id}}">{{$supplier->name}}</option>
                                      @endforeach
                                  </select>
                                </div>
                                <label for="category">Select a Category</label>
                                {!!$categories!!}
                                <br /><br />
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input id="keywords" class="form-control" name="keywords"  required type="text">
                                        <label class="form-label">Keywords</label>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input id="product_block" class="form-control" name="minimum_price"  value="20" required type="number">
                                        <label class="form-label">Minimum Price </label>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input id="depth" class="form-control" name="depth" value="48" min="1" max="48" required type="number">
                                        <label class="form-label">Products Per Page </label>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input id="page" class="form-control" name="page" value="1" required type="number">
                                        <label class="form-label">Start Page </label>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input id="max_page" class="form-control" name="max_page" value="25" min="1" max="25" required type="number">
                                        <label class="form-label">Max Page </label>
                                    </div>
                                </div>
                                  <br>
                                  <button  type="submit" class="btn btn-primary m-t-15 waves-effect">Crawl</button>
                              </form>
                          </div>
                      </div>

</div>

@endsection
@section('mainjs_script')
<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
@endsection
