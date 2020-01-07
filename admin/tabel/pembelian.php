<div class="container-fluid">
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="index.php">Dashboard</a>
        </li>
        <li class="breadcrumb-item active"> Tabel pembelian </li>
     </ol>
    <div class="row">
        <div class="col-12">
            <div>
                <span class="font-size-18">Data pembelian<span>
                <div class="pull-right pad-b-2">
                    <a href=""><i class="fa fa-refresh pad-lr-2"></i></a>
                    <a href="" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#cetakData"><i class="fa fa-print"></i> Cetak Data</a>   
                    <a href="<?=base_url('report/report_excel_pembelian.php')?>" target="_blank" class="btn btn-secondary btn-sm" ><i class="fa fa-print"></i> Export Excel</a>  
                    <a href="" class="btn btn-success btn-sm" data-toggle="modal" data-target="#tambahData"><i class="fa fa-plus"></i> Tambah pembelian</a>     
                </div>
            </div>
           
            <!-- datatable -->
            <div class="table-responsive pad-tb-5">
            <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>ID_pembelian</th>
                        <th>Tanggal</th>
                        <th>Total Harga</th>
                        <th>ID_Pegawai</th>
                        <th>Keterangan</th>
                        <th>Time_Create</th>
                        <th>Time_update</th>
                        <th class="text-center"><i class="fa fa-cog"></i></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $statement = $conn->prepare("SELECT * FROM pembelian INNER JOIN pegawai ON pembelian.id_pegawai=pegawai.id_pegawai");
                        $statement->execute();    
                        $data_pembelian = $statement->fetchAll(PDO::FETCH_OBJ);
                        // $database->setTable('pembelian');
                        // $data_pembelian = $database->select()->all();
                        foreach($data_pembelian as $pembelian){ ?>
                            <tr>
                                <td> <?php echo $pembelian->id_pembelian;?> </td>
                                <td> <?php echo $pembelian->tgl_pembelian;?> </td>  
                                <td> <?php echo 'Rp '.trim(number_format($pembelian->tharga_pembelian,0,',','.'));?>  </td>    
                                <td> <?php echo $pembelian->nama_p;?> </td>
                                <td> <?php echo $pembelian->keterangan;?> </td>      
                                <td> <?php echo $pembelian->time_create;?> </td>
                                <td> <?php echo $pembelian->time_update;?> </td>
                                <td class="text-center">
                                    <a id="edit" data-toggle="modal" data-target="#editData" data-idpembelian="<?php echo $pembelian->id_pembelian;?>" data-tglpembelian="<?php echo $pembelian->tgl_pembelian;?>" data-thargapembelian="<?php echo $pembelian->tharga_pembelian;?>" data-idpegawai="<?php echo $pembelian->id_pegawai;?>" data-keterangan="<?php echo $pembelian->keterangan;?>" class="btn btn-warning btn-sm">
                                        <i class="fa fa-pencil-square-o" data-toggle="tooltip" data-placement="top" title="Edit"></i>
                                    </a>
                                    <a id="del" data-toggle="modal" data-target="#delData" data-id="<?php echo $pembelian->id_pembelian;?>" data-bantu="<?php echo $pembelian->keterangan;?>" class="btn btn-danger btn-sm"><i class="fa fa-trash-o" data-toggle="tooltip" data-placement="top" title="Hapus" style="color:white"></i></a> 
                                </td>   
                            </tr>
                        <?php }
                    ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th>ID_pembelian</th>
                        <th>Tanggal</th>
                        <th>Total Harga</th>
                        <th>ID_Pegawai</th>
                        <th>Keterangan</th>
                        <th>Time_Create</th>
                        <th>Time_update</th>
                        <th></th>
                    </tr>
                </tfoot>
            </table>
            </div>
            <script>
                $(document).ready(function() {
                    $('#datatable').DataTable( {
                        "columnDefs": [{
                            "searchable": false,
                            "orderable": false,
                            "targets": 7
                        }],
                        "order": [[ 5, 'desc' ]]
                    });
                });
            </script>
        </div>
    </div>
</div>

