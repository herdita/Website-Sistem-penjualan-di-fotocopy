<?php
   

    // $con = mysqli_connect("localhost", "root", "", "test_db");
    require_once "../../_config/config.php";
    require_once "../../models/database.php";

 
        $number             = count($_POST["nama_barang"]);

        $id_penjualan       = trim(mysqli_real_escape_string($con, $_POST["id_penjualan"]));
        $tgl_penjualan      = date("Y-m-d H:i:s");
        $tharga_penjualan   = trim(mysqli_real_escape_string($con, $_POST["total_harga"]));
        
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
        

        // insert into table penjualan 
        $statement = $conn->prepare("INSERT INTO penjualan(id_penjualan, tharga_penjualan, id_pegawai, keterangan, time_create, time_update) VALUES(?, ?, ?, ?, ?, ?)");
        $statement->execute(array( "$id_penjualan","$tharga_penjualan","$id_pegawai","$keterangan","$time_create","$time_update"));

        for($i=0; $i<$number; $i++)  
        {  
            $id_detail_penjualan = trim(mysqli_real_escape_string($con, $_POST["id_penjualan"]));

            // id_barang
            $nama_barang    = mysqli_real_escape_string($con, $_POST["nama_barang"][$i]);
            $data_barang    = Database::getInstance($server, $user, $pass, $db_name); $data_barang->setTable('barang');
            $barang         = $data_barang->select()->where('nama_barang','=',$nama_barang)->all();
            foreach($barang as $brg){
                $id_barang = $brg->id_barang;
                $stok      = $brg->stok;
            };

            $qty_penjualan = trim(mysqli_real_escape_string($con, $_POST["qualty"][$i]));

            $data_updateBarang = [
                'stok' => $stok - $qty_penjualan,
                'id_barang' => $id_barang,
            ];

            $stmt= $conn->prepare("UPDATE barang SET stok=:stok WHERE id_barang=:id_barang");
            $stmt->execute($data_updateBarang);

            
            $total_harga_penjualan = trim(mysqli_real_escape_string($con, $_POST["sub_total"][$i])); 

            $time_create_detail = date("Y-m-d H:i:s");
            $time_update_detail = date("Y-m-d H:i:s");

            // insert into table detail penjualan 
            $statement = $conn->prepare("INSERT INTO detail_penjualan(id_penjualan, id_barang, qty_penjualan, total_harga_penjualan, time_create, time_update) VALUES(?, ?, ?, ?, ?, ?)");
            $statement->execute(array( "$id_detail_penjualan","$id_barang","$qty_penjualan","$total_harga_penjualan","$time_create_detail","$time_update_detail"));             
        }  
        // echo "Data Inserted";  
        

?> 