<?php
include 'header.php';
if(isset($_SESSION['online'])){
    header('Location: index.php');
} else {
?>

<div class="xp-authenticate-bg"></div>
<!-- Start XP Container -->
<div id="xp-container" class="xp-container">

    <!-- Start Container -->
    <div class="container">

        <!-- Start XP Row -->
        <div class="row vh-100 align-items-center">
            <!-- Start XP Col -->
            <div class="col-lg-12 ">

                <!-- Start XP Auth Box -->
                <div class="xp-auth-box">


                        <div class="card">
                            <div class="card-body">
                                <h3 class="text-center mt-0 m-b-15">
                                    <a href="javascript:;" class="xp-web-logo"><img src="assets/images/logo.png" height="40" alt="logo"></a>
                                </h3>
                                <div class="p-3">
                                    <form action="?" method="POST">
                                        <div class="text-center mb-3">
                                        <?php echo $_SERVER['SERVER_NAME']; ?>
                                            <h4 class="text-black">Masuk ke Website !</h4>
                                        <?php
                                        if(isset($_POST['submit'])){
                                            $username = $_POST['username'];
                                            $password = $_POST['password'];
                                            $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
                                            $result = $conn->query($sql);
                                            $row = $result->fetch_assoc();
                                            if(empty($username)&&empty($password)) {
                                                echo '<div class="alert alert-danger" role="alert">Username & Password Belum diisi</div>';
                                            } else if(empty($username)||empty($password)) {
                                                echo '<div class="alert alert-danger" role="alert">Username / Password Belum diisi</div>';
                                            } else if($username!=$row['username']) {
                                                echo '<div class="alert alert-danger" role="alert">Username tidak terdaftar</div>';
                                            } else if($password!=$row['password']) {
                                                echo '<div class="alert alert-danger" role="alert">Password Salah</div>';
                                            } else if($result->num_rows<1) {
                                                echo '<div class="alert alert-danger" role="alert">Akun tidak terdaftar</div>';
                                            } else {
                                                $_SESSION['uname'] = $username;
                                                $_SESSION['online'] = TRUE;
                                                echo '<script>alert("Anda berhasil login dan akan dialihkan ke halaman index..."); window.location.assign("index.php");</script>';
                                            }
                                        }
                                        ?>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                                        </div>
                                      <button type="submit" name="submit" class="btn btn-primary btn-rounded btn-lg btn-block">Sign In</button>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- End XP Auth Box -->

                </div>
                <!-- End XP Col -->
            </div>
            <!-- End XP Row -->
        </div>
        <!-- End Container -->
    </div>
    <!-- End XP Container -->

<?php } ?>
<?php
include 'footer.php';
?>
