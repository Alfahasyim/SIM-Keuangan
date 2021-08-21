<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>SIMANGAN | ADMIN</title>

    <link href="{{asset('inspinia/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('inspinia/font-awesome/css/font-awesome.css')}}" rel="stylesheet">
    <!-- Datatavle -->
    <link href="{{asset('inspinia/css/plugins/dataTables/datatables.min.css')}}" rel="stylesheet">
    <!-- Toastr style -->
    <link href="{{asset('inspinia/css/plugins/toastr/toastr.min.css')}}" rel="stylesheet">
    <!-- Data Picker -->
    <link href="{{asset('inspinia/css/plugins/datapicker/datepicker3.css')}}" rel="stylesheet">
    <!-- chosen -->
    <link href="{{asset('inspinia/css/plugins/chosen/bootstrap-chosen.css')}}" rel="stylesheet">

    <link href="{{asset('inspinia/css/animate.css')}}" rel="stylesheet">
    <link href="{{asset('inspinia/css/style.css')}}" rel="stylesheet">

</head>

<body>
    <div id="wrapper">
    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav metismenu" id="side-menu">
                <li class="nav-header">
                    <div class="dropdown profile-element">

                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="block m-t-xs font-bold">{{Auth::user()->nama_user}}</span>
                            <span class="text-muted text-xs block">Opsi <b class="caret"></b></span>
                        </a>
                        <ul class="dropdown-menu animated fadeInRight m-t-xs">
                            <li><a class="dropdown-item" href="profile.html">Profile</a></li>
                            <li><a class="dropdown-item" href="contacts.html">Contacts</a></li>
                            <li><a class="dropdown-item" href="mailbox.html">Mailbox</a></li>
                            <li class="dropdown-divider"></li>
                            <li><a href="{{route('logout')}}">Logout</a></li>
                        </ul>
                    </div>
                    <div class="logo-element">
                      SM
                    </div>
                </li>
                <li class="{{ set_active('admin.dashboard') }}">
                    <a href="{{route('admin.dashboard')}}"><i class="fa fa-th-large"></i> <span class="nav-label">Dashboards</span></a>
                </li>
                <li class="{{ set_active(['admin.Mbarang','admin.Mpelanggan'])}}">
                    <a href=""><i class="fa fa-database"></i> <span class="nav-label">Master Data</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level"> 
                        <li class="{{ set_active('admin.Mbarang') }}"><a href="{{route('admin.Mbarang')}}">Barang</a></li> 
                        <li class="{{ set_active('admin.Mpelanggan') }}"><a href="{{route('admin.Mpelanggan')}}">Pelanggan</a></li>
                    </ul>
                </li> 
                <li class="{{ set_active(['admin.OrderMasuk','admin.ListOrderMasuk'])}}">
                    <a href=""><i class="fa fa-tags"></i> <span class="nav-label">Orderan</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li class="{{ set_active('admin.OrderMasuk') }}"><a href="{{route('admin.OrderMasuk')}}">Order Masuk</a></li>
                        <li class="{{ set_active('admin.ListOrderMasuk') }}"><a href="{{route('admin.ListOrderMasuk')}}">List Order Masuk</a></li>
                    </ul>
                </li>  
                <li class="{{ set_active(['admin.Sakun'])}}">
                    <a href=""><i class="fa fa-cogs"></i> <span class="nav-label">Settings</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li class="{{ set_active('admin.Sakun') }}"><a href="{{route('admin.Sakun')}}">Akun</a></li> 
                    </ul>
                </li>  
            </ul>

        </div>
    </nav>

        <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">
        <nav class="navbar navbar-static-top white-bg" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
        </div> 

        </nav>
        </div>
        <div class="wrapper wrapper-content">
          <!-- Mainly scripts -->
          <script src="{{asset('inspinia/js/jquery-3.1.1.min.js')}}"></script>
          <script src="{{asset('inspinia/js/popper.min.js')}}"></script>
          <script src="{{asset('inspinia/js/bootstrap.js')}}"></script>
          <script src="{{asset('inspinia/js/plugins/metisMenu/jquery.metisMenu.js')}}"></script>
          <script src="{{asset('inspinia/js/plugins/slimscroll/jquery.slimscroll.min.js')}}"></script>

          <!-- DataTable -->
          <script src="{{asset('inspinia/js/plugins/dataTables/datatables.min.js')}}"></script>
          <script src="{{asset('inspinia/js/plugins/dataTables/dataTables.bootstrap4.min.js')}}"></script>

          <!-- Flot -->
          <script src="{{asset('inspinia/js/plugins/flot/jquery.flot.js')}}"></script>
          <script src="{{asset('inspinia/js/plugins/flot/jquery.flot.tooltip.min.js')}}"></script>
          <script src="{{asset('inspinia/js/plugins/flot/jquery.flot.spline.js')}}"></script>
          <script src="{{asset('inspinia/js/plugins/flot/jquery.flot.resize.js')}}"></script>
          <script src="{{asset('inspinia/js/plugins/flot/jquery.flot.pie.js')}}"></script>
          <script src="{{asset('inspinia/js/plugins/flot/jquery.flot.symbol.js')}}"></script>
          <script src="{{asset('inspinia/js/plugins/flot/jquery.flot.time.js')}}"></script>

          <!-- Peity -->
          <script src="{{asset('inspinia/js/plugins/peity/jquery.peity.min.js')}}"></script>
          <script src="{{asset('inspinia/js/demo/peity-demo.js')}}"></script>

          <!-- Custom and plugin javascript -->
          <script src="{{asset('inspinia/js/inspinia.js')}}"></script>
          <script src="{{asset('inspinia/js/plugins/pace/pace.min.js')}}"></script>

          <!-- Toastr script -->
          <script src="{{asset('inspinia/js/plugins/toastr/toastr.min.js')}}"></script>

          <!-- Data picker -->
          <script src="{{asset('inspinia/js/plugins/datapicker/bootstrap-datepicker.js')}}"></script>

          <!-- Chosen -->
          <script src="{{asset('inspinia/js/plugins/chosen/chosen.jquery.js')}}"></script>

          <!-- jQuery UI -->
          <script src="{{asset('inspinia/js/plugins/jquery-ui/jquery-ui.min.js')}}"></script>

          <!-- Jvectormap -->
          <script src="{{asset('inspinia/js/plugins/jvectormap/jquery-jvectormap-2.0.2.min.js')}}"></script>
          <script src="{{asset('inspinia/js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>

          <!-- EayPIE -->
          <script src="{{asset('inspinia/js/plugins/easypiechart/jquery.easypiechart.js')}}"></script>

          <!-- Sparkline -->
          <script src="{{asset('inspinia/js/plugins/sparkline/jquery.sparkline.min.js')}}"></script>

          <!-- Sparkline demo data  -->
          <script src="{{asset('inspinia/js/demo/sparkline-demo.js')}}"></script>
          @yield('content')
        </div>
        <div class="footer"> 
          <div>
            <strong>Copyright</strong> ALFA &copy; 2021
          </div>
        </div>

        </div>

    </div>

    <script>
        $(document).ready(function() {
            
        });
    </script>
</body>
</html>
