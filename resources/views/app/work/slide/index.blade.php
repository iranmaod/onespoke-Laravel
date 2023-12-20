@extends('work.layouts.app')

@section('content')

<div class="card">
    <div class="card-header">
     </div>
     <div class="icon-and-text-button-demo">
            <a href="{{ route('work.slide.create') }}">
                <button type="button" class="btn btn-primary waves-effect">
                        <i class="fa fa-plus-circle"></i>
                    <span>{{ __('messages.Add Slide') }}</span>
                </button>
            </a>
        </div> 
      <div class="card-block">
          <div class="row">
              <div class="col-sm-12 col-lg-12">
                  <center><h1>{{ __('messages.Active Slide') }}</h1></center>
                  @if(count($slides)>0)
                  <div class="active">
                          <img class="slide-image img-responsive" src="{{asset($last_slide->image)}}" alt="IMG" >
                  </div>
                  @endif
              </div>
          </div>
          <hr />
          <h1>{{ __('messages.Available Slides') }}</h1>
          <div class="row">
              <div class="col-sm-12 col-lg-12">
                  <div class="row">
                      @if(!empty($slides))
                      @foreach($slides as $slide)
                        <div class="col-lg-4 text-center">
                          <div class="panel panel-default">
                            <div class="panel-body">
                              <img class="slide-image" src="{{asset($slide->image)}}" alt="IMG" width="220" height="140">
                            </div><br>
                            <a href="{{$slide->url}}"   class="btn btn-secondary">{{ __('messages.Link') }}!</a> &nbsp
                            <a class="btn btn-danger" href="{{route('work.slide.delete',$slide->id)}}" onclick="return confirm('Do You Want to Delete?');">{{ __('messages.Delete') }}</a>
                            <br/>
                          <br>
                        </div>
                      </div>
                      @endforeach
                      @endif
                </div>
              </div>
          </div>



      </div>


<style>
  .img-responsive {
   width: 100%;
   height: auto;
}

input.hidden {
position: absolute;
left: -9999px;
}

#profile-image1 {
cursor: pointer;

width: 100px;
height: 100px;
border:2px solid #03b1ce ;}
.tital{ font-size:16px; font-weight:500;}
.bot-border{ border-bottom:1px #f8f8f8 solid;  margin:5px 0  5px 0}
</style>



                      <!-- body end -->
                    </div>
                </div>

@endsection
@section('mainjs_script')
<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
@endsection
