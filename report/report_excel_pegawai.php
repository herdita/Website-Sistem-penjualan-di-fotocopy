<?php
    require_once "../_config/config.php";
    include_once "../models/database.php";

    $fileName = "excel_pegawai-(".date('d-m-y').").xls";

    header("Content-Disposition: attachment; filename='$fileName'");
    header("Content-Type: application/vnd.ms-excel");

?>

<style>

</style>

<table border="1px">
    <tr>
        <th>No.</th>
        <th>ID Pegawai</th>
        <th>Nama Pegawai</th>
        <th>No Telp</th>
        <th>ID Jabatan</th>
        <th>Username</th>
        <th>Password</th>
        <th>Time create</th>
        <th>Time update</th>
    </tr>
    <?php
        $no = 1;
        $statement = $conn->prepare("SELECT id_pegawai,nama_p,no_telp,nama_jabatan,username,pass,pegawai.time_create,pegawai.time_update FROM pegawai INNER JOIN jabatan ON pegawai.id_jabatan=jabatan.id_jabatan");
        $statement->execute();    
        $data_pegawai = $statement->fetchAll(PDO::FETCH_OBJ);
        // $database = Database::getInstance($server, $user, $pass, $db_name);
        // $database->setTable('pegawai');
        // $data_pegawai = $database->select()->all();
        foreach($data_pegawai as $pegawai){ ?>
            <tr align="left">
                <td> <?php echo $no++ ?></td>
                <td> <?php echo $pegawai->id_pegawai;?> </td>
                <td> <?php echo $pegawai->nama_p;?> </td>    
                <td> <?php echo $pegawai->no_telp;?> </td>    
                <td> <?php echo $pegawai->nama_jabatan;?> </td>    
                <td> <?php echo $pegawai->username;?> </td>
                <td> <?php echo $pegawai->pass;?> </td>    
                <td> <?php echo $pegawai->time_create;?> </td>
                <td> <?php echo $pegawai->time_update;?> </td>   
            </tr>
        <?php
        }
    ?>

</table>