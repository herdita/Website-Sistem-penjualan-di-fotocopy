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
        <th>ID_Penjualan</th>
        <th>Total Harga</th>
        <th>ID_Pegawai</th>
        <th>Keterangan</th>
        <th>Time_Create</th>
        <th>Time_update</th>
    </tr>
    <?php
        $statement = $conn->prepare("SELECT * FROM penjualan INNER JOIN pegawai ON penjualan.id_pegawai=pegawai.id_pegawai");
        $statement->execute();    
        $data_penjualan = $statement->fetchAll(PDO::FETCH_OBJ);
        // $database->setTable('penjualan');
        // $data_penjualan = $database->select()->all();
        foreach($data_penjualan as $penjualan){ ?>
            <tr>
                <td> <?php echo $penjualan->id_penjualan;?> </td>  
                <td> <?php echo 'Rp '.trim(number_format($penjualan->tharga_penjualan,0,',','.'));?>  </td>    
                <td> <?php echo $penjualan->nama_p;?> </td>
                <td> <?php echo $penjualan->keterangan;?> </td>      
                <td> <?php echo $penjualan->time_create;?> </td>
                <td> <?php echo $penjualan->time_update;?> </td>  
            </tr>
        <?php }
    ?>
</table>