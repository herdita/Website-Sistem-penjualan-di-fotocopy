<div class="container-fluid">
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="index.php">Dashboard</a>
        </li>
        <li class="breadcrumb-item active"> Tabel Pegawai </li>
     </ol>
    <div class="row">
        <div class="col-12">
            
            <div>
                <span class="font-size-18">Data Pegawai<span>
                <div class="pull-right pad-b-2">
                    <a href=""><i class="fa fa-refresh pad-lr-2"></i></a>
                    <a href="" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#cetakData"><i class="fa fa-print"></i> Cetak Data</a>   
                    <a href="<?=base_url('report/report_excel_pegawai.php')?>" target="_blank" class="btn btn-secondary btn-sm" ><i class="fa fa-print"></i> Export Excel</a>                         
                    <a href="" class="btn btn-success btn-sm" data-toggle="modal" data-target="#tambahData"><i class="fa fa-plus"></i> Tambah Pegawai</a>     
                </div>
            </div>
           
            <!-- datatable -->
            <div class="table-responsive pad-tb-5">
            <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>ID_Pegawai</th>
                        <th>Nama</th>
                        <th>No Telp</th>
                        <th>ID_Jabatan</th>
                        <th>Username</th>
                        <th>Time_Create</th>
                        <th>Time_update</th>
                        <th class="text-center"><i class="fa fa-cog"></i></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $statement = $conn->prepare("SELECT id_pegawai,nama_p,no_telp,nama_jabatan,username,pass,pegawai.time_create,pegawai.time_update FROM pegawai INNER JOIN jabatan ON pegawai.id_jabatan=jabatan.id_jabatan");
                        $statement->execute();    
                        $data_pegawai = $statement->fetchAll(PDO::FETCH_OBJ);

                        // $database->setTable('pegawai');
                        // $data_pegawai = $database->select()->all();
                        foreach($data_pegawai as $pegawai){ ?>
                            <tr>
                                <td> <?php echo $pegawai->id_pegawai;?> </td>
                                <td> <?php echo $pegawai->nama_p;?> </td>    
                                <td> <?php echo $pegawai->no_telp;?> </td>    
                                <td> <?php echo $pegawai->nama_jabatan;?> </td>    
                                <td> <?php echo $pegawai->username;?> </td>    
                                <td> <?php echo $pegawai->time_create;?> </td>
                                <td> <?php echo $pegawai->time_update;?> </td>
                                <td class="text-center">
                                    <a id="edit" data-toggle="modal" data-target="#editData" data-idpegawai="<?php echo $pegawai->id_pegawai;?>" data-namapegawai="<?php echo $pegawai->nama_p;?>" data-notelp="<?php echo $pegawai->no_telp;?>" data-idjabatan="<?php echo $pegawai->id_jabatan;?>" data-username="<?php echo $pegawai->username;?>" data-pass="<?php echo $pegawai->pass;?>" class="btn btn-warning btn-sm">
                                        <i class="fa fa-pencil-square-o" data-toggle="tooltip" data-placement="top" title="Edit"></i>
                                    </a>
                                    <a id="del" data-toggle="modal" data-target="#delData" data-id="<?php echo $pegawai->id_pegawai;?>" data-bantu="<?php echo $pegawai->nama_p;?>" class="btn btn-danger btn-sm"><i class="fa fa-trash-o" data-toggle="tooltip" data-placement="top" title="Hapus" style="color:white"></i></a> 
                                </td>   
                            </tr>
                        <?php }
                    ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th>ID_Pegawai</th>
                        <th>Nama</th>
                        <th>No Telp</th>
                        <th>ID_Jabatan</th>
                        <th>Username</th>
                        <th>Password</th>
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
                                <label for="validationCustom01">ID Pegawai</label>                    
                                <!-- include id-uniq -->
                                <input type="text" name="id_pegawai" class="form-control" value="<?php echo get_uuid('101-',5); ?>" id="validationCustom01" required readonly>
                
                                <div class="invalid-feedback">
                                    ID Pegawai belum di isi.
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="validationCustom02">Nama Pegawai</label>
                                <input type="text" name="nama_p" class="form-control" id="validationCustom02" required>
                                <div class="invalid-feedback">
                                    Nama Pegawai belum di isi.
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="validationCustom03">No Telp</label>
                                <input type="text" name="no_telp" class="form-control" id="validationCustom03" pattern="[0-9]+" required>
                                <div class="invalid-feedback">
                                    No Telepon Harus Di isi dengan Angka.
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="validationCustom04">Jabatan</label>
                                <select class="custom-select" name="id_jabatan" id="inputGroupSelect01">
                                    <!-- get data to t_jabatan -->
                                    <?php
                                        $database->setTable('jabatan');
                                        $data_jabatan = $database->select()->all(); 
                                        
                                        foreach($data_jabatan as $jabatan){ ?>
                                            <option selected value="<?php echo $jabatan->id_jabatan;?>"><?php echo $jabatan->nama_jabatan;?></option>                                        
                                        <?php } 
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="validationCustom05">Username</label>
                                <input type="text" name="username" class="form-control" id="validationCustom05" required>
                                <div class="invalid-feedback">
                                    Username belum di isi.
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="validationCustom06">Password</label>
                                <input type="text" name="password" class="form-control" id="validationCustom06" required>
                                <div class="invalid-feedback">
                                    Password belum di isi.
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
        $id_pegawai = trim(mysqli_real_escape_string($con,$_POST['id_pegawai']));
        $nama_p     = trim(mysqli_escape_string($con,$_POST['nama_p']));
        $no_telp    = trim(mysqli_escape_string($con,$_POST['no_telp']));
        $id_jabatan = trim(mysqli_escape_string($con,$_POST['id_jabatan']));
        $username   = trim(mysqli_escape_string($con,$_POST['username']));
        $password   = md5(trim(mysqli_escape_string($con,$_POST['password'])));
        $time_create= date("Y-m-d H:i:s");
        $time_update= date("Y-m-d H:i:s");

        $createData = Database::getInstance($server, $user, $pass, $db_name);
        $createData->setTable('pegawai');
        $createData->create([
            'id_pegawai' => $id_pegawai,
            'nama_p' => $nama_p,
            'no_telp' => $no_telp,
            'id_jabatan' => $id_jabatan,
            'username' => $username,
            'pass' => $password,
            'time_create' => $time_create,
            'time_update' => $time_update,
        ]); 
       
        if($createData){ ?> 
            <script>
                mess_success("Data <?php echo " $nama_p "?> Berhasil Di Tambahkan","?page=pegawai"); 
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
                                    <label for="id_pegawai">ID Pegawai</label>
                                    <input type="text" id="id_pegawai" name="id_pegawai" class="form-control" required readonly>                                    
                                </div>
                                <div class="form-group">
                                    <label for="nama_p">Nama Pegawai</label>
                                    <input type="text" id="nama_p" name="nama_p" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="no_telp">No Telp</label>
                                    <input type="text" id="no_telp" name="no_telp" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="id_jabatan">Jabatan</label>
                                    <select class="custom-select" id="id_jabatan" name="id_jabatan" >
                                        <?php
                                            $database->setTable('jabatan');
                                            $data_jabatan = $database->select()->all(); 
                                            
                                            foreach($data_jabatan as $jabatan){ ?>
                                                <option value="<?php echo $jabatan->id_jabatan;?>"><?php echo $jabatan->nama_jabatan;?></option>                                                                               
                                            <?php } 
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input type="text" id="username" name="username" class="form-control" required>
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
        var idpegawai = $(this).data('idpegawai');
        var namapegawai = $(this).data('namapegawai');
        var notelp = $(this).data('notelp');
        var idjabatan = $(this).data('idjabatan');
        var username = $(this).data('username');
        var pass = $(this).data('pass');
        $("#modal_edit #id_pegawai").val(idpegawai);
        $("#modal_edit #nama_p").val(namapegawai);
        $("#modal_edit #no_telp").val(notelp);
        $("#modal_edit #id_jabatan").val(idjabatan);
        $("#modal_edit #username").val(username);
        $("#modal_edit #pass").val(pass);
    })
