<?php
    require_once "../_config/config.php";
    include_once "../models/database.php";

    $fileName = "excel_kategori-(".date('d-m-y').").xls";

    header("Content-Disposition: attachment; filename='$fileName'");
    header("Content-Type: application/vnd.ms-excel");

?>

<style>

</style>

<table border="1px">
    <tr>
        <th>ID kategori</th>
        <th>Nama kategori</th>
        <th>Time Create</th>
        <th>Time Update</th>  
    </tr>
    <?php
        $no = 1;
        $database = Database::getInstance($server, $user, $pass, $db_name);
        $database->setTable('kategori');
        $data_kategori = $database->select()->all();
        foreach($data_kategori as $kategori){ ?>
            <tr align="left">
                <td> <?php echo $no++ ?></td>
                <td> <?php echo $kategori->id_kategori;?> </td>
                <td> <?php echo $kategori->nama_kategori;?> </td>    
                <td> <?php echo $kategori->time_create;?> </td>
                <td> <?php echo $kategori->time_update;?> </td>   
            </tr>
        <?php
        }
    ?>

</table>