<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>



<?php
    $db_barang = Database::getInstance($server, $user, $pass, $db_name);
    $db_barang->setTable('barang');
    $data_barang = $database->select()->all();
    foreach($data_barang as $barang){ 
         $nama_barang[] =  $barang->nama_barang;
         $stok_barang[] =  intval($barang->stok);   
    }
    // var_dump($nama_barang,$stok_barang);
    // var_dump($stok_barang);
?>
<br><br>
<div id="container" style="min-width: 310px; max-width: 800px; height: <?php echo count($nama_barang) * 35 ?>px; margin: 0 auto"></div>

<script>
    Highcharts.chart('container', {
    chart: {
        type: 'bar'
    },
    title: {
        text: 'Stok Barang Tersedia'
    },
    xAxis: {
        categories: <?php echo json_encode($nama_barang); ?>
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Total Stok Barang'
        }
    },
    legend: {
        reversed: true
    },
    plotOptions: {
        series: {
            stacking: 'normal'
        }
    },
    series: [{
        name: 'Stok Barang Tersedia',
        data: <?php echo json_encode($stok_barang); ?>
    }]
});
</script>