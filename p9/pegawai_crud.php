<?php
include('database.php');
echo ('<link rel="stylesheet" href="../default.css">');

// Cek koneksi
if (!$con) {
    die("Koneksi gagal: " . mysqli_connect_error());
} else {
    echo "Koneksi berhasil";
}

// Create database
$sql = "USE shuset2_shuya";
if (mysqli_query($con, $sql)) {
    echo "<br><br>Database berhasil dibuat, menggunakan database shuset2_shuya";
} else {
    echo "<br><br>Database gagal dibuat: " . mysqli_error($koneksi);
}

// Drop table if it exists
if (mysqli_query($con, "DROP TABLE IF EXISTS pegawai")) {
    echo "<br><br> Table pegawai berhasil dihapus";
} else {
    echo "<br><br> Error deleting table: " . mysqli_error($con);
}
// Drop table if it exists
if (mysqli_query($con, "DROP TABLE IF EXISTS jabatan")) {
    echo "<br><br> Table jabatan berhasil dihapus";
} else {
    echo "<br><br> Error deleting table: " . mysqli_error($con);
}

// Membuat tabel jabatan
$sql = "CREATE TABLE `jabatan` (
    `id_jabatan` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `nama_jabatan` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
    `gaji_pokok` int(11) DEFAULT NULL
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;";

// jalankan query menggunakan try catch
try {
    if (mysqli_query($con, $sql)) {
        echo "<br><br>Tabel jabatan berhasil dibuat";
    } else {
        echo "<br><br>Tabel jabatan gagal dibuat: " . mysqli_error($koneksi);
    }
} catch (Exception $e) {
    echo '<br><br> Caught exception: ',  $e->getMessage(), "\n";
}

// Membuat tabel pegawai
$sql = "CREATE TABLE `pegawai` (
    `id_pegawai` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `nama_pegawai` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
    `id_jabatan` int(11) DEFAULT NULL
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;";

// jalankan query menggunakan try catch
try {
    if (mysqli_query($con, $sql)) {
        echo "<br><br>Tabel pegawai berhasil dibuat";
    } else {
        echo "<br><br>Tabel pegawai gagal dibuat: " . mysqli_error($koneksi);
    }
} catch (Exception $e) {
    echo '<br><br> Caught exception: ',  $e->getMessage(), "\n";
}

// ALTER table pegawai untuk menyambungkan ke tabel jabatan
$sql = "ALTER TABLE `pegawai`
ADD CONSTRAINT `pegawai_ibfk_1` FOREIGN KEY (`id_jabatan`) REFERENCES `jabatan` (`id_jabatan`) ON DELETE CASCADE ON UPDATE CASCADE;";

// jalankan query menggunakan try catch
try {
    if (mysqli_query($con, $sql)) {
        echo "<br><br>Table pegawai berhasil dihubungkan ke tabel jabatan";
    } else {
        echo "<br><br>Table pegawai gagal dihubungkan ke tabel jabatan: " . mysqli_error($koneksi);
    }
} catch (Exception $e) {
    echo '<br><br> Caught exception: ',  $e->getMessage(), "\n";
}


// Mengisi data ke tabel jabatan
$sql = "INSERT INTO `jabatan` (`id_jabatan`, `nama_jabatan`, `gaji_pokok`) VALUES
(1, 'Manager', 15000000),
(2, 'Supervisor', 8000000),
(3, 'Staff', 5000000);";

// jalankan query menggunakan try catch
try {
    if (mysqli_query($con, $sql)) {
        echo "<br><br>Data jabatan berhasil dimasukkan kedalam database";
    } else {
        echo "<br><br>Data jabatan gagal dimasukkan kedalam database: " . mysqli_error($koneksi);
    }
} catch (Exception $e) {
    echo '<br><br> Caught exception: ',  $e->getMessage(), "\n";
}

// Mengisi data ke tabel pegawai
$sql = "INSERT INTO `pegawai` (`id_pegawai`, `nama_pegawai`, `id_jabatan`) VALUES
(2, 'Shuya', 2),
(129, 'Ahmad Yazid', 1),
(130, 'Setsuna', 3);";

// jalankan query menggunakan try catch
try {
    if (mysqli_query($con, $sql)) {
        echo "<br><br>Data pegawai berhasil dimasukkan kedalam database";
    } else {
        echo "<br><br>Data pegawai gagal dimasukkan kedalam database: " . mysqli_error($koneksi);
    }
} catch (Exception $e) {
    echo '<br><br> Caught exception: ',  $e->getMessage(), "\n";
}

// Menutup koneksi
mysqli_close($con);

// button redirect ke halaman buku_tamu.php
echo ('<br><br><button><a style="text-decoration:none;" href="pegawai.php">Menuju Halaman Pegawai</a></button>');
echo ('<br><br><button><a style="text-decoration:none;" href="../index.html">Kembali ke halaman Utama</a=></button>');
