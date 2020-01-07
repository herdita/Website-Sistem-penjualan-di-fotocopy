<div class="container-fluid">
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="index.php">Dashboard</a>
        </li>
        <li class="breadcrumb-item active"> Tabel Barang </li>
     </ol>
    <div class="row">
        <div class="col-12">
            
            <div>
                <span class="font-size-18">Data Barang<span>
                <div class="pull-right pad-b-2">
                    <a href=""><i class="fa fa-refresh pad-lr-2"></i></a>
                    <a href="" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#cetakData"><i class="fa fa-print"></i> Cetak Data</a>   
                    <a href="<?=base_url('report/report_excel_barang.php')?>" target="_blank" class="btn btn-secondary btn-sm" ><i class="fa fa-print"></i> Export Excel</a>  
                    <a href="" class="btn btn-success btn-sm" data-toggle="modal" data-target="#tambahData"><i class="fa fa-plus"></i> Tambah Barang</a>     
                </div>
            </div>
           
            <!-- datatable -->
            <div class="table-responsive pad-tb-5">
            <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>ID_barang</th>
                        <th>Nama_Barang</th>
                        <th>Harga Beli</th>
                        <th>Harga Barang</th>
                        <th>Stok</th>
                        <th>Id_kategori</th>
                        <th>Time_Create</th>
                        <th>Time_update</th>
                        <th class="text-center"><i class="fa fa-cog"></i></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $statement = $conn->prepare("SELECT id_barang,nama_barang,harga_beli,harga_barang,stok,nama_kategori,barang.time_create,barang.time_update FROM barang INNER JOIN kategori ON barang.id_kategori=kategori.id_kategori");
                        $statement->execute();    
                        $data_barang = $statement->fetchAll(PDO::FETCH_OBJ);

                        // $database->setTable('barang');
                        // $data_barang = $database->select()->all();
                        foreach($data_barang as $barang){ ?>
                            <tr>
                                <td> <?php echo $barang->id_barang;?> </td>
                                <td> <?php echo $barang->nama_barang;?> </td>
                                <td align="right"> <?php echo 'Rp '.trim(number_format($barang->harga_beli,0,',','.'));?> </td>    
                                <td align="right"> <?php echo 'Rp '.trim(number_format($barang->harga_barang,0,',','.'));?> </td>    
                                <td align="center"> <?php echo $barang->stok;?> </td>    
                                <td> <?php echo $barang->nama_kategori;?> </td>    
                                <td> <?php echo $barang->time_create;?> </td>
                                <td> <?php echo $barang->time_update;?> </td>
                                <td class="text-center">
                                    <a id="edit" data-toggle="modal" data-target="#editData" data-idbarang="<?php echo $barang->id_barang;?>" data-namabarang="<?php echo $barang->nama_barang;?>" data-hargabeli="<?php echo $barang->harga_beli;?>" data-hargabarang="<?php echo $barang->harga_barang;?>" data-stok="<?php echo $barang->stok;?>" data-idkategori="<?php echo $barang->id_kategori;?>" class="btn btn-warning btn-sm">
                                        <i class="fa fa-pencil-square-o" data-toggle="tooltip" data-placement="top" title="Edit"></i>
                                    </a>
                                    <a id="del" data-toggle="modal" data-target="#delData" data-id="<?php echo $barang->id_barang;?>" data-bantu="<?php echo $barang->nama_barang;?>" class="btn btn-danger btn-sm"><i class="fa fa-trash-o" data-toggle="tooltip" data-placement="top" title="Hapus" style="color:white"></i></a> 
                                </td>   
                            </tr>
                        <?php }
                    ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th>ID_barang</th>
                        <th>Nama_Barang</th>
                        <th>Harga Beli</th>
                        <th>Harga Barang</th>
                        <th>Stok</th>
                        <th>Id_kategori</th>
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
                            "targets": 8
                        }],
                        "order": [[ 6, 'desc' ]]
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
                                <label for="validationCustom01">ID Barang</label>                    
                                <!-- include id-uniq -->
                                <input type="text" name="id_barang" class="form-control" value="<?php echo get_uuid('103-',5); ?>" id="validationCustom01" required readonly>
                                <div class="invalid-feedback">
                                    ID Barang belum di isi.
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="validationCustom02">Nama Barang</label>
                                <input type="text" name="nama_barang" class="form-control" id="validationCustom02" required>
                                <div class="invalid-feedback">
                                    Nama Barang belum di isi.
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="validationCustom03">Harga Beli</label>
                                <input type="text" name="harga_beli" class="form-control" id="validationCustom03" pattern="[0-9]+" required>
                                <div class="invalid-feedback">
                                    Harga Beli Harus di isi dengan Angka.
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="validationCustom03">Harga Barang</label>
                                <input type="text" name="harga_barang" class="form-control" id="validationCustom03" pattern="[0-9]+" required>
                                <div class="invalid-feedback">
                                    Harga Barang Harus di isi dengan Angka.
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="validationCustom05">Stok</label>
                                <input type="number" name="stok" class="form-control" id="validationCustom05" pattern="[0-9]+" required>
                                <div class="invalid-feedback">
                                    Stok Barang Harus di isi dengan Angka.
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="validationCustom04">ID_kategori</label>
                                <select class="custom-select" name="id_kategori" id="inputGroupSelect01">
                                    <!-- get data to t_jabatan -->
                                    <?php
                                        $database->setTable('kategori');
                                        $data_kategori = $database->select()->all(); 
                                        
                                        foreach($data_kategori as $kategori){ ?>
                                            <option selected value="<?php echo $kategori->id_kategori;?>"><?php echo $kategori->nama_kategori;?></option>                                        
                                        <?php } 
                                    ?>
                                </select>
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
        $id_barang      = trim(mysqli_real_escape_string($con,$_POST['id_barang']));
        $nama_barang    = trim(mysqli_escape_string($con,$_POST['nama_barang']));
        $harga_beli     = trim(mysqli_escape_string($con,$_POST['harga_beli']));
        $harga_barang   = trim(mysqli_escape_string($con,$_POST['harga_barang']));
        $stok           = trim(mysqli_escape_string($con,$_POST['stok']));
        $id_kategori    = trim(mysqli_escape_string($con,$_POST['id_kategori']));
        $time_create    = date("Y-m-d H:i:s");
        $time_update    = date("Y-m-d H:i:s");

        $createData = Database::getInstance($server, $user, $pass, $db_name);
        $createData->setTable('barang');
        $createData->create([
            'id_barang'   => $id_barang,
            'nama_barang' => $nama_barang,
            'harga_beli'  => $harga_beli,
            'harga_barang'=> $harga_barang,
            'stok'        => $stok,
            'id_kategori' => $id_kategori,
            'time_create' => $time_create,
            'time_update' => $time_update,
        ]); 
       
        if($createData){ ?> 
            <script>
                mess_success("Data <?php echo " $nama_barang "?> Berhasil Di Tambahkan","?page=barang"); 
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
                                    <label for="id_barang">ID Barang</label>
                                    <input type="text" id="id_barang" name="id_barang" class="form-control" required readonly>                                    
                                </div>
                                <div class="form-group">
                                    <label for="nama_barang">Nama Barang</label>
                                    <input type="text" id="nama_barang" name="nama_barang" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="harga_beli">Harga Beli</label>
                                    <input type="text" id="harga_beli" name="harga_beli" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="harga_barang">Harga Barang</label>
                                    <input type="text" id="harga_barang" name="harga_barang" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="stok">Stok</label>
                                    <input type="number" id="stok" name="stok" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="id_kategori">ID Kategori</label>
                                    <select class="custom-select" id="id_kategori" name="id_kategori" >
                                        <?php
                                            $database->setTable('kategori');
                                            $data_kategori = $database->select()->all(); 
                                            
                                            foreach($data_kategori as $kategori){ ?>
                                                <option value="<?php echo $kategori->id_kategori;?>"><?php echo $kategori->nama_kategori;?></option>                                                                               
                                            <?php } 
                                        ?>
                                    </select>
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
        var idbarang    = $(this).data('idbarang');
        var namabarang  = $(this).data('namabarang');
        var hargabeli   = $(this).data('hargabeli');
        var hargabarang = $(this).data('hargabarang');
        var stok        = $(this).data('stok');
        var idkategori  = $(this).data('idkategori');
        $("#modal_edit #id_barang").val(idbarang);
        $("#modal_edit #nama_barang").val(namabarang);
        $("#modal_edit #harga_beli").val(hargabeli);
        $("#modal_edit #harga_barang").val(hargabarang);
        $("#modal_edit #stok").val(stok);
        $("#modal_edit #id_kategori").val(idkategori);
    })
