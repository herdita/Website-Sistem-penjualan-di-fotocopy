<?php
    require_once "../_config/config.php";
    include_once "../models/database.php";

    $fileName = "excel_jabatan-(".date('d-m-y').").xls";

    header("Content-Disposition: attachment; filename='$fileName'");
    header("Content-Type: application/vnd.ms-excel");

?>

<style>

</style>

<table border="1px">
    <tr>
        <th>ID Jabatan</th>
        <th>Nama Jabatan</th>
        <th>Time Create</th>
        <th>Time Update</th>  
    </tr>
    <?php
        $no = 1;
        $database = Database::getInstance($server, $user, $pass, $db_name);
        $database->setTable('jabatan');
        $data_jabatan = $database->select()->all();
        foreach($data_jabatan as $jabatan){ ?>
            <tr align="left">
                <td> <?php echo $no++ ?></td>
                <td> <?php echo $jabatan->id_jabatan;?> </td>
                <td> <?php echo $jabatan->nama_jabatan;?> </td>    
                <td> <?php echo $jabatan->time_create;?> </td>
                <td> <?php echo $jabatan->time_update;?> </td>   
            </tr>
        <?php
        }
    ?>

</table>