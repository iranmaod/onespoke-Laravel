@include('app.work.layouts.includes.header')
      <!-- #Top Bar -->
      {{-- @include('sweetalert::alert') --}}
      <!-- Widgets -->
      @yield('content')
      @yield('mainjs_script')
@include('app.work.layouts.includes.footer')