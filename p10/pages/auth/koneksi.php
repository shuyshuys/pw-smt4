<?php
// konfigurasi database
$host       =   "localhost";
$user       =   "root";
$pass       =   "";
$database   =   "peserta_didik";
// perintah php untuk akses ke database
$koneksi = mysqli_connect($host, $user, $pass, $database);

// Check connection
if (mysqli_connect_errno()) {
    echo "Koneksi database gagal : " . mysqli_connect_error();
}
