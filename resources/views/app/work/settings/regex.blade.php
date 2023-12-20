@extends('work.layouts.app')

@section('content')


<div class="card">
    <div class="card-header">
       <h3>{{ __('messages.REGULAR EXPRESSION') }}</h3>
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
   <h6>{!!Session::get('message')!!}</h6>
    <div class="card-block">
    <form action="{{route('work.settings.run_regex')}}" method="post" enctype="multipart/form-data">
            {{csrf_field()}}
        <div class="row">
             <label class="col-sm-4 col-lg-2 col-form-label">{{ __('messages.Product URL') }} <font color="red">*</font></label>
             <div class="col-sm-8 col-lg-10">
                <div class="input-group">
                   <input type="text" class="form-control fill" required  name="product_url" placeholder="{{ __('messages.Product URL') }}">
                </div>
             </div>
          </div>
          <div class="row">
            <label class="col-sm-4 col-lg-2 col-form-label">{{ __('messages.Product Block Element') }} <font color="red">*</font></label>
            <div class="col-sm-8 col-lg-10">
               <div class="input-group">
                  <input type="text" class="form-control fill" required  name="product_block_element" placeholder="{{ __('messages.Product Block Element') }}">
               </div>
            </div>
         </div>
         <div class="row">
            <label class="col-sm-4 col-lg-2 col-form-label">{{ __('messages.Type') }} <font color="red">*</font></label>
            <div class="col-sm-8 col-lg-10">
               <div class="input-group">
                  <select class="form-control show-tick" required name="type">
                            <option value="1" selected>Numeric</option>
                            <option value="2"> Text </option>
                            <option value="3"> Html </option>
                </select>
               </div>
            </div>
         </div>
          <button  type="submit" class="btn btn-primary m-t-15 waves-effect"> {{ __('messages.Run') }}</button>
       </form>
    </div>
 </div>




@endsection
@section('mainjs_script')
<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
@endsection
