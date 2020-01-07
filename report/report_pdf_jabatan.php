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
            Laporan Data jabatan
        </div><br>
       

        <table border="1px" class="tabel">
            <tr>
                <th>No.</th>
                <th>ID jabatan</th>
                <th>Nama jabatan</th>
                <th>Time Create</th>
                <th>Time Update</th>
            </tr>';

            if(isset($_POST['print'])){
                $tgl_awal = trim(mysqli_real_escape_string($con,$_POST['tgl_awal']));
                $tgl_akhir = trim(mysqli_real_escape_string($con,$_POST['tgl_akhir']));      
                $no = 1;
                $result = $conn->query("SELECT * FROM jabatan WHERE time_create BETWEEN '$tgl_awal' AND '$tgl_akhir'");
                while($data = $result->fetchObject()){
                    $content .= '
                    <tr>
                        <td>'.$no++.'</td>
                        <td>'.$data->id_jabatan.'</td>
                        <td>'.$data->nama_jabatan.'</td>
                        <td>'.$data->time_create.'</td>
                        <td>'.$data->time_update.'</td>
                    </tr>';
                };
            }


            if(isset($_POST['printAll'])){      
                $no = 1;
                $result = $conn->query("SELECT * FROM jabatan");
                while($data = $result->fetchObject()){
                    $content .= '
                    <tr>
                        <td>'.$no++.'</td>
                        <td>'.$data->id_jabatan.'</td>
                        <td>'.$data->nama_jabatan.'</td>
                        <td>'.$data->time_create.'</td>
                        <td>'.$data->time_update.'</td>
                    </tr>';
                };
            }

        $content .= '
        </table>
    </page>';

    require_once('../_assets/libs/html2pdf/html2pdf.class.php');
    $html2pdf = new HTML2PDF('P','A4','en');
    $html2pdf->WriteHTML($content);
    $html2pdf->Output('jabatan.pdf');

?>