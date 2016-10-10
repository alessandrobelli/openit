<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>{{ config('settings.companyName') }} | Dashboard</title>

    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="{{ asset('admin-assets/bootstrap/css/bootstrap.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('admin-assets/plugins/font-awesome/css/font-awesome.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('admin-assets/dist/css/AdminLTE.min.css') }}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <!-- <link rel="stylesheet" href="{-- asset('admin-assets/dist/css/skins/_all-skins.min.css') --}"> -->
    <link rel="stylesheet" href="{{ asset('admin-assets/dist/css/skins/skin-blue.min.css') }}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('admin-assets/plugins/datatables/jquery.dataTables.min.css') }}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('admin-assets/plugins/datatables/dataTables.bootstrap.css') }}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('admin-assets/plugins/select2/select2.min.css') }}">
    <!-- Custom Stylesheet -->
    <link rel="stylesheet" href="{{ asset('admin-assets/dist/css/style.css') }}">

    <style>
        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            color: #000000;
        }
    </style>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        @include('admin/layouts/header')

        @include('admin/layouts/sidebar')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            @yield('content')
        </div><!-- /.content-wrapper -->

        @include('admin/layouts/footer')
    </div>

    <!-- Set Base Url for Javascript -->
    <script type="application/javascript">
        var baseUrl = "";
    </script>
    <!-- jQuery 2.1.4 -->
    <script src="{{ asset('admin-assets/plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
      $.widget.bridge('uibutton', $.ui.button);
    </script>
    <!-- Bootstrap 3.3.5 -->
    <script src="{{ asset('admin-assets/bootstrap/js/bootstrap.min.js') }}"></script>
    <!-- DataTables -->
    <script src="{{ asset('admin-assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <!-- DataTables -->
    <script src="{{ asset('admin-assets/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
    <!-- Select2 -->
    <script src="{{ asset('admin-assets/plugins/select2/select2.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('admin-assets/dist/js/app.min.js') }}"></script>
    <!-- Custom Javascript -->
    <script src="{{ asset('admin-assets/dist/js/application.js') }}"></script>

    @yield('script')
</body>
</html>