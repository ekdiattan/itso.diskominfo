<!DOCTYPE html>
<html lang="en">
  
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Diskominfo Jabar | {{ $title }} </title>
    <link rel="icon" href="{{ asset('assets/images/jabar.png') }}">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="/AdminLTE-3.2.0/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="/AdminLTE-3.2.0/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="/AdminLTE-3.2.0/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="/AdminLTE-3.2.0/plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/AdminLTE-3.2.0/dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="/AdminLTE-3.2.0/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="/AdminLTE-3.2.0/plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="/AdminLTE-3.2.0/plugins/summernote/summernote-bs4.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="/AdminLTE-3.2.0/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="/AdminLTE-3.2.0/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="/AdminLTE-3.2.0/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Icon -->
    <!-- Multiselect -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
    <!-- calendar -->
    <link href='/fullcalendar-master/assets/css/fullcalendar.css' rel='stylesheet' />
    <link href='/fullcalendar-master/assets/css/fullcalendar.print.css' rel='stylesheet' media='print' />
    @stack('css')
</head>

<body>
<div class="wrapper">
  <!-- Preloade -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="{{ asset('assets/images/logo_diskom.svg') }}" alt="AdminLTELogo" height="100" width="300">
  </div>
  <!-- End Preloade -->

    <div class="container-fluid">
      <div class="container-scroller">
        <div class="container-fluid page-body-wrapper">
            <section>
              @yield('container')
            </section>
        </div>
      </div>
  </div>
</div>

<!-- jQuery -->
<script src="/AdminLTE-3.2.0/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="/AdminLTE-3.2.0/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="/AdminLTE-3.2.0/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="/AdminLTE-3.2.0/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="/AdminLTE-3.2.0/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="/AdminLTE-3.2.0/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="/AdminLTE-3.2.0/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="/AdminLTE-3.2.0/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="/AdminLTE-3.2.0/plugins/moment/moment.min.js"></script>
<script src="/AdminLTE-3.2.0/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="/AdminLTE-3.2.0/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="/AdminLTE-3.2.0/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="/AdminLTE-3.2.0/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="/AdminLTE-3.2.0/dist/js/adminlte.js"></script>
<!-- DataTables  & Plugins -->
<script src="/AdminLTE-3.2.0/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="/AdminLTE-3.2.0/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="/AdminLTE-3.2.0/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="/AdminLTE-3.2.0/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="/AdminLTE-3.2.0/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="/AdminLTE-3.2.0/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="/AdminLTE-3.2.0/plugins/jszip/jszip.min.js"></script>
<script src="/AdminLTE-3.2.0/plugins/pdfmake/pdfmake.min.js"></script>
<script src="/AdminLTE-3.2.0/plugins/pdfmake/vfs_fonts.js"></script>
<script src="/AdminLTE-3.2.0/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="/AdminLTE-3.2.0/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="/AdminLTE-3.2.0/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- multiselect -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/i18n/defaults-*.min.js"></script> -->

<!-- calendar -->
<script src='/fullcalendar-master/assets/js/jquery-1.10.2.js' type="text/javascript"></script>
<script src='/fullcalendar-master/assets/js/jquery-ui.custom.min.js' type="text/javascript"></script>
<script src='/fullcalendar-master/assets/js/fullcalendar.js' type="text/javascript"></script>


@stack('scripts')
</body>
</html>
<style>
  .table thead tr th {
      text-align: center;
  }
  tbody tr td {
    text-align: center;
  }
</style>