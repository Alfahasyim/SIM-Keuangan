<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMANGAN | LOGIN</title>
    <link href="inspinia/css/bootstrap.min.css" rel="stylesheet">
    <link href="inspinia/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="inspinia/css/animate.css" rel="stylesheet">
    <link href="inspinia/css/style.css" rel="stylesheet">

</head>
<body class="gray-bg">
    <div class="middle-box text-center loginscreen animated fadeInDown">
      @if($errors->any())
      <div class="alert alert-danger alert-dismissable">
          <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
          <center> {{$errors->first()}} </center>
      </div>
      @endif
        <div>
            <div>
                <img src="inspinia/images/Logo-keuangan.png" style="width:300px; height:150px; background-image:none" alt="">
            </div>
            <h3>SELAMAT DATANG DI SIMANGAN</h3>
            <p>Aplikasi Pengelola Keuangan yang dapat memudahkan pekerjaan Anda
                <!--Continually expanded and constantly improved Inspinia Admin Them (IN+)-->
            </p>
            <p>Silahkan Login.</p>
            <form class="m-t" role="form" action="{{route('prosesLogin')}}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group">
                    <input type="text" class="form-control" name="username" placeholder="Username" required="">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" name="password" placeholder="Password" required="">
                </div>
                <button type="submit" class="btn btn-primary block full-width m-b">Login</button>
            </form>
            <p class="m-t"> <small>ALFA &copy; 2021</small> </p>
        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="inspinia/js/jquery-2.1.1.js"></script>
    <script src="inspinia/js/bootstrap.min.js"></script>
    <script src="inspinia/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="inspinia/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="inspinia/js/inspinia.js"></script>
    <script src="inspinia/js/plugins/pace/pace.min.js"></script>

</body>
</html>
