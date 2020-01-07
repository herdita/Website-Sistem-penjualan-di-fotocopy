<?php 
     require_once "../_config/config.php";
     require_once "../models/database.php";
     require_once "../models/uniqid.php";
     
     if(!isset($_SESSION['user'])){
        echo "<script>window.location='".base_url('auth/login.php')."';</script>";
     }

     $database = Database::getInstance($server, $user, $pass, $db_name);
     error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
?>

<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Insani</title>
    <!-- Bootstrap core CSS-->
    <link href="<?=base_url('vendor/bootstrap/css/bootstrap.min.css')?>" rel="stylesheet">
    <!-- Custom fonts for this template-->
    <link href="<?=base_url('vendor/font-awesome/css/font-awesome.min.css')?>" rel="stylesheet" type="text/css">
    <!-- Custom styles for this template-->
    <link href="<?=base_url('_assets/css/sb-admin.css')?>" rel="stylesheet">
    <link href="<?=base_url('_assets/css/padding.css')?>" rel="stylesheet">
    <!-- main custome style -->
    <link href="<?=base_url('_assets/css/main.css')?>" rel="stylesheet">
    <!-- j-query -->
    <script src="<?=base_url('vendor/jquery/jquery.min.js')?>"></script>
    <!-- sweetalert -->
    <script src="<?=base_url('_assets/libs/sweetalert.min.js')?>"></script>
    <!-- dataTables -->
    <link rel="stylesheet" href="<?=base_url('_assets/libs/DataTables/bootsrap.css')?>">
    <link rel="stylesheet" href="<?=base_url('_assets/libs/DataTables/dataTables.bootstrap4.min.css')?>">
    <script src="<?=base_url('_assets/libs/DataTables/jquery.dataTables.min.js')?>"></script>
    <script src="<?=base_url('_assets/libs/DataTables/dataTables.bootstrap4.min.js')?>"></script>
    <!-- message function alert -->
    <script src="<?=base_url('models/message.js')?>"></script>
    <!-- highcharts -->
    <script src="<?=base_url('_assets/libs/highcharts/highcharts.js')?>"></script>

