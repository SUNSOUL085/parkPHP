<?php
include 'header.php';
if(!isset($_SESSION['online'])){
    header('Location: login.php');
} else {
    include 'head_index.php'; ?>
            <!-- Start XP Breadcrumbbar -->                    
            <div class="xp-breadcrumbbar">
                <div class="row">
                    <div class="col-md-6 col-lg-6">
                        <h4 class="xp-page-title">Kelola Parkir</h4>
                    </div>
                    <div class="col-md-6 col-lg-6">
                        <div class="xp-breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:;"><i class="icon-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="javascript:;">Halaman</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Parkir</li>
                            </ol>
                        </div>
                    </div>
                </div>          
            </div>
            <!-- End XP Breadcrumbbar -->


        <!-- Start XP Contentbar -->    
        <div class="xp-contentbar">
            <!-- Write page content code here -->

            <!-- Start XP Row -->    
            <div class="row">
        <?php
            if(isset($_GET['id']) && $_GET['go'] == 'masuk' && $_GET['aksi'] == 'edit') {
                $id = $_GET['id'];
                $go = $_GET['go'];
                $waktu = date('h:i:s');
                
                $sql = "UPDATE parkirin SET aksi='keluar', waktu_kel='$waktu' WHERE id_par='$id'";
                $exe = $conn->query($sql);
                if($exe == TRUE){ 
                    exit();?>
                    <script>alert("Anda berhasil Mengupdate Data"); "</script>
                    
                <?php
                    
                } else {
                    echo '<script>alert("Data Gagal Diupdate!"); window.location.assign("parkir.php");</script>';
                    exit();
                }
            } else if(isset($_POST['add'])) {
                $id = $_POST['id'];
                $nopol = $_POST['nopol'];
                $status;
                $waktu = date('h:i:s');
                $ck_member = "SELECT * FROM member WHERE no_pol='$nopol' AND status='aktif'";
                $query_member = $conn->query($ck_member);
                $member = $query_member->fetch_assoc();
                if($query_member->num_rows > 0){
                    $status = "member";
                }else $status = "nonmember";

                $sql = "INSERT INTO parkirin (id_par,no_pol,status,waktu_mas,waktu_kel,aksi) VALUES ('$id','$nopol','$status','$waktu',NULL,'masuk')";
                $exe = $conn->query($sql);
                if($exe == TRUE){
                    echo '<script>alert("Anda berhasil Membuat Data Baru"); window.location.assign("parkir.php");</script>';
                    exit();
                } else {
                    echo '<script>alert("Data Gagal Dibuat!"); window.location.assign("parkir.php");</script>';
                    exit();
                }
            } else if(isset($_GET['id']) && $_GET['aksi'] == 'hapus'){
                $id = $_GET['id'];
                $sql = "DELETE FROM parkirin WHERE id_par='$id'";
                $exe = $conn->query($sql);
                    if($exe == TRUE){
                        echo '<script>alert("Anda berhasil Menghapus Data"); window.location.assign("parkir.php");</script>';
                        exit();
                    } else {
                        echo '<script>alert("Data Gagal Dihapus!"); window.location.assign("parkir.php");</script>';
                        exit();
                    }
            } else {
    if(isset($_GET['aksi']) || isset($_GET['id'])){
        if($_GET['aksi'] == 'tambah'){ 
            function randomString(){
                $characters = '0123456789ab';
                $randomString = '';
                for ($i = 0; $i < 5; $i++) {
                    $index = rand(0, strlen($characters) - 1);
                    $randomString .= $characters[$index];
                }
                return $randomString;
            }
            
            
            function id_tkt_otomatis(){
                return "TKT". randomString();
            }
            ?>
            <!-- Start XP Col -->
                <div class="col-lg-12">
                    <div class="card m-b-30">
                        <div class="card-header bg-white">
                            <h5 class="card-title text-black">Input Parkiran</h5>
                            <h6 class="card-subtitle">Form untuk menambahkan data parkiran baru</h6>
                        </div>
                        <div class="card-body">
                        <form action="?" method="POST">
                            <div class="form-group">
                                <input type="text" class="form-control" name="id" placeholder="ID Parkir" value='<?=id_tkt_otomatis()?>' readonly>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="nopol" placeholder="No Pol">
                            </div>
                            
                            
                            <div class="form-group">
                                <button class="btn btn-outline-dark col align-self-end" type="submit" name="add">Submit</button>
                            </div>
                        </form>
                        </div>
                    </div>
                </div>
                <!-- End XP Col -->
<?php
} else {
                echo '<script>alert("Aksi Tidak dikenali, Tolong jangan bercanda"); window.location.assign("parkir.php");</script>';
                exit();
}
    } else {
?>

                <!-- Start XP Col -->
                <div class="col-lg-12">
                        <div class="card m-b-30">

                            <div class="card-header bg-white">
                                <h5 class="card-title text-black">List Parkiran</h5>
                                <h6 class="card-subtitle">Export data to Copy, CSV, Excel & Note.</h6>
                            </div>

                            <div class="card-body">
                                <div class="table-responsive">
                                        <center><a href="parkir.php?aksi=tambah" type="button" class="btn btn-rounded btn-success"><i class="mdi mdi-plus mr-2"></i> Tambah Data</a></center>
                                    <table id="datatable-buttons" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>ID Parkir</th>
                                                <th>Nomor Polisi</th>
                                                <th>Status</th>
                                                <th>Waktu Masuk</th>
                                                <th>Waktu Keluar</th>
                                                <th>Aksi</th>
                                                <th>Tindakan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            $no = 1;
                                            $sql = "SELECT * FROM parkirin";
                                            $run = $conn->query($sql);
                                            if($run->num_rows >0){
                                            while($row = $run->fetch_assoc()){
                                        ?>
                                            <tr>
                                                <td><?php echo $no++; ?></td>
                                                <td><?php echo $row['id_par']; ?></td>
                                                <td><?php echo $row['no_pol']; ?></td>
                                                <td><?php echo $row['status']; ?></td>
                                                <td><?php echo $row['waktu_mas']; ?></td>
                                                <td><?php echo $row['waktu_kel']; ?></td>
                                                <td>
                                                <?php
                                                if($row['aksi'] == 'masuk'){ ?>
                                                    <a onclick="return confirm('Apakah anda yakin ingin mengizinkan kendaraan ini Keluar?')" href="parkir.php?id=<?php echo $row['id_par']; ?>&go=<?php echo $row['aksi']; ?>&aksi=edit" type="button" class="btn btn-rounded">Keluar</a>
                                                <?php } else { ?>
                                                    Sudah Keluar [ <a href="bayar.php?id=<?php echo $row['id_par']; ?>&go=keluar&aksi=edit" type="button" class="btn btn-rounded">Lihat Invoice</a> ]
                                                <?php } ?>
                                                </td>
                                                <td>
                                                    <a onclick="return confirm('Apakah anda yakin ingin menghapus Data Parkir dengan ID : <?php echo $row['id_par']; ?> ?')" href="parkir.php?id=<?php echo $row['id_par']; ?>&aksi=hapus" type="button" class="btn btn-rounded btn-danger"><i class="mdi mdi-delete-sweep mr-2"></i> Delete</a>
                                                </td>
                                            </tr>
                                        <?php } } else { ?>
                                            <tr>
                                                <td>-</td>
                                                <td>-</td>
                                                <td>-</td>
                                                <td>-</td>
                                                <td>-</td>
                                                <td>-</td>
                                                <td>-</td>
                                                <td>-</td>
                                            </tr>
                                        <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End XP Col -->

            </div>
             <!-- End XP Row -->  

        </div>
        <!-- End XP Contentbar -->
<?php
    include 'foot_index.php'; } } } ?>
<?php
include 'footer.php';
?>