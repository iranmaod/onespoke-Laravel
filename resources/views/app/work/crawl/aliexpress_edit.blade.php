@extends('work.layouts.app')

@section('content')

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                      <div class="card">
                          <div class="header">
                              <h2>Edit Aliexpress Regex<i class="fas fa-magnet"></i></h2>
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
                            <form action="{{route('work.save.aliexpress')}}" method="post" enctype="multipart/form-data">
                                {{csrf_field()}}
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input id="product_block_ini" class="form-control" name="product_block_ini"  value="{{$crawler_aliexpress->product_block_ini}}" required type="text">
                                        <label class="form-label">Product Block ini</label>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input id="product_name_element" class="form-control" name="product_name_element"  value="{{$crawler_aliexpress->product_name_element}}" required type="text">
                                        <label class="form-label">Product Name Element</label>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input id="product_url_element" class="form-control" name="product_url_element"  value="{{$crawler_aliexpress->product_url_element}}" required type="text">
                                        <label class="form-label">Product Url Element</label>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input id="product_image_element" class="form-control" name="product_image_element"  value="{{$crawler_aliexpress->product_image_element}}" required type="text">
                                        <label class="form-label">Product Image Element</label>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input id="product_price_element" class="form-control" name="product_price_element"  value="{{$crawler_aliexpress->product_price_element}}" required type="text">
                                        <label class="form-label">Product Price Element</label>
                                    </div>
                                </div>
                                  <br>
                                  <button  type="submit" class="btn btn-primary m-t-15 waves-effect">Save</button>
                              </form>
                          </div>
                      </div>

</div>

@endsection
@section('mainjs_script')
<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
@endsection
