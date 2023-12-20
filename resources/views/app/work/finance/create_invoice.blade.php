@extends('work.layouts.app')

@section('content')

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Generate Invoice
                                <small></small>
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
                            <form action="{{route('work.invoice.store')}}" method="post" enctype="multipart/form-data">
                              {{csrf_field()}}
                              <div class="form-group">
                                  <label for="category">Assign Customer</label>
                                  <select id="user_id" name="user_id" class="form-control show-tick" >
                                    @foreach($users as $user)
                                      <option value="{{$user->id}}">{{$user->name}}</option>
                                    @endforeach
                                </select>
                              </div>
                              <div class="form-group form-float">
                                  <label class="form-label"><u>Package Name:</u></label> {{$credit->package_name}}
                                  <input  class="form-control" required name="package_name" value="{{$credit->package_name}}" type="hidden" >
                              </div><hr />
                              <div class="form-group form-float">
                                <label class="form-label"><u>Description:</u></label> {!!$credit->description!!}
                                <input  class="form-control" required name="description" value="{{$credit->description}}" type="hidden" >
                              </div></hr>
                              <div class="form-group form-float">
                                <label class="form-label"><u>CPC Rate:</u></label> {{$credit->rate_per_click}}
                                <input  class="form-control" required name="rate_per_click" value="{{$credit->rate_per_click}}" type="hidden" >
                                </div></hr>

                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input id="amount" class="form-control" required name="amount" type="number" min="{{$credit->min}}" max="{{$credit->max}}">
                                        <label class="form-label">Amount</label>
                                    </div>
                                </div>
                                <br>
                                <button  type="submit" class="btn btn-primary m-t-15 waves-effect">Create</button>
                            </form>
                        </div>
                    </div>
                </div>

@endsection
@section('mainjs_script')
<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
@endsection
