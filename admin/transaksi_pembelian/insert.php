<?php
   

    // $con = mysqli_connect("localhost", "root", "", "test_db");
    require_once "../../_config/config.php";
    require_once "../../models/database.php";

 

        $number             = count($_POST["nama_barang"]);
        
        $id_pembelian       = trim(mysqli_real_escape_string($con, $_POST["id_pembelian"]));
        $tgl_pembelian      = mysqli_real_escape_string($con, $_POST["tgl_pembelian"]);
        $tharga_pembelian   = trim(mysqli_real_escape_string($con, $_POST["total_harga"]));
        
        // id_pegawai
        $username_account   = $_SESSION['user'];
        $data_user          = Database::getInstance($server, $user, $pass, $db_name); $data_user->setTable('pegawai');
        $username           = $data_user->select()->where('username','=',$username_account)->all();
        foreach($username as $us){
            $id_pegawai = $us->id_pegawai;   
        };

        $keterangan         = trim(mysqli_real_escape_string($con, $_POST["keterangan"]));
        $time_create        = date("Y-m-d H:i:s");
        $time_update        = date("Y-m-d H:i:s");
        
       
        // insert into table pembelian 
        $statement = $conn->prepare("INSERT INTO pembelian(id_pembelian, tgl_pembelian, tharga_pembelian, id_pegawai, keterangan, time_create, time_update) VALUES(?, ?, ?, ?, ?, ?, ?)");
        $statement->execute(array( "$id_pembelian","$tgl_pembelian","$tharga_pembelian","$id_pegawai","$keterangan","$time_create","$time_update"));

        for($i=0; $i<$number; $i++)  
        {  
            $id_detail_pembelian = trim(mysqli_real_escape_string($con, $_POST["id_pembelian"]));

            // id_barang
            $nama_barang    = mysqli_real_escape_string($con, $_POST["nama_barang"][$i]);
            $data_barang    = Database::getInstance($server, $user, $pass, $db_name); $data_barang->setTable('barang');
            $barang         = $data_barang->select()->where('nama_barang','=',$nama_barang)->all();
            foreach($barang as $brg){
                $id_barang = $brg->id_barang;
                $stok      = $brg->stok;
            };

            $qty_pembelian = trim(mysqli_real_escape_string($con, $_POST["qualty"][$i]));

            $data_updateBarang = [
                'stok' => $stok + $qty_pembelian,
                'id_barang' => $id_barang,
            ];

            $stmt= $conn->prepare("UPDATE barang SET stok=:stok WHERE id_barang=:id_barang");
            $stmt->execute($data_updateBarang);

            
            $total_harga_pembelian = trim(mysqli_real_escape_string($con, $_POST["sub_total"][$i])); 

            $time_create= date("Y-m-d H:i:s");
            $time_update= date("Y-m-d H:i:s");

            // insert into table detail pembelian 
            $statement = $conn->prepare("INSERT INTO detail_pembelian(id_pembelian, id_barang, qty_pembelian, total_harga_pembelian, time_create, time_update) VALUES(?, ?, ?, ?, ?, ?)");
            $statement->execute(array( "$id_detail_pembelian","$id_barang","$qty_pembelian","$total_harga_pembelian","$time_create","$time_update"));             
        }  
        // echo "Data Inserted";  
        

?> 