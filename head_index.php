    <!-- Start XP Container -->
    <div id="xp-container">

<!-- Start XP Rightbar -->
<div class="xp-rightbar">

    <!-- Start XP Headerbar -->
    <div class="xp-headerbar">

        <!-- Start XP Topbar -->
        <div class="xp-topbar">

            <!-- Start XP Row -->
            <div class="row"> 

                <!-- Start XP Col -->
                <div class="col-2 col-md-2 col-lg-2 align-self-center">
                    <!-- Start XP Logobar -->
                    <div class="xp-logobar">
                        <a href="javascript:;" class="xp-small-logo"><img src="assets/images/mobile-logo.svg" class="img-fluid" alt="logo"></a>
                        <a href="javascript:;" class="xp-main-logo"><img src="assets/images/logo.png" class="img-fluid" alt="logo"></a>
                    </div>                        
                    <!-- End XP Logobar -->
                </div> 
                <!-- End XP Col -->

                <!-- Start XP Col -->
                <div class="col-10 col-md-10 col-lg-10">
                    <div class="xp-profilebar text-right">
                        <ul class="list-inline mb-0">
                            <li class="list-inline-item mr-0">
                                <div class="dropdown xp-userprofile">
                                    <a class="dropdown-toggle " href="#" role="button" id="xp-userprofile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="assets/images/topbar/user.jpg" alt="user-profile" class="rounded-circle img-fluid"><span class="xp-user-live"></span></a>

                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="xp-userprofile">
                                        <a class="dropdown-item py-3 text-white text-center font-16" href="#">Selamat datang, <?php echo $_SESSION['uname']; ?>!</a>
                                        <a class="dropdown-item" href="logout.php"><i class="icon-power text-danger mr-2"></i> Logout</a>
                                    </div>
                                </div>                                   
                            </li>
                            <li class="list-inline-item xp-horizontal-menu-toggle">
                                <button type="button" class="navbar-toggle bg-transparent" data-toggle="collapse" data-target="#navbar-menu">
                                    <i class="icon-menu font-20 text-white"></i>
                                </button>                                   
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- End XP Col -->

            </div> 
            <!-- End XP Row -->

        </div>
        <!-- End XP Topbar -->

        <!-- Start XP Menubar -->                    
        <div class="xp-menubar text-left">

            <!-- Start XP Nav -->
            <nav class="xp-horizontal-nav xp-mobile-navbar xp-fixed-navbar">

                <div class="collapse navbar-collapse" id="navbar-menu">
                  <ul class="xp-horizontal-menu">

                    <li class="scroll"><a href="index.php"><i class="icon-speedometer"></i><span>Beranda</span></a></li>
                    <li class="scroll"><a href="admin.php"><i class="icon-user"></i><span>Administrator</span></a></li>
                    <li class="scroll"><a href="member.php"><i class="icon-people"></i><span>Data Member</span></a></li>
                    <li class="scroll"><a href="parkir.php"><i class="icon-anchor"></i><span>Data Parkir</span></a></li>

                  </ul>
                </div>

            </nav>
            <!-- End XP Nav -->

        </div>
        <!-- End XP Menubar -->

    </div>
    <!-- End XP Headerbar -->