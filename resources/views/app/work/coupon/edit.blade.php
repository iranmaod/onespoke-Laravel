@extends('work.layouts.app')
@section('content')
<div class="card">
  <div class="card-header">
    <h5>Edit: {{$coupon->code}} </h5>
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
    <form action="{{route('work.coupon.update',['id'=>$coupon->id])}}" method="post" enctype="multipart/form-data">
      {{csrf_field()}}

    <div class="row">
        <label class="col-sm-4 col-lg-4 col-form-label">Percent off%</label>
        <div class="col-sm-8 col-lg-8">
            <div class="input-group">
            <input type="number" step="0.01" placeholder="0.00" max="100" class="form-control fill" required name="percentage_off" value="{{$coupon->percentage_off}}" placeholder="">
            </div>
        </div>
    </div>
    <div class="row">
        <label class="col-sm-4 col-lg-4 col-form-label">Applicable for New to Old Customers based on Signup(Days)</label>
        <div class="col-sm-8 col-lg-8">
            <div class="input-group">
                <input type="number" min="1"  max="100000000" class="form-control fill" required name="customer_age" value="{{$coupon->customer_age}}" placeholder="">
            </div>
        </div>
    </div>
    <div class="row">
        <label class="col-sm-4 col-lg-4 col-form-label">Total Usage Remaining</label>
        <div class="col-sm-8 col-lg-8">
            <div class="input-group">
                <input type="number" min="1"  class="form-control fill" required name="usage_total" value="{{$coupon->usage_total}}" placeholder="">
            </div>
        </div>
    </div>
    <div class="row">
        <label class="col-sm-4 col-lg-4 col-form-label">Usage Per Customer</label>
        <div class="col-sm-8 col-lg-8">
            <div class="input-group">
                <input type="number"  min="1" class="form-control fill" required name="usage_per_customer" value="{{$coupon->usage_per_customer}}" placeholder="">
            </div>
        </div>
    </div>
    <div class="row">
        <label class="col-sm-4 col-lg-4 col-form-label">Min Cart Products</label>
        <div class="col-sm-8 col-lg-8">
            <div class="input-group">
                <input type="number"  min="1" class="form-control fill" required name="min_product" value="{{$coupon->min_product}}" placeholder="">
            </div>
        </div>
    </div>
    <div class="row">
        <label class="col-sm-4 col-lg-4 col-form-label">Min Cart Items</label>
        <div class="col-sm-8 col-lg-8">
            <div class="input-group">
                <input type="number"  min="1" class="form-control fill" required name="min_item" value="{{$coupon->min_item}}" placeholder="">
            </div>
        </div>
    </div>
    <div class="row">
        <label class="col-sm-4 col-lg-4 col-form-label">Min Cart Amount</label>
        <div class="col-sm-8 col-lg-8">
            <div class="input-group">
                <input type="number" step=".01" class="form-control fill" required name="min_amount" value="{{$coupon->min_amount}}" placeholder="">
            </div>
        </div>
    </div>
    <div class="row">
        <label class="col-sm-4 col-lg-4 col-form-label">Start Date</label>
        <div class="col-sm-4 col-lg-4">
            <div class="input-group">
                <input type="date" class="form-control fill" required name="start_date" value="{{Carbon\Carbon::parse($coupon->start_date)->format('Y-m-d') }}" placeholder="">
            </div>
        </div>
        <div class="col-sm-4 col-lg-4">
            <div class="input-group">
                <input type="time" class="form-control fill" required name="start_date_time" value="{{Carbon\Carbon::parse($coupon->start_date)->format('H:i') }}" placeholder="">
            </div>
        </div>
    </div>

    <div class="row">
        <label class="col-sm-4 col-lg-4 col-form-label">End Date</label>
        <div class="col-sm-4 col-lg-4">
            <div class="input-group">
                <input type="date" class="form-control fill" required name="end_date" value="{{Carbon\Carbon::parse($coupon->end_date)->format('Y-m-d') }}" placeholder="">
            </div>
        </div>
        <div class="col-sm-4 col-lg-4">
            <div class="input-group">
                <input type="time" class="form-control fill" required name="end_date_time" value="{{Carbon\Carbon::parse($coupon->end_date)->format('H:i') }}" placeholder="">
            </div>
        </div>
    </div>

    <div class="row">
      <label class="col-sm-4 col-lg-4 col-form-label">Status</label>
      <div class="col-sm-8 col-lg-8">
          <div class="input-group">
            <select name="status" id="" class="form-control fill show-tick">
              @if($coupon->status == 1)
                <option value="1" selected >Enabled</option>
                <option value="0"  >Disable</option>
              @elseif($coupon->status == 0)
                <option value="1"  >Enable</option>
                <option value="0" selected >Disabled</option>
              @endif
            </select>
          </div>
      </div>
  </div>
      
      <button type="submit" class="btn btn-primary m-t-15 waves-effect"><i class="fa fa-save"></i>Save</button>


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