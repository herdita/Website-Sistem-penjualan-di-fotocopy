<div class="container-fluid">
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="index.php">Dashboard</a>
        </li>
    </ol>

    <div class="row">
        <div class="col-xs-12 col-md-6 col-lg-6 col-xl-3">
                <div class="card-box noradius noborder bg-info pad-3" id="jumlah_produk" style="cursor: pointer;">
                    <i class="fa fa-file-text-o float-right text-white" style="font-size:350%"></i>
                    <h6 class="text-white text-uppercase m-b-20">jumlah Produk</h6>
                    <?php
                        $result = $conn->query("SELECT SUM(stok) AS jumlah_stok FROM barang");
                        $sum_stok = $result->fetch(PDO::FETCH_OBJ);
                    ?>
                    <h1 class="m-b-20 text-white counter"><?php echo "$sum_stok->jumlah_stok"; ?></h1>
                    <span class="text-white">Bertambah 15 stok baru</span>
                </div>
        </div>
        <div class="col-xs-12 col-md-6 col-lg-6 col-xl-3">
                <div class="card-box noradius noborder bg-warning pad-3" style="cursor: pointer;">
                    <i class="fa fa-bar-chart float-right text-white" style="font-size:350%"></i>
                    <?php
                        $result_qty = $conn->query("SELECT SUM(qty_penjualan) AS jumlah_qty FROM detail_penjualan");
                        $sum_qty = $result_qty->fetch(PDO::FETCH_OBJ);
                    ?>
                    <h6 class="text-white text-uppercase m-b-20">Produk Terjual</h6>
                    <h1 class="m-b-20 text-white counter"><?php echo "$sum_qty->jumlah_qty"?></h1>
                    <span class="text-white">Hari Ini </span>
                </div>
        </div>
        <div class="col-xs-12 col-md-6 col-lg-6 col-xl-3">
                <div class="card-box noradius noborder bg-danger pad-3" id="jumlah_pegawai" style="cursor: pointer;">
                    <i class="fa fa-user-o float-right text-white" style="font-size:350%"></i>
                    <h6 class="text-white text-uppercase m-b-20">Karyawan</h6>
                    <?php
                        $result = $conn->query("SELECT COUNT(id_pegawai) AS jumlah_pegawai FROM pegawai");
                        $count_pegawai = $result->fetch(PDO::FETCH_OBJ);
                    ?>
                    <h1 class="m-b-20 text-white counter"><?php echo "$count_pegawai->jumlah_pegawai"; ?></h1>
                    <span class="text-white">&nbsp</span>
                </div>
        </div>
        <div class="col-xs-12 col-md-6 col-lg-6 col-xl-3">
                <div class="card-box noradius noborder bg-success pad-3" style="cursor: pointer;">
                    <i class="fa fa-money float-right text-white" style="font-size:350%"></i>
                    <h6 class="text-white text-uppercase m-b-20">Keuntungan</h6>
                    <h1 class="m-b-20 text-white counter">0</h1>
                    <span class="text-white">Minggu ini</span>
                </div>
        </div>
    </div><br>
    <!-- end row -->
    
    <!-- stok produk -->
    <div id="produk" style="display:none;">   
        <?php include("chartgrafik/stok_grafik.php") ?> 
    </div>

    <!-- pegawai -->
    <div id="pegawai" style="display:none;">
        <h3 class="pad-b-1"><small>Karyawan</small></h3>
        <div class="row">
            <?php
                $statement = $conn->prepare("SELECT * FROM pegawai INNER JOIN jabatan ON pegawai.id_jabatan=jabatan.id_jabatan");
                $statement->execute();    
                $data_pegawai = $statement->fetchAll(PDO::FETCH_OBJ);
                foreach($data_pegawai as $pegawai){ 
            ?>
            <div class="col-6 col-md-4 col-lg-4 col-xl-3">
                <div class="card bg-light mb-3" style="max-width: 18rem;">
                    <div class="card-header"><?php echo "$pegawai->nama_p ($pegawai->nama_jabatan)";?></div>
                    <div class="card-body">
                        <p class="card-text">ID Pegawai : <?php echo $pegawai->id_pegawai;?></p>
                        <p class="card-text">Username   : <?php echo $pegawai->username;?></p>                    
                    </div>
                </div>
            </div>
            <?php }; ?>
        </div>
    </div>

    
    <!-- _jquery show produk -->
    <script>
        $(document).ready(function(){
            $("#jumlah_produk" ).click(function() {
                $("#produk" ).toggle("slow","swing");
                $("#pegawai" ).hide();
            });        
        });
    </script>

    <!-- _jquery show pegawai -->
    <script>
        $(document).ready(function(){
            $("#jumlah_pegawai" ).click(function() {
                $("#pegawai" ).toggle("slow","swing");
                $("#produk" ).hide();
            });        
        });
    </script>
</div>