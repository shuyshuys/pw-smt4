<?php
// konfigurasi database
$host       =   "sql308.epizy.com";
$user       =   "epiz_33929470";
$password   =   "Xii0ChiqoTMvRa2";
$database   =   "epiz_33929470_latihan";
// perintah php untuk akses ke database
$koneksi = mysqli_connect($host, $user, $password, $database);

// cek koneksi
if (mysqli_connect_errno()) {
    echo "koneksi database gagal : " . mysqli_connect_error();
}
