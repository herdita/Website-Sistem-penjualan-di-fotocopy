<?php
    require_once "../_config/config.php";
    require_once "../models/database.php";
    $con = mysqli_connect($server, $user, $pass, $db_name);

    if(isset($_SESSION['user'])){
        echo "<script>window.location='".base_url('index.php')."';</script>";
    }else{
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Login Fotocopy prima</title>

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
    <!-- Custom styles for this template -->
    <link href="<?=base_url('_assets/css/simple-sidebar.css')?>" rel="stylesheet")>
    <link href="<?=base_url('_assets/css/main.css')?>" rel="stylesheet">
    <link href="<?=base_url('_assets/css/login.css')?>" rel="stylesheet">
    <!-- sweetalert -->
    <script src="<?=base_url('_assets/libs/sweetalert.min.js')?>"></script>
    <!-- message function alert -->
    <script src="<?=base_url('models/message.js')?>"></script>
    <style>.card{ border: none;}</style>
</head>

<body>
    <div id="wrapper">
        <div id="MenuLogin" class="d-flex align-items-center justify-content-center flex-column">
            <!-- code-login-database -->
            <?php
                if(isset($_POST['login'])){
                    $user = trim(mysqli_real_escape_string($con, $_POST['user']));
                    $pass = md5(trim(mysqli_real_escape_string($con, $_POST['pass'])));
                    $result = $conn->query("select * from pegawai where username='$user' and pass='$pass'");
                    $num_rows = $result->rowCount();
                    if($num_rows > 0){
                        $_SESSION['user'] = $user; ?>
                        <script> 
                            //message success sweet alert
                            mess_success("Anda Berhasil Login","../admin/index.php");  
                        </script>"; <?php
                    }else{ ?>
                        <script>
                            //message error sweet alert
                            mess_warning("Login Anda Gagal! Coba ulangi lagi","");
                        </script>      
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong>LOGIN GAGAL ! &nbsp &nbsp</strong> Username atau Password salah
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button> 
                        </div> 
                    <?php
                    }
                }
            ?>
            <!-- / -->
            <div class="container d-flex justify-content-center ">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-center">
                            <p>MENU LOGIN</p>
                        </div>
                    </div>
                    <div class="card-block">
                        <form action="" method="post">
                            <div class="d-flex flex-column align-items-center">
                                <div class="position-input">
                                    <div class="input-group mb-3 pad-t-6">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1"><img src="../_assets/images/icon_login/icons8-user-24.png" alt=""></span>
                                        </div>
                                        <input type="text" class="form-control" name="user" id="user" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1" required autofocus>
                                    </div>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1"><img class="pass" src="../_assets/images/icon_login/icons8-lock-26.png" alt=""></span>
                                        </div>
                                        <input type="password" class="form-control" name="pass" id="pass" placeholder="Password" aria-label="Username" aria-describedby="basic-addon1" required>
                                    </div>
                                    <div class="pad-b-6">
                                        <input type="submit" class="btn btn-info" value="Masuk" name="login">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
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
</body>

</html>
<?php } ?>