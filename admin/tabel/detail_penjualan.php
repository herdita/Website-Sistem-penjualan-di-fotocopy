<div class="container-fluid">
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="index.php">Dashboard</a>
        </li>
        <li class="breadcrumb-item active"> Tabel Detail Penjualan </li>
     </ol>
    <div class="row">
        <div class="col-12">
            <div>
                <span class="font-size-18">Data Detail Penjualan<span>
                <div class="pull-right pad-b-2">
                    <a href=""><i class="fa fa-refresh pad-lr-2"></i></a>
                    <a href="" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#cetakData"><i class="fa fa-print"></i> Cetak Data</a>   
                    <a href="<?=base_url('report/report_excel_detail_penjualan.php')?>" target="_blank" class="btn btn-secondary btn-sm" ><i class="fa fa-print"></i> Export Excel</a>  
                    <a href="" class="btn btn-success btn-sm" data-toggle="modal" data-target="#tambahData"><i class="fa fa-plus"></i> Tambah Detail penjualan</a>     
                </div>
            </div>
           
            <!-- datatable -->
            <div class="table-responsive pad-tb-5">
            <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>ID_Penjualan</th>
                        <th>ID_Barang</th>
                        <th>Quality</th>
                        <th>Total Harga</th>
                        <th>Time_Create</th>
                        <th>Time_update</th>
                        <th class="text-center"><i class="fa fa-cog"></i></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        // $database->setTable('detail_penjualan');
                        // $data_detail_penjualan = $database->select()->all();
                        $statement = $conn->prepare("SELECT * FROM detail_penjualan INNER JOIN barang ON detail_penjualan.id_barang = barang.id_barang");
                        $statement->execute();
                          
                        $data_detail_penjualan = $statement->fetchAll(PDO::FETCH_OBJ);
                        foreach($data_detail_penjualan as $detail_penjualan){ ?>
                            <tr>
                                <td> <?php echo $detail_penjualan->id_penjualan;?> </td>
                                <td> <?php echo $detail_penjualan->nama_barang;?> </td>    
                                <td> <?php echo $detail_penjualan->qty_penjualan;?> </td>    
                                <td> <?php echo 'Rp '.trim(number_format($detail_penjualan->total_harga_penjualan,0,',','.'));?> </td>    
                                <td> <?php echo $detail_penjualan->time_create;?> </td>
                                <td> <?php echo $detail_penjualan->time_update;?> </td>
                                <td class="text-center">
                                    <a id="edit" data-toggle="modal" data-target="#editData" data-idpenjualan="<?php echo $detail_penjualan->id_penjualan;?>" data-idbarang="<?php echo $detail_penjualan->id_barang;?>" data-qtypenjualan="<?php echo $detail_penjualan->qty_penjualan;?>" data-totalhargapenjualan="<?php echo $detail_penjualan->total_harga_penjualan;?>" class="btn btn-warning btn-sm">
                                        <i class="fa fa-pencil-square-o" data-toggle="tooltip" data-placement="top" title="Edit"></i>
                                    </a>
                                    <a id="del" data-toggle="modal" data-target="#delData" data-id="<?php echo $detail_penjualan->id_penjualan;?>" data-bantu="<?php echo $detail_penjualan->id_barang;?>" class="btn btn-danger btn-sm"><i class="fa fa-trash-o" data-toggle="tooltip" data-placement="top" title="Hapus" style="color:white"></i></a> 
                                </td>   
                            </tr>
                        <?php }
                    ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th>ID_Penjualan</th>
                        <th>ID_Barang</th>
                        <th>Quality</th>
                        <th>Total Harga</th>
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
                            "targets": 6
                        }],
                        "order": [[ 4, 'desc' ]]
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
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Detail Penjualan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- content -->    
                    <div class="row justify-content-md-center">
                        <div class="col-md-12 mb-3 ">
                            <div class="form-group">
                                <label for="validationCustom01">ID Penjualan</label>                    
                                <!-- include id-uniq -->
                                <select class="custom-select" name="id_penjualan" id="inputGroupSelect01">
                                    <!-- get data to t_jabatan -->
                                    <?php
                                        $database->setTable('penjualan');
                                        $data_penjualan = $database->select()->all();    
                                        foreach($data_penjualan as $penjualan){ ?>
                                            <option selected value="<?php echo $penjualan->id_penjualan;?>"><?php echo $penjualan->id_penjualan;?></option>                                        
                                        <?php } 
                                    ?>
                                </select>
                                <div class="invalid-feedback">
                                    ID penjualan belum di isi.
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="validationCustom02">ID Barang</label>
                                <select class="custom-select" name="id_barang" id="inputGroupSelect01">
                                    <!-- get data to t_jabatan -->
                                    <?php
                                        $database->setTable('barang');
                                        $data_barang = $database->select()->all();    
                                        foreach($data_barang as $barang){ ?>
                                            <option selected value="<?php echo $barang->id_barang;?>"><?php echo $barang->nama_barang;?></option>                                        
                                        <?php } 
                                    ?>
                                </select>
                                <div class="invalid-feedback">
                                    ID Barang belum di isi.
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="validationCustom03">Quality</label>
                                <input type="number" name="qty_penjualan" class="form-control" id="validationCustom03" pattern="[0-9]+" required>
                                <div class="invalid-feedback">
                                    Quality penjualan Harus Di isi dengan Angka.
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="validationCustom03">Total Harga</label>
                                <input type="number" name="total_harga_penjualan" class="form-control" id="validationCustom03" pattern="[0-9]+" required>
                                <div class="invalid-feedback">
                                    Total harga Harus Di isi dengan Angka.
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
        $id_penjualan           = trim(mysqli_real_escape_string($con,$_POST['id_penjualan']));
        $id_barang              = trim(mysqli_escape_string($con,$_POST['id_barang']));
        $qty_penjualan          = trim(mysqli_escape_string($con,$_POST['qty_penjualan']));
        $total_harga_penjualan  = trim(mysqli_escape_string($con,$_POST['total_harga_penjualan']));
        $time_create            = date("Y-m-d H:i:s");
        $time_update            = date("Y-m-d H:i:s");

        $createData = Database::getInstance($server, $user, $pass, $db_name);
        $createData->setTable('detail_penjualan');
        $createData->create([
            'id_penjualan'          => $id_penjualan,
            'id_barang'             => $id_barang,
            'qty_penjualan'         => $qty_penjualan,
            'total_harga_penjualan' => $total_harga_penjualan,
            'time_create'           => $time_create,
            'time_update'           => $time_update,
        ]); 
       
        if($createData){ ?> 
            <script>
                mess_success("Data <?php echo " $id_penjualan "?> Berhasil Di Tambahkan","?page=detail_penjualan"); 
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
                                    <label for="id_penjualan">ID Penjualan</label>
                                    <input type="text" id="id_penjualan" name="id_penjualan" class="form-control" required readonly>
                                </select>                                    
                                </div>
                                <div class="form-group">
                                    <label for="id_barang">ID Barang</label>
                                    <input type="text" id="id_barang" name="id_barang" class="form-control" required readonly>
                                </div>
                                <div class="form-group">
                                    <label for="qty_penjualan">Quality</label>
                                    <input type="number" id="qty_penjualan" name="qty_penjualan" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="total_harga_penjualan">Total Harga</label>
                                    <input type="text" id="total_harga_penjualan" name="total_harga_penjualan" class="form-control" required>
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
        var idpenjualan = $(this).data('idpenjualan');
        var idbarang = $(this).data('idbarang');
        var qtypenjualan = $(this).data('qtypenjualan');
        var totalhargapenjualan = $(this).data('totalhargapenjualan');
        $("#modal_edit #id_penjualan").val(idpenjualan);
        $("#modal_edit #id_barang").val(idbarang);
        $("#modal_edit #qty_penjualan").val(qtypenjualan);
        $("#modal_edit #total_harga_penjualan").val(totalhargapenjualan);
    })
