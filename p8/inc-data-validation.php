<?php
if (isset($_POST['submit'])) {
    // Mendapatkan data dari input user
    $nama = $_POST['nama'];
    $email = $_POST['email'];

    //jika variable ny kosong maka
    if (empty($nama) || empty($email)) {
        // diarahkan ke halaman error.php dengan pesan 'Data tidak lengkap'
        // Operator .= pada PHP digunakan untuk menggabungkan nilai string ke variabel yang sama tanpa menghapus nilai sebelumnya
        $pesan = "";
        if (empty($nama)) {
            $pesan .= "NAMA belum diisi";
        }
        if (empty($email)) {
            if (empty($nama)) {
                $pesan .= " dan ";
            }
            $pesan .= "EMAIL belum diisi.";
        } else {
            $pesan .= ".";
        }
        // fungsi urlencode() untuk menghindari masalah karakter khusus yang tidak ter-encode dengan benar. 
        header("Location: error.php?pesan=" . urlencode($pesan));
        exit();
    } else {
        //memulai sesi login
        session_start();

        // Mendapatkan data timezone Asia/Jakarta dalam beberapa bentuk
        date_default_timezone_set('Asia/Jakarta');
        $jam = date('h:i:s A');
        $hari = date('l');
        $tanggal = date('Y-m-d');

        // Menyimpan data user kedalam variabel session
        $_SESSION['nama'] = $nama;
        $_SESSION['email'] = $email;
        $_SESSION['jam'] = $jam;
        $_SESSION['hari'] = $hari;
        $_SESSION['tanggal'] = $tanggal;

        // Redirect user login ke halaman dashboard
        header("Location: dashboard.php");
        exit();
    }
}