<!-- Modal tambah data -->
<div class="modal fade" id="tambahData" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <!-- form tambah data -->
            <form action="" method="post" class="needs-validation" novalidate>
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah pembelian</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- content -->    
                    <div class="row justify-content-md-center">
                        <div class="col-md-12 mb-3 ">
                            <div class="form-group">
                                <label for="validationCustom01">ID pembelian</label>                    
                                <!-- include id-uniq -->
                                <input type="text" name="id_pembelian" class="form-control" value="<?php echo get_uuid('105-',8); ?>" id="validationCustom01" required readonly>
                
                                <div class="invalid-feedback">
                                    ID Penjalan belum di isi.
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="validationCustom03">Tanggal Pembelian</label>
                                <input type="date" name="tgl_pembelian" class="form-control" id="validationCustom03" pattern="[0-9]+" required>
                                <div class="invalid-feedback">
                                    Total Harga Harus Di isi dengan Angka.
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="validationCustom03">Total Harga</label>
                                <input type="number" name="tharga_pembelian" class="form-control" id="validationCustom03" pattern="[0-9]+" required>
                                <div class="invalid-feedback">
                                    Total Harga Harus Di isi dengan Angka.
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="validationCustom04">ID Pegawai</label>
                                <select class="custom-select" name="id_pegawai" id="inputGroupSelect01">
                                    <!-- get data to t_jabatan -->
                                    <?php
                                        $database->setTable('pegawai');
                                        $data_pegawai = $database->select()->all(); 
                                        
                                        foreach($data_pegawai as $pegawai){ ?>
                                            <option selected value="<?php echo $pegawai->id_pegawai;?>"><?php echo $pegawai->nama_p;?></option>                                        
                                        <?php } 
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="validationCustom02">Keterangan</label>
                                <input type="text" name="keterangan" class="form-control" id="validationCustom02">
                            </div>
                            <div class="form-group">
                                <input type="hidden" name="time_create" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <input type="hidden" name="time_update" class="form-control" required>
                            </div>
                        </div>
                    </div>           
                    <!--  -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button class="btn btn-primary" name="add" type="submit">Submit form</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
// validation form Example starter JavaScript for disabling form submissions if there are invalid fields
(function() {
  'use strict';
  window.addEventListener('load', function() {
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  }, false);
})();
</script>

<!-- proses add data -->
<?php
    if(isset($_POST['add'])){
        $id_pembelian       = trim(mysqli_real_escape_string($con,$_POST['id_pembelian']));
        $tgl_pembelian      = trim(mysqli_real_escape_string($con,$_POST['tgl_pembelian']));
        $tharga_pembelian   = trim(mysqli_escape_string($con,$_POST['tharga_pembelian']));
        $id_pegawai         = trim(mysqli_escape_string($con,$_POST['id_pegawai']));
        $keterangan         = trim(mysqli_escape_string($con,$_POST['keterangan']));
        $time_create        = date("Y-m-d H:i:s");
        $time_update        = date("Y-m-d H:i:s");

        $createData = Database::getInstance($server, $user, $pass, $db_name);
        $createData->setTable('pembelian');
        $createData->create([
            'id_pembelian'      => $id_pembelian,
            'tgl_pembelian'     => $tgl_pembelian,
            'tharga_pembelian'  => $tharga_pembelian,
            'id_pegawai'        => $id_pegawai,
            'keterangan'        => $keterangan,
            'time_create'       => $time_create,
            'time_update'       => $time_update,
        ]); 
       
        if($createData){ ?> 
            <script>
                mess_success("Data <?php echo " $id_pembelian "?> Berhasil Di Tambahkan","?page=pembelian"); 
            </script>
        <?php
        }
    }
?>


