<?php
date_default_timezone_set('Asia/Jakarta');
$conn = new  mysqli('localhost', 'root', '', 'parkir');

if($conn->connect_error){
    die("Koneksi gagal : ".$conn->connect_error);
}