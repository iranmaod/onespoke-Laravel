<div class="col-md-8 col-2 col-sm-6 col-md-4 d-block d-lg-none">
    <div class="accordion-wrapper hide-sm-up">
        <a href="#" class="mobile-open"><i class="fa fa-bars"></i></a>

        <!--Mobile Menu start-->
        <ul id="mobilemenu" class="accordion">
           <!-- <li class="mob-logo"><a href="{{ url('/') }}"><img src="{{asset($settings->logo)}}" alt=""></a></li>-->
            <li><a class="closeme" href="#"><i class="fa fa-times"></i></a></li>
            <li class="mob-logo"><a href="{{ url('/') }}"><img src="{{asset($settings->logo)}}" alt=""></a></li>
            <li class="out-link"><a class="" href="{{ url('/') }}"><i class="fa fa-home" aria-hidden="true"></i>{{ __('messages.home') }}</a></li>
            <li>
                <div class="link">{{ __('messages.categories') }}<i class="fa fa-chevron-down"></i></div>
                <ul class="submenu font-sky">
                  @foreach($categories as $category)
                    <li><a href="{{route('category_page', ['slug'=>$category->slug])}}"> {{$category->name}}</a></li>
                  @endforeach
                </ul>
            </li>
            <li><a href="{{ url('/products') }}" class="out-link"><i class="fa fa-leaf" aria-hidden="true"></i>{{ __('messages.products') }}</a></li>
            <li><a href="{{ url('/blogs') }}" class="out-link"><i class="fa fa-book" aria-hidden="true"></i>{{ __('messages.blogs') }} </a></li>
            <li><a href="{{ url('/contact') }}" class="out-link"><i class="fa fa-phone" aria-hidden="true"></i>{{ __('messages.contact') }}</a></li>

            <li><a href="{{ url('/locale/en') }}" class="out-link"><i class="fa fa-language" aria-hidden="true"></i>EN</a></li>
            <!--<li><a href="{{ url('/locale/fr') }}" class="out-link"><i class="fa fa-language" aria-hidden="true"></i>FR</a></li>-->
            @if(Auth::guard('admin')->check())
            <li>
                <div class="link">{{ __('messages.admin') }} <i class="fa fa-chevron-down"></i></div>
                <ul class="submenu font-sky">
                    <li><a href="{{ url('/work') }}">{{ __('messages.dashboard') }}</a></li>
                    <li><a href="{{ url('/work/logout') }}">{{ __('messages.logout') }}</a></li>
                </ul>
            </li>
              @endif
        </ul>
        <!--Mobile Menu end-->
    </div>
</div>
