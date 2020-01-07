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
            Laporan Data Pegawai
        </div><br>
       

        <table border="1px" class="tabel">
            <tr>
                <th>No.</th>
                <th>ID Pegawai</th>
                <th>Nama Pegawai</th>
                <th>No Telp</th>
                <th>Jabatan</th>
                <th>Username</th>
                <th>time create</th>
            </tr>';

            if(isset($_POST['print'])){
                $tgl_awal = trim(mysqli_real_escape_string($con,$_POST['tgl_awal']));
                $tgl_akhir = trim(mysqli_real_escape_string($con,$_POST['tgl_akhir']));      
                $no = 1;
                $result = $conn->query("SELECT id_pegawai,nama_p,no_telp,nama_jabatan,username,time_create FROM pegawai INNER JOIN jabatan ON pegawai.id_jabatan=jabatan.id_jabatan WHERE pegawai.time_create BETWEEN '$tgl_awal' AND '$tgl_akhir'");
                while($data = $result->fetchObject()){
                    $content .= '
                    <tr>
                        <td>'.$no++.'</td>
                        <td>'.$data->id_pegawai.'</td>
                        <td>'.$data->nama_p.'</td>
                        <td>'.$data->no_telp.'</td>
                        <td>'.$data->nama_jabatan.'</td>
                        <td>'.$data->username.'</td>
                        <td>'.$data->time_create.'</td>
                    </tr>';
                };
            }


            if(isset($_POST['printAll'])){      
                $no = 1;
                $result = $conn->query("SELECT id_pegawai,nama_p,no_telp,nama_jabatan,username,time_create FROM pegawai INNER JOIN jabatan ON pegawai.id_jabatan=jabatan.id_jabatan");
                while($data = $result->fetchObject()){
                    $content .= '
                    <tr>
                        <td>'.$no++.'</td>
                        <td>'.$data->id_pegawai.'</td>
                        <td>'.$data->nama_p.'</td>
                        <td>'.$data->no_telp.'</td>
                        <td>'.$data->nama_jabatan.'</td>
                        <td>'.$data->username.'</td>
                        <td>'.$data->time_create.'</td>
                    </tr>';
                };
            }

        $content .= '
        </table>
    </page>';

    require_once('../_assets/libs/html2pdf/html2pdf.class.php');
    $html2pdf = new HTML2PDF('P','A4','en');
    $html2pdf->WriteHTML($content);
    $html2pdf->Output('pegawai.pdf');

?>