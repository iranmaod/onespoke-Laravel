@extends('work.layouts.app')
@section('content')

<div class="card">
  <div class="card-header">
    <h5>Edit {{$supplier->name}}</h5>
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
    <form action="{{route('work.supplier.update',['id'=>$supplier->id])}}" method="post" enctype="multipart/form-data">
      {{csrf_field()}}
      <div class="row">
        <label class="col-sm-4 col-lg-2 col-form-label">Select Country</label>
        <div class="col-sm-8 col-lg-10">
          <div class="input-group">
            <select id="country_id" name="country_id" class="form-control fill show-tick">
              @foreach($countries as $country)
              <option value="{{$country->id}}" @if($supplier->country_id == $country->id)
                selected
                @endif
                >{{$country->name}}</option>
              @endforeach
            </select>
          </div>
        </div>
      </div>

      <div class="row">
        <label class="col-sm-4 col-lg-2 col-form-label">Name</label>
        <div class="col-sm-8 col-lg-10">
          <div class="input-group">
            <input id="name" class="form-control fill" readonly name="name" value="{{$supplier->name}}" required
              type="text">
          </div>
        </div>
      </div>

      <div class="row">
        <label class="col-sm-4 col-lg-2 col-form-label">Contact Name</label>
        <div class="col-sm-8 col-lg-10">
          <div class="input-group">
            <input id="contact_name" class="form-control fill" name="contact_name" value="{{$supplier->contact_name}}"
              required type="text">
          </div>
        </div>
      </div>
      <div class="row">
        <label class="col-sm-4 col-lg-2 col-form-label">Website</label>
        <div class="col-sm-8 col-lg-10">
          <div class="input-group">
            <input id="url" class="form-control fill" name="url" value="{{$supplier->url}}" type="text">
          </div>
        </div>
      </div>
      <div class="row">
        <label class="col-sm-4 col-lg-2 col-form-label">Email Address</label>
        <div class="col-sm-8 col-lg-10">
          <div class="input-group">
            <input id="email_address" readonly class="form-control fill" required name="email"
              value="{{$supplier->email}}" type="email">
          </div>
        </div>
      </div>
      <div class="row">
        <label class="col-sm-4 col-lg-2 col-form-label">Phone Number</label>
        <div class="col-sm-8 col-lg-10">
          <div class="input-group">
            <input id="phone_number" class="form-control fill" name="phone_number" value="{{$supplier->phone_number}}"
              type="text">
          </div>
        </div>
      </div>
      <div class="row">
        <label class="col-sm-4 col-lg-2 col-form-label">Amount Sold</label>
        <div class="col-sm-8 col-lg-10">
          <div class="input-group">
            <input id="amount_sold" class="form-control fill" name="amount_sold" value="{{$supplier->amount_sold}}"
              required type="text">
          </div>
        </div>
      </div>
      <div class="row">
        <label class="col-sm-4 col-lg-2 col-form-label">Price Update Element</label>
        <div class="col-sm-8 col-lg-10">
          <div class="input-group">
            <input id="price_update_element" class="form-control fill" name="price_update_element"
              value="{{$supplier->price_update_element}}" type="text">
          </div>
        </div>
      </div>
      <div class="row">
        <label class="col-sm-4 col-lg-2 col-form-label">Stock Update Element</label>
        <div class="col-sm-8 col-lg-10">
          <div class="input-group">
            <input id="stock_update_element" class="form-control fill" name="stock_update_element"
              value="{{$supplier->stock_update_element}}" type="text">
          </div>
        </div>
      </div>
      <div class="row">
        <label class="col-sm-4 col-lg-2 col-form-label">Description Update Element</label>
        <div class="col-sm-8 col-lg-10">
          <div class="input-group">
            <input id="description_update_element" class="form-control fill" name="description_update_element"
              value="{{$supplier->description_update_element}}" type="text">
          </div>
        </div>
      </div>
      <div class="row">
        <label class="col-sm-4 col-lg-2 col-form-label">Address</label>
        <div class="col-sm-8 col-lg-10">
                <textarea rows="5" required="" id="address" class="form-control no-resize editor" name="address" placeholder="Description ..." >                    
                  {!!$supplier->address!!}
                </textarea>
        </div>
    </div>
    <br>
      <div class="row">
        <label class="col-sm-4 col-lg-2 col-form-label">Active</label>
        <div class="col-sm-8 col-lg-10">
          <div class="input-group">
            <input id="active" class="form-control fill" name="active" value="{{$supplier->active}}" min="0" max="1"
              required type="number">
          </div>
        </div>
      </div>

      <br>
      <button type="submit" class="btn btn-primary m-t-15 waves-effect"><i
          class="material-icons">save</i>Update</button>
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