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
                        <h4 class="xp-page-title">Kelola Member</h4>
                    </div>
                    <div class="col-md-6 col-lg-6">
                        <div class="xp-breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:;"><i class="icon-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="javascript:;">Halaman</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Member</li>
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
            if(isset($_POST['edit'])) {
                $id = $_POST['id'];
                $nopol = $_POST['nopol'];
                $jenis = $_POST['jenis'];
                $merekken = $_POST['merekken'];
                $pemilik = $_POST['pemilik'];
                $status = $_POST['status'];

                $sql = "UPDATE member SET no_pol='$nopol', jenis='$jenis', merek_ken='$merekken', pemilik='$pemilik', status='$status' WHERE id_mem='$id'";
                $exe = $conn->query($sql);
                if($exe == TRUE){
                    echo '<script>alert("Anda berhasil Mengupdate Data"); window.location.assign("member.php");</script>';
                    exit();
                } else {
                    echo '<script>alert("Data Gagal Diupdate!"); window.location.assign("member.php");</script>';
                    exit();
                }
            } else if(isset($_POST['add'])) {
                $id = $_POST['id'];
                $nopol = $_POST['nopol'];
                $jenis = $_POST['jenis'];
                $merekken = $_POST['merekken'];
                $pemilik = $_POST['pemilik'];
                $status = $_POST['status'];

                $sql = "INSERT INTO member (id_mem,no_pol,jenis,merek_ken,pemilik,status) VALUES ('$id','$nopol','$jenis','$merekken','$pemilik','$status')";
                $exe = $conn->query($sql);
                if($exe == TRUE){
                    echo '<script>alert("Anda berhasil Membuat Data Baru"); window.location.assign("member.php");</script>';
                    exit();
                } else {
                    echo '<script>alert("Data Gagal Dibuat!"); window.location.assign("member.php");</script>';
                    exit();
                }
            } else if(isset($_GET['id']) && $_GET['aksi'] == 'hapus'){
                $id = $_GET['id'];
                $sql = "DELETE FROM member WHERE id_mem='$id'";
                $exe = $conn->query($sql);
                    if($exe == TRUE){
                        echo '<script>alert("Anda berhasil Menghapus Data"); window.location.assign("member.php");</script>';
                        exit();
                    } else {
                        echo '<script>alert("Data Gagal Dihapus!"); window.location.assign("member.php");</script>';
                        exit();
                    }
            } else {
    if(isset($_GET['aksi']) || isset($_GET['id'])){
        if($_GET['aksi'] == 'tambah'){ ?>
            <!-- Start XP Col -->
                <div class="col-lg-12">
                    <div class="card m-b-30">
                        <div class="card-header bg-white">
                            <h5 class="card-title text-black">Input Member</h5>
                            <h6 class="card-subtitle">Form untuk menambahkan data member baru</h6>
                        </div>
                        <div class="card-body">
                        <form action="?" method="POST">
                            <div class="form-group">
                                <input type="text" class="form-control" name="id" placeholder="ID Member">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="nopol" placeholder="Nomor Polisi">
                            </div>
                            <div class="form-group">
                                <select class="form-control" name="jenis">
                                    <option>Pilih Jenis Kendaraan</option>
                                    <option value="Motor">Motor</option>
                                    <option value="Mobil">Mobil</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="merekken" placeholder="Merek Kendaraan">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="pemilik" placeholder="Pemilik Kendaraan">
                            </div>
                            <div class="form-group">
                                <select class="form-control" name="status">
                                    <option>Pilih Jenis Kendaraan</option>
                                    <option value="aktif">Aktif</option>
                                    <option value="nonaktif">Nonaktif</option>
                                </select>
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
        } else if($_GET['aksi'] == 'edit'){
                $id = $_GET['id'];
                $sql = "SELECT * FROM member WHERE id_mem='$id'";
                $run = $conn->query($sql);

                while($row = $run->fetch_assoc()){ ?>
        <!-- Start XP Col -->
            <div class="col-lg-12">
                <div class="card m-b-30">
                    <div class="card-header bg-white">
                        <h5 class="card-title text-black">Edit Member</h5>
                        <h6 class="card-subtitle">Form untuk mengupdate data member</h6>
                    </div>
                    <div class="card-body">
                    <form action="?" method="POST">
                            <input type="hidden" class="form-control" name="id" value="<?php echo $row['id_mem']; ?>">
                        <div class="form-group">
                            <input type="text" class="form-control" name="nopol" value="<?php echo $row['no_pol']; ?>">
                        </div>
                        <div class="form-group">
                            <select class="form-control" name="jenis">
                                <option value="<?php echo $row['jenis']; ?>" selected><?php echo $row['jenis']; ?> (Selected)</option>
                                <option value="Motor">Motor</option>
                                <option value="Mobil">Mobil</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="merekken" value="<?php echo $row['merek_ken']; ?>">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="pemilik" value="<?php echo $row['pemilik']; ?>">
                        </div>
                        <div class="form-group">
                            <select class="form-control" name="status">
                                <option value="<?php echo $row['status']; ?>" selected><?php echo $row['status']; ?> (Selected)</option>
                                <option value="aktif">Aktif</option>
                                <option value="nonaktif">Nonaktif</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-outline-dark col align-self-end" type="submit" name="edit">Submit</button>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
            <!-- End XP Col -->
<?php
        }
} else {
                echo '<script>alert("Aksi Tidak dikenali, Tolong jangan bercanda"); window.location.assign("member.php");</script>';
                exit();
}
    } else {
?>

                <!-- Start XP Col -->
                <div class="col-lg-12">
                        <div class="card m-b-30">

                            <div class="card-header bg-white">
                                <h5 class="card-title text-black">List Member</h5>
                                <h6 class="card-subtitle">Export data to Copy, CSV, Excel & Note.</h6>
                            </div>

                            <div class="card-body">
                                <div class="table-responsive">
                                        <center><a href="member.php?aksi=tambah" type="button" class="btn btn-rounded btn-success"><i class="mdi mdi-plus mr-2"></i> Tambah Data</a></center>
                                    <table id="datatable-buttons" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>ID Member</th>
                                                <th>Nomor Polisi</th>
                                                <th>Jenis</th>
                                                <th>Merek Kendaraan</th>
                                                <th>Pemilik Kendaraan</th>
                                                <th>Status</th>
                                                <th>Tindakan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            $no = 1;
                                            $sql = "SELECT * FROM member";
                                            $run = $conn->query($sql);
                                            if($run->num_rows >0){
                                            while($row = $run->fetch_assoc()){
                                        ?>
                                            <tr>
                                                <td><?php echo $no++; ?></td>
                                                <td><?php echo $row['id_mem']; ?></td>
                                                <td><?php echo $row['no_pol']; ?></td>
                                                <td><?php echo $row['jenis']; ?></td>
                                                <td><?php echo $row['merek_ken']; ?></td>
                                                <td><?php echo $row['pemilik']; ?></td>
                                                <td><?php echo $row['status']; ?></td>
                                                <td>
                                                    <a href="member.php?id=<?php echo $row['id_mem']; ?>&aksi=edit" type="button" class="btn btn-rounded btn-warning"><i class="mdi mdi-upload mr-2"></i> Update</a>
                                                    <a onclick="return confirm('Apakah anda yakin ingin menghapus Data Member dengan ID : <?php echo $row['id_mem']; ?> ?')" href="member.php?id=<?php echo $row['id_mem']; ?>&aksi=hapus" type="button" class="btn btn-rounded btn-danger"><i class="mdi mdi-delete-sweep mr-2"></i> Delete</a>
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