</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
        <a class="navbar-brand" href="?page=dashboard">Insani Alat Tulis</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <!-- menu-left-sidebar -->
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
                <!-- dashboard -->
                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
                    <a class="nav-link" href="?page=dashboard">
                        <i class="fa fa-fw fa-dashboard"></i>
                        <span class="nav-link-text">Dashboard</span>
                    </a>
                </li>

                <!-- Transaksi Pembelian -->
                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Transaksi Pembelian">
                    <a class="nav-link" href="?page=transaksi_pembelian">
                        <i class="fa fa-fw fa-shopping-cart"></i>
                        <span class="nav-link-text">Transaksi Pembelian</span>
                    </a>
                </li>

                <!-- transaksi penjualan -->
                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Transaksi Penjualan">
                    <a class="nav-link" href="?page=transaksi_penjualan">
                        <i class="fa fa-fw fa-money"></i>
                        <span class="nav-link-text">Transaksi Penjualan</span>
                    </a>
                </li>

                <!-- tables -->
                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Tables">
                    <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseExamplePages" data-parent="#exampleAccordion">
                        <i class="fa fa-fw fa-table"></i>
                        <span class="nav-link-text">Tabel</span>
                    </a>
                    <!-- mutltiLevel -->
                    <ul class="sidenav-second-level collapse" id="collapseExamplePages">
                        <li>
                            <!-- third level -->
                            <a class="nav-link-collapse collapsed" data-toggle="collapse" href="#collapseMulti1">Karyawan</a>
                            <ul class="sidenav-third-level collapse" id="collapseMulti1">
                                <li>
                                    <a href="?page=pegawai">Pegawai</a>
                                </li>
                                <li>
                                    <a href="?page=jabatan">Jabatan</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a class="nav-link-collapse collapsed" data-toggle="collapse" href="#collapseMulti2">Produk</a>
                            <ul class="sidenav-third-level collapse" id="collapseMulti2">
                                <li>
                                    <a href="?page=barang">Barang</a>
                                </li>
                                <li>
                                    <a href="?page=kategori">Kategori</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a class="nav-link-collapse collapsed" data-toggle="collapse" href="#collapseMulti3">Transaksi Pembelian</a>
                            <ul class="sidenav-third-level collapse" id="collapseMulti3">
                                <li>
                                    <a href="?page=pembelian">Pembelian</a>
                                </li>
                                <li>
                                    <a href="?page=detail_pembelian">Detail Pembelian</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a class="nav-link-collapse collapsed" data-toggle="collapse" href="#collapseMulti4">Transaksi Penjualan</a>
                            <ul class="sidenav-third-level collapse" id="collapseMulti4">
                                <li>
                                    <a href="?page=penjualan">Penjualan</a>
                                </li>
                                <li>
                                    <a href="?page=detail_penjualan">Detail Penjualan</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
            </ul>

            <!-- toggle up -->
            <ul class="navbar-nav sidenav-toggler" style="padding-bottom:7px;">
                <li class="nav-item">
                    <a class="nav-link text-center" id="sidenavToggler">
                        <i class="fa fa-fw fa-angle-left"></i>
                    </a>
                </li>
            </ul>

            <!-- code-name-is-account -->
            <?php
                // $username_account = $_SESSION['user'];
                // $query_account = "SELECT * FROM pegawai WHERE username='$username_account' ";
                // $sql_account = mysqli_query($con,$query_account) or die(mysqli_error($con));
                // $row_user = mysqli_fetch_array($sql_account);                 
            ?>

            <ul class="navbar-nav ml-auto">
                <!-- user -->
                <li class="nav-item ">
                    <a class="nav-link mr-lg-2">
                        <i class="fa fa-user-circle" ></i>
                        <?php
                            $username_account = $_SESSION['user'];
                            $user = Database::getInstance($server, $user, $pass, $db_name); $user->setTable('pegawai');
                            $username = $user->select()->where('username','=',$username_account)->all();
                            foreach($username as $us){
                                echo "$us->nama_p";
                            }
                        ?>
                    </a>
                </li>
                <!-- logout -->
                <li class="nav-item">
                    <a class="nav-link" data-toggle="modal" data-target="#logoutModal">
                        <i class="fa fa-fw fa-sign-out"></i>Logout</a>
                </li>
            </ul>
        </div>
    </nav>


    <div class="content-wrapper">
    <!-- content-wrapper -->
        
        <?php
            if(@$_GET['page'] == 'dashboard' || @$_GET['page'] == ''){
                include "dashboard.php";

            }else if(@$_GET['page'] == 'pegawai'){
                include "tabel/pegawai.php";

            }else if(@$_GET['page'] == 'jabatan'){
                include "tabel/jabatan.php";

            }else if(@$_GET['page'] == 'barang'){
                include "tabel/barang.php";

            }else if(@$_GET['page'] == 'kategori'){
                include "tabel/kategori.php";

            }else if(@$_GET['page'] == 'penjualan'){
                include "tabel/penjualan.php";

            }else if(@$_GET['page'] == 'detail_penjualan'){
                include "tabel/detail_penjualan.php";

            }else if(@$_GET['page'] == 'transaksi_penjualan'){
                include "transaksi_penjualan/transaksi_penjualan.php";

            }else if(@$_GET['page'] == 'pembelian'){
                include "tabel/pembelian.php";
            
            }else if(@$_GET['page'] == 'detail_pembelian'){
                include "tabel/detail_pembelian.php";

            }else if(@$_GET['page'] == 'transaksi_pembelian'){
                include "transaksi_pembelian/transaksi_pembelian.php";
            }
        ?>

        <!-- /.content-wrapper-->
        <footer class="sticky-footer">
            <div class="container">
                <div class="text-center">
                    <small> @Fotocopy Prima</small>
                </div>
            </div>
        </footer>

        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fa fa-angle-up"></i>
        </a>

        <!-- Logout Modal-->
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <a class="btn btn-danger" href="<?=base_url('auth/logout.php')?>">Logout</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bootstrap core JavaScript-->
        <script src="<?=base_url('vendor/bootstrap/js/bootstrap.bundle.min.js')?>"></script>
        <!-- Core plugin JavaScript-->
        <script src="<?=base_url('vendor/jquery-easing/jquery.easing.min.js')?>"></script>
        <!-- Custom scripts for all pages-->
        <script src="<?=base_url('_assets/js/sb-admin.min.js')?>"></script>
        <!-- sweetalert function -->
        
         
    </div>
</body>

</html>