<!-- Modal Edit data -->
<div class="modal fade" id="editData" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <!-- form tambah data -->
            <form action="" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ubah Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="modal_edit">
                    <!-- content -->    
                        <div class="row justify-content-md-center">
                            <div class="col-md-12 mb-3 ">
                                <div class="form-group">
                                    <label for="id_pembelian">ID pembelian</label>
                                    <input type="text" id="id_pembelian" name="id_pembelian" class="form-control" required readonly>                                    
                                </div>
                                <div class="form-group">
                                    <label for="tgl_pembelian">Tanggal Pembelian</label>
                                    <input type="date" id="tgl_pembelian" name="tgl_pembelian" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="tharga_pembelian">Total Harga</label>
                                    <input type="number" id="tharga_pembelian" name="tharga_pembelian" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="id_pegawai">Pegawai</label>
                                    <select class="custom-select" id="id_pegawai" name="id_pegawai" >
                                        <?php
                                            $database->setTable('pegawai');
                                            $data_pegawai = $database->select()->all(); 
                                            
                                            foreach($data_pegawai as $pegawai){ ?>
                                                <option value="<?php echo $pegawai->id_pegawai;?>"><?php echo $pegawai->nama_p;?></option>                                                                               
                                            <?php } 
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="keterangan">Keterangan</label>
                                    <input type="text" id="keterangan" name="keterangan" class="form-control">
                                </div>
                                <div class="form-group">
                                    <input type="hidden" name="time_update" class="form-control" required>
                                </div>
                            </div>
                        </div>  
                    <!--  -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button class="btn btn-primary" name="edit" type="submit">Submit form</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- proses ajax Edit data -->
<script>
    $(document).on("click","#edit",function(){
        var idpembelian = $(this).data('idpembelian');
        var tglpembelian = $(this).data('tglpembelian');
        var thargapembelian = $(this).data('thargapembelian');
        var idpegawai = $(this).data('idpegawai');
        var keterangan = $(this).data('keterangan');
        $("#modal_edit #id_pembelian").val(idpembelian);
        $("#modal_edit #tgl_pembelian").val(tglpembelian);
        $("#modal_edit #tharga_pembelian").val(thargapembelian);
        $("#modal_edit #id_pegawai").val(idpegawai);
        $("#modal_edit #keterangan").val(keterangan);
    })
</script>

<!-- proses edit data -->
<?php
    if(isset($_POST['edit'])){
        $id_pembelian       = trim(mysqli_real_escape_string($con,$_POST['id_pembelian']));
        $tgl_pembelian      = trim(mysqli_real_escape_string($con,$_POST['tgl_pembelian']));
        $tharga_pembelian   = trim(mysqli_escape_string($con,$_POST['tharga_pembelian']));
        $id_pegawai         = trim(mysqli_escape_string($con,$_POST['id_pegawai']));
        $keterangan         = trim(mysqli_escape_string($con,$_POST['keterangan']));
        $time_update        = date("Y-m-d H:i:s");
      
        $editData = Database::getInstance($server, $user, $pass, $db_name);
        $editData->setTable('pembelian');
        $editData->where('id_pembelian', '=', $id_pembelian)->update([
            'tgl_pembelian'     => $tgl_pembelian,
            'tharga_pembelian'  => $tharga_pembelian,
            'id_pegawai'        => $id_pegawai,
            'keterangan'        => $keterangan,
            'time_update'       => $time_update,            
        ]);

        if($editData){ ?> 
            <script>
                mess_success("Data <?php echo " $id_pembelian "?> Berhasil Di ubah","?page=pembelian"); 
            </script>
        <?php
        }
    }
?>




<!-- Modal delete data -->
<div class="modal fade" id="delData" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <!-- form tambah data -->
            <form action="" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="modal_del">
                        <input type="hidden" id="id_pembelian" name="id_pembelian" class="form-control" required readonly>  
                        <span> Apakah Anda yakin ingin menghapus data ini !!! </span><br>
                        <span> ID pembelian -> <input type="text" id="view_id" class="btn-default" style="border:none;" readonly> </span><br>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button class="btn btn-danger" name="del" type="submit">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- proses ajax del data -->
<script>
    $(document).on("click","#del",function(){
        var id = $(this).data('id');
        var bantu = $(this).data('bantu');
        $("#modal_del #id_pembelian").val(id);
        $("#modal_del #view_id").val(id);
    })
</script>

<!-- proses delete data -->
<?php
    if(isset($_POST['del'])){
        $id_pembelian = trim(mysqli_real_escape_string($con,$_POST['id_pembelian']));
      
        $delData = Database::getInstance($server, $user, $pass, $db_name);
        $delData->setTable('pembelian');
        $delData->where('id_pembelian','=', $id_pembelian)->delete();

        if($delData){ ?> 
            <script>
                mess_success("Data <?php echo " $id_pembelian "?> Berhasil Di Delete","?page=pembelian"); 
            </script>
        <?php
        }
    }
?>

<?php 
    $address = "pembelian.php";
    include_once("_modalCetak.php"); 
?>