<?php
include('database.php');
echo ('<link rel="stylesheet" href="../default.css">');

// Cek koneksi
if (!$con) {
    die("Koneksi gagal: " . mysqli_connect_error());
} else {
    echo "Koneksi berhasil";
}

// Create database buku tamu
$sql = "USE shuset2_shuya";
if (mysqli_query($con, $sql)) {
    echo "<br><br>Database berhasil dibuat, menggunakan database shuset2_shuya";
} else {
    echo "<br><br>Database gagal dibuat: " . mysqli_error($koneksi);
}

// Drop table if it exists
if (mysqli_query($con, "DROP TABLE IF EXISTS buku_tamu")) {
    echo "<br><br> Table buku_tamu berhasil dihapus";
} else {
    echo "<br><br> Error deleting table: " . mysqli_error($con);
}

// Membuat tabel buku_tamus
$sql = "CREATE TABLE `buku_tamu` (
    `id_bt` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `nama` varchar(200) NOT NULL,
    `email` varchar(50) NOT NULL,
    `isi` text NOT NULL
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci TABLESPACE `shuset2_shuya`;";

// jalankan query menggunakan try catch
try {
    if (mysqli_query($con, $sql)) {
        echo "<br><br>Tabel buku_tamu berhasil dibuat";
    } else {
        echo "<br><br>Tabel buku_tamu gagal dibuat: " . mysqli_error($koneksi);
    }
} catch (Exception $e) {
    echo '<br><br> Caught exception: ',  $e->getMessage(), "\n";
}


// Mengisi data
include('database.php');
$sql = "INSERT INTO `buku_tamu` (`nama`, `email`, `isi`) VALUES
('Ahmad', 'ahmad@pm.me', 'hello, my name is Ahmad'),
('Yazid', 'yazid@pm.me', 'hi, my name Yazid'),
('Shuya Setsuna', 'ivlyns@pm.me', 'Hello, Shuya Here!'),
('Ahmad Yazid', 'ahmad.yazid.upnjatim@pm.me', 'Hello, im Yazid, nice to meet you!');";

// jalankan query menggunakan try catch
try {
    if (mysqli_query($con, $sql)) {
        echo "<br><br>Data berhasil dimasukkan kedalam database";
    } else {
        echo "<br><br>Data gagal dimasukkan kedalam database: " . mysqli_error($koneksi);
    }
} catch (Exception $e) {
    echo '<br><br> Caught exception: ',  $e->getMessage(), "\n";
}

// Menutup koneksi
mysqli_close($con);

// button redirect ke halaman buku_tamu.php
echo ('<br><br><button><a style="text-decoration:none;" href="buku_tamu.php">Menuju Halaman Buku Tamu</a></button>');
echo ('<br><br><button><a style="text-decoration:none;" href="../index.html">Kembali ke halaman utama</a=></button>');
