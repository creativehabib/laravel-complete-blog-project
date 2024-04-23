<!doctype html>
<html lang="en">
  <head>
    @include('layouts.partials.head')
    @stack('style')
  </head>
  <body>
    <div class="container">
        <div class="row mt-3">
            @yield('content')
        </div>
    </div>
    @include('layouts.partials.footer')
    @stack('script')
  </body>
</html>