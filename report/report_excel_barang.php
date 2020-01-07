<?php
    require_once "../_config/config.php";
    include_once "../models/database.php";

    $fileName = "excel_barang-(".date('d-m-y').").xls";

    header("Content-Disposition: attachment; filename='$fileName'");
    header("Content-Type: application/vnd.ms-excel");

?>

<style>

</style>

<table border="1px">
    <tr>
        <th>No.</th>
        <th>ID Barang</th>
        <th>Nama Barang</th>
        <th>Harga Barang</th>
        <th>Stok</th>
        <th>kategori</th>
        <th>Time Create</th>
        <th>Time update</th>
    </tr>
    <?php
        $no = 1;
        $statement = $conn->prepare("id_barang,nama_barang,harga_beli,harga_barang,stok,nama_kategori,barang.time_create,barang.time_update FROM barang INNER JOIN kategori ON barang.id_kategori=kategori.id_kategori");
        $statement->execute();    
        $data_barang = $statement->fetchAll(PDO::FETCH_OBJ);
        // $database = Database::getInstance($server, $user, $pass, $db_name);
        // $database->setTable('barang');
        // $data_barang = $database->select()->all();
        foreach($data_barang as $barang){ ?>
            <tr align="left">
                <td> <?php echo $no++ ?></td>
                <td> <?php echo $barang->id_barang;?> </td>
                <td> <?php echo $barang->nama_barang;?> </td>    
                <td align="right"> <?php echo 'Rp '.trim(number_format($barang->harga_barang,0,',','.'));?> </td>    
                <td align="center"> <?php echo $barang->stok;?> </td>    
                <td> <?php echo $barang->nama_kategori;?> </td>    
                <td> <?php echo $barang->time_create;?> </td>
                <td> <?php echo $barang->time_update;?> </td> 
            </tr>
        <?php
        }
    ?>

</table>