<script src="<?=base_url('admin/transaksi_penjualan/_jquery.min.js')?>"></script>
<script src="<?=base_url('admin/transaksi_penjualan/_typeahead.min.js')?>"></script>
<style>
    .focus-off:focus{
        box-shadow: 0px 0px;
    }
</style>
<div class="container-fluid">
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="index.php">Dashboard</a>
        </li>
        <li class="breadcrumb-item active"> Teransaksi Penjualan </li>
    </ol><br>
 
    <div class="form-group">  
        <form name="add_" id="add_">  
            <div class="table-responsive">  
                <table>
                    <tr>
                        <td> 
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text" style="background:#d1ecf1">Nota :</div>
                                </div>
                                <input type="text" name="id_penjualan" value="<?php echo get_uuid('106-',8); ?>" class="form-control" style="width:200px;"/ readonly>      
                            </div>
                        </td>
                        <?php
                            $username_account = $_SESSION['user'];
                            $user = Database::getInstance($server, $user, $pass, $db_name); $user->setTable('pegawai');
                            $username = $user->select()->where('username','=',$username_account)->all();
                            foreach($username as $us){ ?>
                                <td class="pad-lr-4">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text" style="background:#d1ecf1">Pegawai :</div>
                                        </div>
                                        <input type="text" name="pegawai" value="<?php echo "$us->nama_p"; ?>" class="form-control name_list" style="width:200px;" readonly  />
                                    </div>
                                </td>       
                            <?php
                            }
                        ?>
                    </tr>
                </table> <br>

                <table class="table table-bordered" id="dynamic_field">
                    <tr style="background:#dfe4ea">
                        <th>Nama Barang</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Sub Total</th>
                        <th class="text-center"><i class="fa fa-cog"></i></th>
                    </tr>  
                    <tr>         
                        <td> <input type="text" name="nama_barang[]" id="nama_barang" ids=1 class="form-control name_list" autocomplete="off" required/> </td>
                        <td> <input type="text" name="harga[]" id="harga1" class="form-control name_list" readonly required/></td>  
                        <td> <input type="number" name="qualty[]" id="qualty1" idq=1 class="qualty form-control name_list" required/></td>  
                        <td> <input type="number" name="sub_total[]" id="sub_total1" value=0 idt=1 class="sub_total form-control name_list" readonly required/></td>  
                        <td> <button type="button" name="add" id="add" class="btn btn-success">Add More</button></td>  
                    </tr>  
                </table>

                <!-- alert --><br>
                <div class="alert alert-info" role="alert">
                    <div class="input-group d-flex flex-row-reverse">
                        <input type="text" name="total_harga" class="" value=0 id="total_harga" style="width:130px; background-color:transparent; border:none; font-size:18px" readonly required>
                        <div class="input-group-prepend">
                            <div class="input-group-text" style="background-color:transparent; border:none; color:black; font-size:18px">Total Harga : Rp. </div>
                        </div>
                    </div>
                </div>
    
                <!-- form keterangan -->
                <div class="d-flex flex-row flex-lg-row flex-column">
                    <div style="width:400px">
                        <div class="form-group">
                            <textarea class="form-control focus-off" name="keterangan" id="keterangan" rows="3" placeholder="Catatan Transaksi (jika ada)"></textarea>
                        </div>
                    </div>
                    <div class="ml-auto">
                        <div class="d-flex flex-column">
                            <div class="input-group mb-3" style="margin-bottom: 10px !important">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" style="background:#d1ecf1; border:0px">Bayar &nbsp &nbsp &nbsp &nbsp</span>
                                </div>
                                <input type="text" id="bayar" class="form-control focus-off" aria-label="Default" style="border:1px solid #d1ecf1">
                            </div>   
                            <div class="input-group mb-3" style="margin-bottom: 10px !important">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" style="background:#d1ecf1; border:0px">Kembalian</span>
                                </div>
                                <input type="text" class="form-control" id="kembalian" aria-label="Default" style="border:1px solid #d1ecf1" readonly>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- submit -->
                <br>
                <div class="pull-right pad-b-2">
                    <!-- <input type="button" name="print" id="print" class="btn btn-md btn-warning" value="Cetak"  style="border-radius:0px; font-size:18px; width:100px;" /> -->
                    <input type="submit" name="submit" id="submit" class="btn btn-md btn-info" value="Simpan"  style="border-radius:0px; font-size:18px; width:100px;" />
                </div>
            </div>  
        </form>  
    </div>

    <!-- <script>
        $(document).ready(function(){
            $(".qualty").prop("disabled", true);
        });
    </script> -->

    <!-- form nama barang search -->
    <script>
    $(document).ready(function() {
        }).on('focus','#nama_barang',function(){
            $(this).typeahead({
                source: function(query, result) {
                    $.ajax({
                        url: "<?=base_url('admin/transaksi_penjualan/fetch.php')?>",
                        method: "POST",
                        data: {
                            query: query
                        },
                        dataType: "json",
                        success: function(data) {
                            result($.map(data, function(item) {
                                return item;
                            }));
                        }
                    })
                }
            });
        });
    </script>

    <!-- function total_Harga -->
    <script>
        function total_harga(){
            var id = sessionStorage.getItem('jml_record');
            value = parseInt(0);
            for (let i = 1; i <= id; i++){   
                if($('#sub_total'+i).val()){
                    value = parseInt($('#sub_total'+i).val()) + value;
                }
            }
            // $('#total_harga').val(value.toLocaleString(['ban', 'id']));
            $('#total_harga').val(value);

            // console.log('id '+id);
        }
    </script>

    <!-- form harga -->
    <script>
        $(document).ready(function(){
            $(document).on('change','#nama_barang',function(){
                var id = $(this).attr("ids");
                $.ajax({
                    url:'<?=base_url('admin/transaksi_penjualan/service_harga.php?nama=')?>'+$(this).val(),
                    type:'GET',
                }).done(function(data){
                    var data = JSON.parse(data);
                    // console.log(data);
                    if(data==null){
                        $("#qualty"+id).val("");
                        $("#harga"+id).val("");
                        $("#sub_total"+id).val(0);
                        $(document).ready(function(){
                            total_harga();
                        })          
                    }else{
                        $("#harga"+id).val(data["harga_barang"]);
                        var harga = $('#harga'+id).val() 
                        var qualty = $('#qualty'+id).val();
                        $("#sub_total"+id).val(harga * qualty);
                        $(document).ready(function(){
                            total_harga()
                        })
                    }        
                })
            })
        });
    </script>

    <!-- form jumlah stok -->
    <script>
        $(document).ready(function(){
            $(document).on('change','#nama_barang',function(){
                var id = $(this).attr("ids");
                $.ajax({
                    url:'<?=base_url('admin/transaksi_penjualan/service_stok.php?nama=')?>'+$(this).val(),
                    type:'GET',
                }).done(function(data){
                    var data = JSON.parse(data);
                    sessionStorage.setItem('stok'+id, parseInt(data["stok"]));
                })
            });  
        });
    </script>

    <!-- form qualty -->
    <script>
        $(document).ready(function(){
            $(document).on('change','.qualty',function(){
                var id = $(this).attr("idq");
                var harga = $('#harga'+id).val() 
                var qualty = parseInt($(this).val());
                if(qualty > sessionStorage.getItem('stok'+id)){
                    swal({
                    title:"Opps!!",
                    text: "Jumlah Stok Melebihi quota !!! sisa stok "+sessionStorage.getItem('stok'+id),
                    icon: "warning",
                    timer: 3000,
                    });
                }else{
                    $("#sub_total"+id).val(harga * qualty);
                }  
            })
        });
    </script>

    <!-- form total harga -->
    <script>
        $(document).ready(function(){
            $(document).on('change','.qualty',function(){
                total_harga()
            })          
        });
    </script>

     <!-- form Pembayaran -->
     <script>
        $(document).ready(function(){
            $(document).on('change','#bayar',function(){
                var total_harga = $('#total_harga').val();
                $('#kembalian').val( parseInt($(this).val()) - parseInt(total_harga));
            })          
        });
    </script>

    <!-- form add -->
    <script>  
        $(document).ready(function(){
            sessionStorage.setItem('jml_record', 1);  
            var i=1;  
            $('#add').click(function(){
                i++;  
                sessionStorage.setItem('jml_record', i);
                $('#dynamic_field').append(`<tr id="row${i}">
                <td><input type="text" name="nama_barang[]" id="nama_barang" ids=${i} class="form-control name_list" autocomplete="off" required /></td>
                <td width="180px"><input type="text" name="harga[]" id="harga${i}" class="form-control name_list" readonly required /></td>
                <td width="120px"><input type="number" name="qualty[]" id="qualty${i}" idq=${i} class="qualty form-control name_list" required /></td>
                <td width="180px"><input type="number" name="sub_total[]" id="sub_total${i}" idt=${i} value="0" class="sub_total form-control name_list" readonly required /></td>;
                <td><button type="button" name="remove" id="${i}" class="btn btn-danger btn_remove">X</button></td>
                </tr>`);
                // $("#qualty"+sessionStorage.getItem('jml_record')).prop("disabled", true);
            });  
            $(document).on('click', '.btn_remove', function(){
                // var jml_record = sessionStorage.getItem('jml_record');
                // sessionStorage.setItem('jml_record', jml_record-1);
                var button_id = $(this).attr("id");   
                $('#row'+button_id+'').remove();
                $(document).ready(function(){
                    total_harga()
                })
            });  
            $('#submit').click(function(){  
                // console.log($('#nama_barang').val());    
                var jml = sessionStorage.getItem('jml_record');
                for (i = 1; i <= jml; i++){
                    
                    if($('#nama_barang').val() != "" && $('#qualty'+jml).val() != ""){
                        if($('#harga'+i).val() != "" && $('#sub_total'+i).val() > 0 ){
                            $.ajax({  
                                url: '<?=base_url('admin/transaksi_penjualan/insert.php')?>',  
                                method:"POST",  
                                data:$('#add_').serialize(),  
                                success:function(data) {  
                                    // alert(data);
                                    mess_success("Data Berhasil Dimasukan","transaksi_penjualan.php");
                                    window.location.href = "?page=transaksi_penjualan";  
                                    // $('#add_')[0].reset();  
                                }                     
                            });
                        }else{
                            mess_warning("Ada Produk atau jumlah pembelian yang di masukan tidak sesuai", "transaksi_penjualan.php");                            
                        }                           
                    }    
                } 
            });  
        });  
    </script> 

    <!-- session clear -->
    <script>
        $(window).bind('beforeunload',function(){
            sessionStorage.clear();
        });
    </script>

</div>

