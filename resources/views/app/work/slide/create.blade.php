@extends('work.layouts.app')

@section('content')


<div class="card">
    <div class="card-header">
       <h3>{{ __('messages.Create Slide') }}</h3>
     </div>
     @if (count($errors)>0)
     <ul class="list-group">
       @foreach($errors->all() as $error)
         <li class="list-group-item text-danger">
           {{$error}}
         </li>
       @endforeach

     </ul>
   @endif
    <div class="card-block">
    <form action="{{route('work.slide.store')}}" method="post" enctype="multipart/form-data">
            {{csrf_field()}}
        <div class="row">
             <label class="col-sm-4 col-lg-2 col-form-label">{{ __('messages.Url Target Link') }}</label>
             <div class="col-sm-8 col-lg-10">
                <div class="input-group">
                   <input type="text" class="form-control fill"   name="url" placeholder="{{ __('messages.Url Target Link') }}">
                </div>
             </div>
          </div>
          <div class="row">
                <label class="col-sm-4 col-lg-2 col-form-label">{{ __('messages.Image') }}<font color="red">*</font></label>
                <div class="col-sm-8 col-lg-10">
                   <div class="input-group">
                      <input id="image" class="form-control" name="image"  required type="file">
                    </div>
                </div>
          </div>
          <button  type="submit" class="btn btn-primary m-t-15 waves-effect"><i class="fa fa-save"></i>{{ __('messages.Save') }}</button>
       </form>
    </div>
 </div>




@endsection
@section('mainjs_script')
<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
@endsection
