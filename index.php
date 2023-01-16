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
                        <h4 class="xp-page-title">Home</h4>
                    </div>
                    <div class="col-md-6 col-lg-6">
                        <div class="xp-breadcrumb">
                            <ol class="breadcrumb">
                            <?php echo $_SERVER['SERVER_NAME']; ?>
                                <li class="breadcrumb-item"><a href="javascript:;"><i class="icon-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="javascript:;">Halaman</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Utama</li>
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

                <!-- Start XP Col -->
                <div class="col-md-12 col-lg-12 col-xl-12">
                    <div class="text-center mt-5 mb-5">
                        <h1 class="text-black">Selamat Datang di Dashboard Parkir</h1>
                        <br />
                        <!-- <iframe width="1280" height="720" src="https://www.youtube.com/embed/GGzt3-X5HHU" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe> -->
                    </div>
                </div>
                <!-- End XP Col -->

            </div>
             <!-- End XP Row -->  

        </div>
        <!-- End XP Contentbar -->
<?php
    include 'foot_index.php'; } ?>
<?php
include 'footer.php';
?>