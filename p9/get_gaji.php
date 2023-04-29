<?php
// Koneksi ke database
// include('database.php');
$host = "localhost";
$user = "root";
$password = "";
$database = "pegawai";
$con = mysqli_connect($host, $user, $password, $database);

// Mendapatkan nilai id_jabatan dari parameter GET
$id_jabatan = $_GET["id_jabatan"];

// Query untuk mendapatkan gaji berdasarkan id_jabatan
if ($id_jabatan !== "") {
    $query = "SELECT gaji_pokok FROM jabatan WHERE id_jabatan = $id_jabatan";
    $result = mysqli_query($con, $query);
    // Mengambil nilai gaji dari hasil query
    if ($row = mysqli_fetch_assoc($result)) {
        $gaji = $row["gaji_pokok"];
    }
} else {
    $gaji = "";
}

// Mengirimkan nilai gaji dalam format teks
echo $gaji;
