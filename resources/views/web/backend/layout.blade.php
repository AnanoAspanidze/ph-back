<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title', 'ადმინისტრატორის პანელი')</title>
  @include('web.backend.layout.head')
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    @include('web.backend.partials.preload')
    <div class="wrapper">
      @include('web.backend.layout.header')

      @include('web.backend.layout.sidebar.sidebar')
      
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <div class="content-header">
              @yield('content_header')
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content col-12 col-md-10 m-auto">
              @yield('content')
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        @include('web.backend.layout.footer')

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark"> -->
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    @include('web.backend.layout.header.js')
    @include('web.backend.partials.message')
    @stack('script')
    @yield('scripts')
</body>
</html>