</script>

<!-- proses edit data -->
<?php
    if(isset($_POST['edit'])){
        $id_pegawai = trim(mysqli_real_escape_string($con,$_POST['id_pegawai']));
        $nama_p     = trim(mysqli_escape_string($con,$_POST['nama_p']));
        $no_telp    = trim(mysqli_escape_string($con,$_POST['no_telp']));
        $id_jabatan = trim(mysqli_escape_string($con,$_POST['id_jabatan']));
        $username   = trim(mysqli_escape_string($con,$_POST['username']));
        $time_update= date("Y-m-d H:i:s");
      
        $editData = Database::getInstance($server, $user, $pass, $db_name);
        $editData->setTable('pegawai');
        $editData->where('id_pegawai', '=', $id_pegawai)->update([
            'nama_p' => $nama_p,
            'no_telp' => $no_telp,
            'id_jabatan' => $id_jabatan,
            'username' => $username,
            'time_update' => $time_update,            
        ]);

        if($editData){ ?> 
            <script>
                mess_success("Data <?php echo " $id_pegawai "?> Berhasil Di ubah","?page=pegawai"); 
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
                        <input type="hidden" id="id_pegawai" name="id_pegawai" class="form-control" required readonly>  
                        <span> Apakah Anda yakin ingin menghapus data ini !!! </span><br>
                        <span> ID Pegawai -> <input type="text" id="view_id" class="btn-default" style="border:none;" readonly> </span><br>
                        <span> nama Pegawai -> <input type="text" id="view_bantu" class="btn-default" style="border:none; width:200px" readonly> </span>
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
        $("#modal_del #id_pegawai").val(id);
        $("#modal_del #view_id").val(id);
        $("#modal_del #view_bantu").val(bantu);
    })
</script>

<!-- proses delete data -->
<?php
    if(isset($_POST['del'])){
        $id_pegawai = trim(mysqli_real_escape_string($con,$_POST['id_pegawai']));
      
        $delData = Database::getInstance($server, $user, $pass, $db_name);
        $delData->setTable('pegawai');
        $delData->where('id_pegawai', '=', $id_pegawai)->delete();

        if($delData){ ?> 
            <script>
                mess_success("Data <?php echo " $id_pegawai "?> Berhasil Di Delete","?page=pegawai"); 
            </script>
        <?php
        }
    }
?>


<!-- modal cetak data -->

<?php 
    $address = "pegawai.php";
    include_once("_modalCetak.php"); 
?>