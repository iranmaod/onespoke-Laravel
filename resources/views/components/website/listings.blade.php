<div class="card-section pt-14 pb-20">
    <div class="row">
        <div class="container mx-auto">
            <div class="grid col-1 justify-center pb-14">
                <div>
                    <h2 class="text-5xl font-extrabold dark text-center"><span class="orange">RECENTLY POSTED</span> BIKES</h2>
                </div>
            </div>

            <div id="featured" class="flex flex-wrap featured-bikes">
                <div class="container">
                    <div class="row">
                        @foreach(\App\Models\Products::all() as $item)
                        <div class="col-lg-4">
                            <div class="card" style="width: 18rem; margin:10px">
                                <img class="card-img-top" src="{{asset($item->image)}}" alt="Card image cap">
                                <div class="card-body">
                                  <h5 class="card-title">{{$item->name}}</h5>
                                  <p style="margin: 10px 0px" class="card-text">{{$item->description}}</p>
                                  <div class="custom_btn text-center">
                                    <form action="{{route('cart.add')}}" method="post">
                                      {{csrf_field()}}
                                      <input  name="qty" type="hidden" value="1" />
                                      <input type="hidden" name="product_id" value="{{$item->id}}" />
                                      @if($item->stock>0)
                                      <button class="btn btn-primary ">CART </button>&nbsp
                                      @endif
                                     <a href="{{route('products.detail', ['id'=>$item->id])}}"  class="btn btn-light">Detail</a>
                                    </form>
                                  </div>
                                </div>
                              </div>
                        </div>

                        @endforeach
                       
                    </div>
                </div>
                

            </div>

            <div class="grid-cols-1 uppercase pt-14">
                <div class="text-center text-xl">
                    <a href="{{ route('website.buy') }}" class="blue-btn rounded-xl text-white uppercase shadow-lg">
                        Search All Bikes
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
