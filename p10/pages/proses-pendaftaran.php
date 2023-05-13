<?php
// Memanggil file auth.php
require_once "auth/auth.php";
// Memanggil file koneksi.php
include "auth/koneksi.php";

// Mengecek apakah user telah login
// if (!is_authenticated()) {
//     // Jika tidak, redirect ke halaman login
//     header('Location: auth/login.php');
//     exit();
// }

if (isset($_POST['submit'])) {
    // ambil nilai form

    $id_registrasi;
    $id_siswa;
    $id_pendaftaran;
    $tgl_masuk_sekolah;
    $nis;
    $no_peserta_ujian;
    $kode_paud;
    $kode_tk;
    $no_skhun;
    $no_ijazah;
    $id_hobi;
    $id_cita;

    $jenis_pendaftaran = $_POST['jenis_pendaftaran'];
    $tgl_masuk_sekolah = date('Y-m-d', strtotime($_POST['tanggal_masuk_sekolah']));
    $no_induk = $_POST['nomor_induk_mahasiswa'];
    $no_peserta_ujian = $_POST['nomor_peserta_ujian'];
    $paud = $_POST['apakah_pernah_paud'];
    $tk = $_POST['apakah_pernah_tk'];
    $no_seri_skhun = $_POST['nomor_seri_skhun_sebelumnya'];
    $no_seri_ijazah = $_POST['nomor_seri_ijazah_sebelumnya'];
    $hobi = $_POST['hobi'];
    $cita = $_POST['cita_cita'];

    // validasi input
    $errors = array();
    if (!preg_match("/^[0-9]{10}$/", $no_induk)) {
        $errors[] = "Nomor Induk Mahasiswa harus terdiri dari 10 digit angka.";
    }
    if (!preg_match("/^[0-9]{20}$/", $no_peserta_ujian)) {
        $errors[] = "Nomor Peserta Ujian harus terdiri dari 20 digit angka.";
    }
    if (!preg_match("/^[0-9]{16}$/", $no_seri_skhun)) {
        $errors[] = "Nomor Seri SKHUN Sebelumnya harus terdiri dari 16 digit angka.";
    }
    if (!preg_match("/^[0-9]{16}$/", $no_seri_ijazah)) {
        $errors[] = "Nomor Seri Ijazah Sebelumnya harus terdiri dari 16 digit angka.";
    }

    // jika tidak ada error, tambahkan data ke database
    if (empty($errors)) {
        $query = "INSERT INTO peserta_didik (jenis_pendaftaran, tgl_masuk_sekolah, no_induk, no_peserta_ujian, paud, tk, no_seri_skhun, no_seri_ijazah, hobi, cita)
                VALUES ('$jenis_pendaftaran', '$tgl_masuk_sekolah', '$no_induk', '$no_peserta_ujian', '$paud', '$tk', '$no_seri_skhun', '$no_seri_ijazah', '$hobi', '$cita')";
        if (mysqli_query($koneksi, $query)) {
            $id_pendaftaran = mysqli_insert_id($koneksi); // ambil id pendaftaran terakhir
            header('Location: selesai-daftar.php?id=' . $id_pendaftaran);
            exit();
        } else {
            $errors[] = "Terjadi kesalahan: " . mysqli_error($koneksi);
            // NOTE: apakah iya begini?
            header('Location: registrasi.php');
        }
        mysqli_close($koneksi);
    }
}

// Kembali ke halaman lihat data inputan
if (isset($_POST['isian'])) {
    header('Location: lihat-data.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Proses Pendaftaran</title>
</head>

<body>
    <div class="container">
        <?php if (!empty($errors)) : ?>
            <div>
                <ul>
                    <?php foreach ($errors as $error) : ?>
                        <li class="alert alert-danger"><?php echo $error; ?></li>
                    <?php endforeach; ?>
                </ul>

            </div>
        <?php endif; ?>
        <!-- button untuk lanjut -->
        <button type="submit" class="btn btn-primary float-right mr-3" id="submit" name="submit">Simpan ke
            database</button>
        <!-- button untuk kembali -->
        <button type="submit" class="btn btn-primary float-right" id="isian" name="isian">Lihat data isian</button>
    </div>
</body>

<footer>
    <reserved-by></reserved-by>
</footer>

<script src="js/default.js"></script>
<!-- <script src='https://www.hCaptcha.com/1/api.js' async defer></script> -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</html>