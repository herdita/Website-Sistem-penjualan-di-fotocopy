<?php
    
    require_once "../_config/config.php";
    include_once "../models/database.php";

    $content = '
    <style type="text/css">
        .tabel { border-collapse:collapse; }
        .tabel th { padding:10px 15px; background-color:#ecf0f1; color:black; }
        .tabel td { padding:8px 15px; }
        img { width:70px; }
    </style>
    ';

    $content .= '
    <page>

        <div style="padding:4mm; border:1px solid;" align="center">
            <span style="font-size:25px;"> Laporan Data Fotocopy Prima </span>
        </div>

        <div style="padding:20px 0 10px 0; font-size:20px;">
            Laporan Data barang
        </div><br>
       

        <table border="1px" class="tabel">
            <tr>
                <th>No.</th>
                <th>ID Barang</th>
                <th>Nama Barang</th>
                <th>Harga Barang</th>
                <th>Stok</th>
                <th>kategori</th>
                <th>Time Create</th>
            </tr>';

            if(isset($_POST['print'])){
                $tgl_awal = trim(mysqli_real_escape_string($con,$_POST['tgl_awal']));
                $tgl_akhir = trim(mysqli_real_escape_string($con,$_POST['tgl_akhir']));      
                $no = 1;
                $result = $conn->query("SELECT id_barang,nama_barang,harga_barang,stok,nama_kategori,barang.time_create FROM barang INNER JOIN kategori ON barang.id_kategori=kategori.id_kategori WHERE barang.time_create BETWEEN '$tgl_awal' AND '$tgl_akhir'");
                while($data = $result->fetchObject()){
                    $content .= '
                    <tr>
                        <td>'.$no++.'</td>
                        <td>'.$data->id_barang.'</td>
                        <td>'.$data->nama_barang.'</td>
                        <td align="right">'.trim(number_format($data->harga_barang,0,',','.')).'</td>
                        <td align="center">'.$data->stok.'</td>
                        <td>'.$data->nama_kategori.'</td>
                        <td>'.$data->time_create.'</td>
                    </tr>';
                };
            }


            if(isset($_POST['printAll'])){      
                $no = 1;
                $result = $conn->query("SELECT id_barang,nama_barang,harga_barang,stok,nama_kategori,barang.time_create FROM barang INNER JOIN kategori ON barang.id_kategori=kategori.id_kategori");
                while($data = $result->fetchObject()){
                    $content .= '
                    <tr>
                        <td>'.$no++.'</td>
                        <td>'.$data->id_barang.'</td>
                        <td>'.$data->nama_barang.'</td>
                        <td align="right">'.trim(number_format($data->harga_barang,0,',','.')).'</td>
                        <td align="center">'.$data->stok.'</td>
                        <td>'.$data->nama_kategori.'</td>
                        <td>'.$data->time_create.'</td>
                    </tr>';
                };
            }

        $content .= '
        </table>
    </page>';

    require_once('../_assets/libs/html2pdf/html2pdf.class.php');
    $html2pdf = new HTML2PDF('L','A4','en');
    $html2pdf->WriteHTML($content);
    $html2pdf->Output('barang.pdf');

?>