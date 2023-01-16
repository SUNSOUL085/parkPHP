<?php
session_start();
session_destroy();
echo '<script>alert("Anda berhasil logout dan akan dialihkan ke halaman login..."); window.location.assign("login.php");</script>';
