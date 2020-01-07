<?php
    
    date_default_timezone_set('Asia/jakarta');
    session_start();

    // base url for link
    function base_url($url = null){
        $base_url = "http://localhost/fotocopy_oop";
        if($url != null){
            return $base_url."/".$url;
        }else{
            return $base_url;
        }
    }

    $server     = 'localhost'; 
    $user       = 'root';
    $pass       = '';
    $db_name    = 'fotocopy';

    try{
        $conn = new PDO("mysql:host=$server;dbname=$db_name",$user,$pass);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }catch(PDOException $e){
        echo 'error! :'.$e->getMessage();
    }

    $con = mysqli_connect($server, $user, $pass, $db_name);
?>