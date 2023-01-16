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
                        <h4 class="xp-page-title">Kelola Admin</h4>
                    </div>
                    <div class="col-md-6 col-lg-6">
                        <div class="xp-breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:;"><i class="icon-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="javascript:;">Halaman</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Administrator</li>
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
                $password = $_POST['password'];

                $sql = "UPDATE users SET password='$password' WHERE username='$id'";
                $exe = $conn->query($sql);
                if($exe == TRUE){
                    echo '<script>alert("Anda berhasil Mengupdate Data"); window.location.assign("admin.php");</script>';
                    exit();
                } else {
                    echo '<script>alert("Data Gagal Diupdate!"); window.location.assign("admin.php");</script>';
                    exit();
                }
            } else if(isset($_POST['add'])) {
                $id = $_POST['id'];
                $password = $_POST['password'];

                $sql = "INSERT INTO users (username,password) VALUES ('$id','$password')";
                $exe = $conn->query($sql);
                if($exe == TRUE){
                    echo '<script>alert("Anda berhasil Membuat Data Baru"); window.location.assign("admin.php");</script>';
                    exit();
                } else {
                    echo '<script>alert("Data Gagal Dibuat!"); window.location.assign("admin.php");</script>';
                    exit();
                }
            } else if(isset($_GET['id']) && $_GET['aksi'] == 'hapus'){
                $id = $_GET['id'];
                $sql = "DELETE FROM users WHERE username='$id'";
                $exe = $conn->query($sql);
                    if($exe == TRUE){
                        echo '<script>alert("Anda berhasil Menghapus Data"); window.location.assign("admin.php");</script>';
                        exit();
                    } else {
                        echo '<script>alert("Data Gagal Dihapus!"); window.location.assign("admin.php");</script>';
                        exit();
                    }
            } else {
    if(isset($_GET['aksi']) || isset($_GET['id'])){
        if($_GET['aksi'] == 'tambah'){ ?>
            <!-- Start XP Col -->
                <div class="col-lg-12">
                    <div class="card m-b-30">
                        <div class="card-header bg-white">
                            <h5 class="card-title text-black">Input Admin</h5>
                            <h6 class="card-subtitle">Form untuk menambahkan data admin baru</h6>
                        </div>
                        <div class="card-body">
                        <form action="?" method="POST">
                            <div class="form-group">
                                <input type="text" class="form-control" name="id" placeholder="Username">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="password" placeholder="Password">
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
                $sql = "SELECT * FROM users WHERE username='$id'";
                $run = $conn->query($sql);

                while($row = $run->fetch_assoc()){ ?>
        <!-- Start XP Col -->
            <div class="col-lg-12">
                <div class="card m-b-30">
                    <div class="card-header bg-white">
                        <h5 class="card-title text-black">Edit Admin</h5>
                        <h6 class="card-subtitle">Form untuk mengupdate data admin</h6>
                    </div>
                    <div class="card-body">
                    <form action="?" method="POST">
                            <input type="hidden" class="form-control" name="id" value="<?php echo $row['username']; ?>" required readonly>
                        <div class="form-group">
                            <input type="text" class="form-control" name="password" value="<?php echo $row['password']; ?>">
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
                echo '<script>alert("Aksi Tidak dikenali, Tolong jangan bercanda"); window.location.assign("admin.php");</script>';
                exit();
}
    } else {
?>

                <!-- Start XP Col -->
                <div class="col-lg-12">
                        <div class="card m-b-30">

                            <div class="card-header bg-white">
                                <h5 class="card-title text-black">List Administrator</h5>
                                <h6 class="card-subtitle">Export data to Copy, CSV, Excel & Note.</h6>
                            </div>

                            <div class="card-body">
                                <div class="table-responsive">
                                        <center><a href="admin.php?aksi=tambah" type="button" class="btn btn-rounded btn-success"><i class="mdi mdi-plus mr-2"></i> Tambah Admin</a></center>
                                    <table id="datatable-buttons" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Username</th>
                                                <th>Password</th>
                                                <th>Tindakan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            $no = 1;
                                            $sql = "SELECT * FROM users";
                                            $run = $conn->query($sql);
                                            if($run->num_rows >0){
                                            while($row = $run->fetch_assoc()){
                                        ?>
                                            <tr>
                                                <td><?php echo $no++; ?></td>
                                                <td><?php echo $row['username']; ?></td>
                                                <td><?php echo $row['password']; ?></td>
                                                <td>
                                                    <a href="admin.php?id=<?php echo $row['username']; ?>&aksi=edit" type="button" class="btn btn-rounded btn-warning"><i class="mdi mdi-upload mr-2"></i> Update</a>
                                                    <a onclick="return confirm('Apakah anda yakin ingin menghapus Data Admin dengan Username : <?php echo $row['username']; ?> ?')" href="admin.php?id=<?php echo $row['username']; ?>&aksi=hapus" type="button" class="btn btn-rounded btn-danger"><i class="mdi mdi-delete-sweep mr-2"></i> Delete</a>
                                                </td>
                                            </tr>
                                        <?php } } else { ?>
                                            <tr>
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