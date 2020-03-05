<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Aplikasi Hadist</title>

  {{-- {!! Html::style('vendor/bootstrap/css/bootstrap.min.css') !!}
  {!! Html::style('css/simple-sidebar.css') !!} --}}
  <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendor/jquery-ui/jquery-ui.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/simple-sidebar.css') }}">
  @yield('styles')

</head>

<body>
  <div class="d-flex" id="wrapper">

    <!-- Sidebar -->
    @include('sidebars')
    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->
    <div id="page-content-wrapper">
      <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
        <button class="btn" id="menu-toggle">
            <span class="navbar-toggler-icon"></span>
        </button>
        <span class="text-right">
            <strong>{{ $titlePage }}</strong>
        </span>
      </nav>

      <div class="container-fluid">
        <br>
        @yield('content')
      </div>
    </div>
    <!-- /#page-content-wrapper -->

  </div>

  <!-- Bootstrap core JavaScript -->
  <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('vendor/jquery-ui/jquery-ui.min.js') }}"></script>
  <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  {{-- {!! Html::script('vendor/jquery/jquery.min.js') !!}
  {!! Html::script('vendor/bootstrap/js/bootstrap.bundle.min.js') !!} --}}

  <!-- Menu Toggle Script -->
  
  <script>
    /* $(window).on('load', function() {
        $("#wrapper").toggleClass("toggled");
    }); */
  </script>
  <script>
    $("#menu-toggle").click(function(e) {
      e.preventDefault();
      $("#wrapper").toggleClass("toggled");
    });
  </script>
    @yield('scripts')
</body>
</html>