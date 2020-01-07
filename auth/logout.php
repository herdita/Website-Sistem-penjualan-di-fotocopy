<?php
    require_once "../_config/config.php";

    session_unset($_SESSION['user']);
    echo "<script>window.location='".base_url('auth/index.html')."';</script>"; 
?>