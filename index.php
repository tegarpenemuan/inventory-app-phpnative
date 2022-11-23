<?php
ob_start();
require_once 'config/koneksi.php';
require_once 'models/database.php';

$connection = new Database($hostname, $user, $pass, $database);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Inventory APP</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <link href="assets/datatables/datatables.min.css" rel="stylesheet">

    <!-- Add custom CSS here -->
    <link href="assets/css/sb-admin.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">

    <!-- Add Favicon -->
    <link rel="shortcut icon" href="assets/favicon/favicon.png" />
</head>

<body>

    <div id="wrapper">

        <!-- Sidebar -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="">Inventory APP</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <!-- li class="active" -->
                    <li><a href="?page=dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                    <!-- li open -->
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-shopping-cart"></i>
                            Barang <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <!-- a class="active" -->
                            <li><a href="?page=barang">Data Barang</a></li>
                            <li><a href="?page=barang_grafik">Grafik</a></li>
                        </ul>
                    </li>
                </ul>

                <ul class="nav navbar-nav navbar-right navbar-user">
                    <li class="dropdown user-dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> Tegar
                            Penemuan
                            <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="#"><i class="fa fa-user"></i> Profile</a></li>
                            <li><a href="#"><i class="fa fa-envelope"></i> Inbox <span class="badge">7</span></a></li>
                            <li><a href="#"><i class="fa fa-gear"></i> Settings</a></li>
                            <li class="divider"></li>
                            <li><a href="#"><i class="fa fa-power-off"></i> Log Out</a></li>
                        </ul>
                    </li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">

            <!-- isian website -->
            <?php
if (@$_GET['page'] == 'dashboard' || @$_GET['page'] == '') {
    include "views/dashboard.php";
} else if (@$_GET['page'] == 'barang') {
    include "views/barang.php";
} else if (@$_GET['page'] == 'barang_grafik') {
    include "views/barang_grafik.php";
}
?>

        </div><!-- /#page-wrapper -->

    </div><!-- /#wrapper -->

    <!-- JavaScript -->
    <script src="assets/js/jquery-1.10.2.js"></script>
    <script src="assets/js/bootstrap.js"></script>
    <script src="assets/datatables/datatables.min.js"></script>
    <script>
    $(document).ready(function() {
        $('#datatables').DataTable();
    });
    </script>
</body>

</html>