<?php
// Memeriksa apakah tombol Hapus telah ditekan
if (isset($_GET['delete_id'])) {
    // Memanggil string koneksi yang ada di file database.php
    // include('database.php');
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "buku_tamu";

    // Mendapatkan id_bt yang dipilih
    $id_bt = $_GET['delete_id'];

    // Menghapus data dari tabel
    $sql = "DELETE FROM buku_tamu WHERE id_bt = '$id_bt'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        header("Location: index.php");
        exit();
    } else {
        echo "Gagal menghapus data.";
    }

    // if (mysqli_query($conn, $sql)) {
    //     echo "Data berhasil dihapus.";
    // } else {
    //     echo "Terjadi kesalahan saat menghapus data: " . mysqli_error($conn);
    // }
}
