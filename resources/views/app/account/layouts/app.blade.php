@include('app.account.layouts.includes.header')
      <!-- #Top Bar -->
      {{-- @include('sweetalert::alert') --}}
      <!-- Widgets -->
      @yield('content')
      @yield('mainjs_script')
@include('app.account.layouts.includes.footer')