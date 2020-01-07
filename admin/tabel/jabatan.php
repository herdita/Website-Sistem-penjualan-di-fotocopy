<div class="container-fluid">
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="index.php">Dashboard</a>
        </li>
        <li class="breadcrumb-item active"> Tabel Jabatan </li>
     </ol>
    <div class="row">
        <div class="col-12">
            
            <div>
                <span class="font-size-18">Data Jabatan<span>
                <div class="pull-right pad-b-2">
                    <a href=""><i class="fa fa-refresh pad-lr-2"></i></a>
                    <a href="" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#cetakData"><i class="fa fa-print"></i> Cetak Data</a>   
                    <a href="<?=base_url('report/report_excel_jabatan.php')?>" target="_blank" class="btn btn-secondary btn-sm" ><i class="fa fa-print"></i> Export Excel</a>  
                    <a href="" class="btn btn-success btn-sm" data-toggle="modal" data-target="#tambahData"><i class="fa fa-plus"></i> Tambah jabatan</a>     
                </div>
            </div>
           
            <!-- datatable -->
            <div class="table-responsive pad-tb-5">
            <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>ID_Jabatan</th>
                        <th>Nama Jabatan</th>
                        <th>Time Create</th>
                        <th>Time Update</th>
                        <th class="text-center"><i class="fa fa-cog"></i></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $database->setTable('jabatan');
                        $data_jabatan = $database->select()->all();
                        foreach($data_jabatan as $jabatan){ ?>
                            <tr>
                                <td> <?php echo $jabatan->id_jabatan;?> </td>
                                <td> <?php echo $jabatan->nama_jabatan;?> </td>    
                                <td> <?php echo $jabatan->time_create;?> </td>
                                <td> <?php echo $jabatan->time_update;?> </td>
                                <td class="text-center">
                                    <a id="edit" data-toggle="modal" data-target="#editData" data-idjabatan="<?php echo $jabatan->id_jabatan;?>" data-namajabatan="<?php echo $jabatan->nama_jabatan;?>" class="btn btn-warning btn-sm">
                                        <i class="fa fa-pencil-square-o" data-toggle="tooltip" data-placement="top" title="Edit"></i>
                                    </a>
                                    <a id="del" data-toggle="modal" data-target="#delData" data-id="<?php echo $jabatan->id_jabatan;?>" data-bantu="<?php echo $jabatan->nama_jabatan;?>" class="btn btn-danger btn-sm"><i class="fa fa-trash-o" data-toggle="tooltip" data-placement="top" title="Hapus" style="color:white"></i></a> 
                                </td>   
                            </tr>
                        <?php }
                    ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th>ID_Jabatan</th>
                        <th>Nama Jabatan</th>
                        <th>Time Create</th>
                        <th>Time Update</th>
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
                            "targets": 4
                        }],
                        "order": [[ 2, 'desc' ]]
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
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- content -->    
                    <div class="row justify-content-md-center">
                        <div class="col-md-12 mb-3 ">
                            <div class="form-group">
                                <label for="validationCustom01">ID Jabatan</label>                    
                                <!-- include id-uniq -->
                                <input type="text" name="id_jabatan" class="form-control" value="<?php echo get_uuid('102-',5); ?>" id="validationCustom01" required readonly>
                                <div class="invalid-feedback">
                                    ID jabatan belum di isi.
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="validationCustom02">Nama Jabatan</label>
                                <input type="text" name="nama_jabatan" class="form-control" id="validationCustom02" required>
                                <div class="invalid-feedback">
                                    Nama Jabatan belum di isi.
                                </div>
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
        $id_jabatan     = trim(mysqli_real_escape_string($con,$_POST['id_jabatan']));
        $nama_jabatan   = trim(mysqli_escape_string($con,$_POST['nama_jabatan']));
        $time_create    = date("Y-m-d H:i:s");
        $time_update    = date("Y-m-d H:i:s");

        $createData = Database::getInstance($server, $user, $pass, $db_name);
        $createData->setTable('jabatan');
        $createData->create([
            'id_jabatan' => $id_jabatan,
            'nama_jabatan' => $nama_jabatan,
            'time_create' => $time_create,
            'time_update' => $time_update,
        ]); 
       
        if($createData){ ?> 
            <script>
                mess_success("Data <?php echo " $id_jabatan "?> Berhasil Di Tambahkan","?page=jabatan"); 
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
                                    <label for="id_jabatan">ID Jabatan</label>
                                    <input type="text" id="id_jabatan" name="id_jabatan" class="form-control" required readonly>                                    
                                </div>
                                <div class="form-group">
                                    <label for="nama_p">Nama Jabatan</label>
                                    <input type="text" id="nama_jabatan" name="nama_jabatan" class="form-control" required>
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
        var idjabatan = $(this).data('idjabatan');
        var namajabatan = $(this).data('namajabatan');
        $("#modal_edit #id_jabatan").val(idjabatan);
        $("#modal_edit #nama_jabatan").val(namajabatan);
    })
</script>

<!-- proses edit data -->
<?php
    if(isset($_POST['edit'])){
        $id_jabatan     = trim(mysqli_real_escape_string($con,$_POST['id_jabatan']));
        $nama_jabatan   = trim(mysqli_escape_string($con,$_POST['nama_jabatan']));
        $time_update    = date("Y-m-d H:i:s");
      
        $editData = Database::getInstance($server, $user, $pass, $db_name);
        $editData->setTable('jabatan');
        $editData->where('id_jabatan', '=', $id_jabatan)->update([
            'nama_jabatan' => $nama_jabatan,
            'time_update' => $time_update,            
        ]);

        if($editData){ ?> 
            <script>
                mess_success("Data <?php echo " $id_jabatan "?> Berhasil Di ubah","?page=jabatan"); 
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
                        <input type="hidden" id="id_jabatan" name="id_jabatan" class="form-control" required readonly>  
                        <span> Apakah Anda yakin ingin menghapus data ini !!! Sebelumnya Pastikan relasi dari table ini </span><br>
                        <span> ID Jabatan -> <input type="text" id="view_id" class="btn-default" style="border:none;" readonly> </span><br>
                        <span> nama Jabatan -> <input type="text" id="view_bantu" class="btn-default" style="border:none; width:200px" readonly> </span>
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
        $("#modal_del #id_jabatan").val(id);
        $("#modal_del #view_id").val(id);
        $("#modal_del #view_bantu").val(bantu);
    })
</script>

<!-- proses delete data -->
<?php
    if(isset($_POST['del'])){
        $id_jabatan = trim(mysqli_real_escape_string($con,$_POST['id_jabatan']));
      
        $delData = Database::getInstance($server, $user, $pass, $db_name);
        $delData->setTable('jabatan');
        $delData->where('id_jabatan', '=', $id_jabatan)->delete();

        if($delData){ ?> 
            <script>
                mess_success("Data <?php echo " $id_jabatan "?> Berhasil Di Delete","?page=jabatan"); 
            </script>
        <?php
        }

    }
?>

<?php 
    $address = "jabatan.php";
    include_once("_modalCetak.php"); 
?>