</script>

<!-- proses edit data -->
<?php
    if(isset($_POST['edit'])){
        $id_penjualan           = trim(mysqli_real_escape_string($con,$_POST['id_penjualan']));
        $id_barang              = trim(mysqli_escape_string($con,$_POST['id_barang']));
        $qty_penjualan          = trim(mysqli_escape_string($con,$_POST['qty_penjualan']));
        $total_harga_penjualan  = trim(mysqli_escape_string($con,$_POST['total_harga_penjualan']));
        $time_update            = date("Y-m-d H:i:s");
      
        $editData = Database::getInstance($server, $user, $pass, $db_name);
        $editData->setTable('detail_penjualan');
        $editData->where('id_penjualan', '=', $id_penjualan)->where('id_barang','=',$id_barang)->update([
            'qty_penjualan'               => $qty_penjualan,
            'total_harga_penjualan'        => $total_harga_penjualan,
            'time_update'                 => $time_update,            
        ]);

        if($editData){ ?> 
            <script>
                mess_success("Data <?php echo " $id_penjualan "?> Berhasil Di ubah","?page=detail_penjualan"); 
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
                        <input type="hidden" id="id_penjualan" name="id_penjualan" class="form-control" required readonly>  
                        <span> Apakah Anda yakin ingin menghapus data ini !!! </span><br>
                        <span> ID Penjualan -> <input type="text" id="view_id" class="btn-default" style="border:none;" readonly> </span><br>
                        <span> ID Barang -> <input type="text" id="view_bantu" class="btn-default" style="border:none; width:200px" readonly> </span>
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
        $("#modal_del #id_penjualan").val(id);
        $("#modal_del #view_id").val(id);
        $("#modal_del #view_bantu").val(bantu);
    })
</script>

<!-- proses delete data -->
<?php
    if(isset($_POST['del'])){
        $id_penjualan = trim(mysqli_real_escape_string($con,$_POST['id_penjualan']));
      
        $delData = Database::getInstance($server, $user, $pass, $db_name);
        $delData->setTable('detail_penjualan');
        $delData->where('id_penjualan','=', $id_penjualan)->delete();

        if($delData){ ?> 
            <script>
                mess_success("Data <?php echo " $id_penjualan "?> Berhasil Di Delete","?page=detail_penjualan"); 
            </script>
        <?php
        }
    }
?>

<?php 
    $address = "detail_penjualan.php";
    include_once("_modalCetak.php"); 
?>