</script>

<!-- proses edit data -->
<?php
    if(isset($_POST['edit'])){
        $id_barang     = trim(mysqli_real_escape_string($con,$_POST['id_barang']));
        $nama_barang   = trim(mysqli_escape_string($con,$_POST['nama_barang']));
        $harga_beli    = trim(mysqli_escape_string($con,$_POST['harga_beli']));
        $harga_barang  = trim(mysqli_escape_string($con,$_POST['harga_barang']));
        $stok          = trim(mysqli_escape_string($con,$_POST['stok']));
        $id_kategori   = trim(mysqli_escape_string($con,$_POST['id_kategori']));
        $time_update   = date("Y-m-d H:i:s");
      
        $editData = Database::getInstance($server, $user, $pass, $db_name);
        $editData->setTable('barang');
        $editData->where('id_barang', '=', $id_barang)->update([
            'nama_barang' => $nama_barang,
            'harga_beli'  => $harga_beli,
            'harga_barang'=> $harga_barang,
            'stok'        => $stok,
            'id_kategori' => $id_kategori,
            'time_update' => $time_update,            
        ]);

        if($editData){ ?> 
            <script>
                mess_success("Data <?php echo " $id_barang "?> Berhasil Di ubah","?page=barang"); 
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
                        <input type="hidden" id="id_barang" name="id_barang" class="form-control" required readonly>  
                        <span> Apakah Anda yakin ingin menghapus data ini !!! </span><br>
                        <span> ID Barang -> <input type="text" id="view_id" class="btn-default" style="border:none;" readonly> </span><br>
                        <span> nama Barang -> <input type="text" id="view_bantu" class="btn-default" style="border:none; width:200px" readonly> </span>
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
        $("#modal_del #id_barang").val(id);
        $("#modal_del #view_id").val(id);
        $("#modal_del #view_bantu").val(bantu);
    })
</script>

<!-- proses delete data -->
<?php
    if(isset($_POST['del'])){
        $id_barang = trim(mysqli_real_escape_string($con,$_POST['id_barang']));
      
        $delData = Database::getInstance($server, $user, $pass, $db_name);
        $delData->setTable('barang');
        $delData->where('id_barang', '=', $id_barang)->delete();

        if($delData){ ?> 
            <script>
                mess_success("Data <?php echo " $id_barang "?> Berhasil Di Delete","?page=barang"); 
            </script>
        <?php
        }
    }
?>

<?php 
    $address = "barang.php";
    include_once("_modalCetak.php"); 
?>