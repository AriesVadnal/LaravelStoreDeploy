<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>@yield('title')</title>

    @stack('prepend_style')
    @include('includes.style')
    @stack('addon_style')
  </head>

  <body>
    <!-- Navigation -->
    @include('includes.navbar')

    <!-- Page Content -->
    @yield('content')

   @include('includes.footer')

    <!-- Bootstrap core JavaScript -->
    @stack('prepend_script')
    @include('includes.script')
    @stack('addon_script')
  </body>
</html>
