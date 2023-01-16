<?php
include 'header.php';
$nonmember;
if(!isset($_SESSION['online'])){
    header('Location: login.php');
} else {
    if(isset($_GET['id']) && $_GET['go'] == 'keluar' ){
        $id = $_GET['id'];
        $ck_parkir = "SELECT * FROM parkirin WHERE id_par='$id' AND aksi='keluar'";
        $query_parkir = $conn->query($ck_parkir);
        $parkir = $query_parkir->fetch_assoc();
            if($query_parkir->num_rows > 0){
                $nopol = $parkir['no_pol'];
                $ck_member = "SELECT * FROM member WHERE no_pol='$nopol' AND status='aktif'";
                $query_member = $conn->query($ck_member);
                $member = $query_member->fetch_assoc();
                if($query_member->num_rows > 0){
                    function rupiah($angka){
                        $hasil_rupiah = "Rp " . number_format($angka,2,',','.');
                        return $hasil_rupiah;
                    }
                    
                    $arrayMasuk = explode(':', $parkir['waktu_mas']);
                    $arrayKeluar = explode(':', $parkir['waktu_kel']);

                    $detikMasuk = ($arrayMasuk[0]*3600)+($arrayMasuk[1]*60)+$arrayMasuk[2];
                    $detikKeluar = ($arrayKeluar[0]*3600)+($arrayKeluar[1]*60)+$arrayKeluar[2];

                    $selisihDetik = $detikKeluar-$detikMasuk;
                    $jamBagi = $selisihDetik/3600;
                    $sisaBagi = $selisihDetik% 3600;
                    $durasiParkir = ($sisaBagi-$selisihDetik)/3600;
                    echo $durasiParkir;
                    $total_bayar = 0;
                    $nonmember = false;
                   
                } else {
                    function rupiah($angka){
                        $hasil_rupiah = "Rp " . number_format($angka,2,',','.');
                        return $hasil_rupiah;
                    }
                    $arrayMasuk = explode(':', $parkir['waktu_mas']);
                    $arrayKeluar = explode(':', $parkir['waktu_kel']);

                    $detikMasuk = ($arrayMasuk[0]*3600)+($arrayMasuk[1]*60)+$arrayMasuk[2];
                    $detikKeluar = ($arrayKeluar[0]*3600)+($arrayKeluar[1]*60)+$arrayKeluar[2];

                    $selisihDetik = $detikKeluar-$detikMasuk;
                    $jamBagi = $selisihDetik/3600;
                    $sisaBagi = $selisihDetik% 3600;
                    $durasiParkir = ($sisaBagi-$selisihDetik)/3600;
                    echo $durasiParkir;

                    if($sisaBagi > 0){
                        $durasiParkir = $durasiParkir+1;
                    }
                    if($member['jenis'] == 'Mobil'){
                        $perjam = 4000;
                    } else {
                        $perjam = 2000;
                    }
                    
                    $total_bayar = $durasiParkir*$perjam;
                    $nonmember = true;
                    
                }
            } else {
                echo '<script>alert("ID Parkir tidak dikenali!"); window.location.assign("parkir.php");</script>';
                exit();
            }
    } else {
            echo '<script>alert("Aksi tidak dikenali, Tolong jangan bercanda!"); window.location.assign("parkir.php");</script>';
            exit();
    }
    include 'head_index.php'; ?>
            <!-- Start XP Breadcrumbbar -->                    
            <div class="xp-breadcrumbbar">
                <div class="row">
                    <div class="col-md-6 col-lg-6">
                        <h4 class="xp-page-title">Invoice Parkir</h4>
                    </div>
                    <div class="col-md-6 col-lg-6">
                        <div class="xp-breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:;"><i class="icon-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="javascript:;">Parkir</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Invoice</li>
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
                <div class="col-lg-12">
                        <div class="card m-b-30">

                            

                            <div class="card-body">
                                <!-- Start XP Col -->
                    <div class="col-md-12 col-lg-12 col-xl-12" id="printableArea">
                        <div class="card m-b-30">
                            <div class="card-body">
                                <div class="xp-invoice">

                                    <div class="row mb-3">
                                        <div class="col-6 col-md-6 col-lg-6">
                                            <div class="xp-invoice-logo">
                                                <img src="assets/images/logo.png" class="img-fluid" alt="invoice-logo">
                                            </div>
                                        </div>
                                        <div class="col-6 col-md-6 col-lg-6">
                                            <div class="xp-invoice-name text-right">
                                                <h5 class="mb-0">Invoice</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-12 col-lg-12">
                                            <div class="xp-invoice-meta">
                                                <ul class="list-inline mb-3">
                                                    <li class="list-inline-item">
                                                        <p class="mb-0">Waktu Masuk / Waktu Keluar : <span class="text-black f-w-5 ml-2"><?php echo $parkir['waktu_mas']; ?> / <?php echo $parkir['waktu_kel']; ?></span></p>
                                                    </li>
                                                    <li class="list-inline-item">
                                                        <p class="mb-0">Invoice ID # : <span class="text-black f-w-5 ml-2"><?php echo $parkir['id_par']; ?></span></p>
                                                    </li>
                                                    <li class="list-inline-item">
                                                        <p class="mb-0">Status : <span class="text-success f-w-5 ml-2">Paid</span></p>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mb-3">

                                        <div class="col-sm-6 col-md-6 col-lg-6">
                                            <div class="xp-invoice-address mb-4">
                                                <p class="f-w-5 text-black">Bill From :</p>
                                                <h6>Sipaling.com.</h6>
                                                <address>501 Clinton Lane <br> Wilkes Barre, CA 18801</address>
                                                <p>+62 881 1838 661</p>
                                                <p>perusahaan@Sipaling.com</p>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-6 col-lg-6">
                                            <div class="xp-invoice-address mb-4">
                                                <p class="f-w-5 text-black">Bill To :</p>
                                                <h6><?php
                                                    if($nonmember == false){ echo $member['pemilik']; } else echo "Pemarkir"?>.</h6>
                                                <p><?php echo $parkir['status']; ?></p>
                                            </div>
                                        </div>

                                    </div>
                                    <?php if($nonmember == false){ ?>

                                    <div class="row mb-3">

                                        <div class="col-md-12 col-lg-12">
                                            <div class="xp-invoice-summary">
                                                <div class="table-responsive">
                                                    <table class="table table-striped table-borderless">
                                                        <thead>
                                                            <tr>
                                                            <th scope="col">ID Member</th>
                                                            <th scope="col">Nomor Polisi</th>
                                                            <th scope="col">Jenis Kendaraan</th>
                                                            <th scope="col">Merek Kendaraan</th>
                                                            <th scope="col" class="text-right">Total</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td><?php echo $member['id_mem']; ?></td>
                                                                <td><?php echo $member['no_pol']; ?></td>
                                                                <td><?php echo $member['jenis']; ?></td>
                                                                <td><?php echo $member['merek_ken']; ?></td>
                                                                <td class="text-right"><?php echo rupiah($total_bayar); ?></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php } ?>

                                    <div class="row mb-3">
                                        
                                        <div class="col-md-12 col-lg-12">
                                            <div class="xp-invoice-total text-right font-16">
                                                <p>Sub Total : <span class="text-black f-w-5 font-18"><?php echo rupiah($total_bayar); ?> (Tanpa Biaya Admin)</span></p>
                                                <p>Grand Total : <span class="text-black f-w-5 text-danger font-24"><?php echo rupiah($total_bayar); ?></span></p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-6 col-lg-6">
                                            <div class="xp-invoice-note">
                                                <p><span class="text-black f-w-5">Note :</span> terimakasih telah menggunakan Sipaling.com, selamat jalan dan hati-hati dijalan.</p>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-lg-6">
                                            <div class="xp-invoice-btn text-right">
                                                <?php
                                                $sql = "SELECT * FROM `parkirin` WHERE `id_par` = '$id'";
                                                $result = $conn->query($sql);
                                                $row = $result->fetch_assoc();
                                                    if($row['aksi'] == 'masuk'):

                                                ?>
                                                <button type="button" class="btn btn-rounded btn-success" href="parkir.php?id=<?php echo $row['id_par']; ?>&go=<?php echo $row['aksi']; ?>&aksi=edit">Keluar</button>
                                                <?php endif; ?>
                                                <button type="button" class="btn btn-rounded btn-primary" onclick='window.location.assign("parkir.php");'>Keluar</button>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End XP Col -->

                            </div>
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