<?php
// Memanggil file auth.php
require_once "auth/auth.php";
// Memanggil file koneksi.php
include "auth/koneksi.php";

// Mengecek apakah user telah login
if (!is_authenticated()) {
    // Jika tidak, redirect ke halaman login
    header('Location: auth/login.php');
    exit();
}

echo "<pre>";
print_r($_SESSION['registrasi']);
print_r($_SESSION['data-pribadi']);
print_r($_SESSION['data-ayah']);
print_r($_SESSION['data-ibu']);
echo "</pre>";

if (isset($_POST['submit'])) {
    // ambil nilai form
    // $id_registrasi = "";
    // $id_siswa = "";
    // $id_pendaftaran = "";
    // $tgl_masuk_sekolah = "";
    // $nis = "";
    // $no_peserta_ujian = "";
    // $kode_paud = "";
    // $kode_tk = "";
    // $no_skhun = "";
    // $no_ijazah = "";
    // $id_hobi = "";
    // $id_cita = "";

    // ambil nilai session halaman registrasi
    $id_siswa = $_SESSION['user']['username'];
    $id_pendaftaran = $_SESSION['registrasi']['jenis_pendaftaran'];
    $tanggal_masuk_sekolah = $_SESSION['registrasi']['tanggal_masuk_sekolah'];
    $nomor_induk_sekolah = $_SESSION['registrasi']['nomor_induk_sekolah'];
    $nomor_peserta_ujian = $_SESSION['registrasi']['nomor_peserta_ujian'];
    $apakah_pernah_paud = $_SESSION['registrasi']['apakah_pernah_paud'];
    $apakah_pernah_tk = $_SESSION['registrasi']['apakah_pernah_tk'];
    $nomor_seri_skhun_sebelumnya = $_SESSION['registrasi']['nomor_seri_skhun_sebelumnya'];
    $nomor_seri_ijazah_sebelumnya = $_SESSION['registrasi']['nomor_seri_ijazah_sebelumnya'];
    $hobi = $_SESSION['registrasi']['hobi'];
    $cita = $_SESSION['registrasi']['cita'];

    // ambil nilai session halaman data-pribadi
    $id_siswa = $_SESSION['user']['username'];
    $nama_lengkap = $_SESSION['data-pribadi']['nama_lengkap'];
    $jenis_kelamin = $_SESSION['data-pribadi']['jenis_kelamin'];
    $nisn = $_SESSION['data-pribadi']['nisn'];
    $nik = $_SESSION['data-pribadi']['nik'];
    $tanggal_lahir = $_SESSION['data-pribadi']['tanggal_lahir'];
    $agama = $_SESSION['data-pribadi']['agama'];
    $berkebutuhan_khusus = $_SESSION['data-pribadi']['berkebutuhan_khusus'];
    $alamat = $_SESSION['data-pribadi']['alamat'];
    $rt = $_SESSION['data-pribadi']['rt'];
    $rw = $_SESSION['data-pribadi']['rw'];
    $nama_dusun = $_SESSION['data-pribadi']['nama_dusun'];
    $nama_kelurahan = $_SESSION['data-pribadi']['nama_kelurahan'];
    $nama_kecamatan = $_SESSION['data-pribadi']['kecamatan'];
    $kode_pos = $_SESSION['data-pribadi']['kode_pos'];
    $tempat_tinggal = $_SESSION['data-pribadi']['tempat_tinggal'];
    $moda_transportasi = $_SESSION['data-pribadi']['moda_transportasi'];
    $nomor_hp = $_SESSION['data-pribadi']['nomor_hp'];
    $nomor_telepon = $_SESSION['data-pribadi']['nomor_telepon'];
    $email = $_SESSION['data-pribadi']['email'];
    $penerima_kps = $_SESSION['data-pribadi']['penerima_kps'];
    $nomor_kps = $_SESSION['data-pribadi']['nomor_kps'];
    $kewarganegaraan = $_SESSION['data-pribadi']['kewarganegaraan'];
    $nama_negara = $_SESSION['data-pribadi']['nama_negara'];

    // ambil nilai session halaman data-orang-tua
    $nama_ayah = $_SESSION['data-ayah']['nama_ayah'];
    $tahun_lahir_ayah = $_SESSION['data-ayah']['ayah_tahun_lahir'];
    $pendidikan_ayah = $_SESSION['data-ayah']['ayah_pendidikan_ortu'];
    $pekerjaan_ayah = $_SESSION['data-ayah']['ayah_pekerjaan_ortu'];
    $penghasilan_ayah = $_SESSION['data-ayah']['ayah_penghasilan_ortu'];
    $ayah_berkebutuhan_khusus = $_SESSION['data-ayah']['ayah_berkebutuhan_khusus'];
    $nama_ibu = $_SESSION['data-ibu']['nama_ibu'];
    $tahun_lahir_ibu = $_SESSION['data-ibu']['ibu_tahun_lahir'];
    $pendidikan_ibu = $_SESSION['data-ibu']['ibu_pendidikan_ortu'];
    $pekerjaan_ibu = $_SESSION['data-ibu']['ibu_pekerjaan_ortu'];
    $penghasilan_ibu = $_SESSION['data-ibu']['ibu_penghasilan_ortu'];
    $ibu_berkebutuhan_khusus = $_SESSION['data-ibu']['ibu_berkebutuhan_khusus'];


    // masukkan alamat, rt, rw, dusun, kelurahan, desa, kecamatan, kode_pos kedalam tabel alamat
    $query = "INSERT INTO alamat (alamat_jalan, rt, rw, dusun, kelurahan_desa, kecamatan, kode_pos)
    VALUES ('$alamat', '$rt', '$rw', '$nama_dusun', '$nama_kelurahan', '$nama_kecamatan', '$kode_pos')";
    $result = mysqli_query($koneksi, $query);
    // ambil id alamat
    $id_alamat_pr = mysqli_insert_id($koneksi);

    // masukkan id_siswa, nama_lengkap, jenis_kelamin, nisn, nik, tanggal_lahir, agama, berkebutuhan_khusus, alamat, tempat_tinggal, moda_transportasi, nomor_hp, nomor_telepon, email, penerima_kps, nomor_kps, kewarganegaraan kedalam tabel siswa
    $query = "INSERT INTO siswa (id_siswa, nama_lengkap, kode_jenis_kelamin, nisn, nik, tgl_lahir, id_agama, id_kebutuhan_khusus, id_alamat, id_tempat_tinggal, id_moda_transportasi, no_hp, nomor_telepon, email, kode_kps_kks_pkh_kip, no_kps_kks_pkh_kip, kode_kewarganegaraan)
    VALUES ('$id_siswa', '$nama_lengkap', '$jenis_kelamin', '$nisn', '$nik', '$tanggal_lahir', '$agama', '$berkebutuhan_khusus', '$id_alamat_pr', '$tempat_tinggal', '$moda_transportasi', '$nomor_hp', '$nomor_telepon', '$email', '$penerima_kps', '$nomor_kps', '$kewarganegaraan')";
    $result = mysqli_query($koneksi, $query);

    // masukkan id_siswa, nama_ayah, ayah_tahun_lahir, ayah_pendidikan_ortu, ayah_pekerjaan_ortu, ayah_penghasilan_ortu, ayah_berkebutuhan_khusus kedalam tabel ayah
    $query = "INSERT INTO ortu_ayah (id_siswa, nama_ayah, tahun_lahir, id_pendidikan_ortu, id_pekerjaan_ortu, id_penghasilan_ortu, id_kebutuhan_khusus)
    VALUES ('$id_siswa', '$nama_ayah', '$tahun_lahir_ayah', '$pendidikan_ayah', '$pekerjaan_ayah', '$penghasilan_ayah', '$ayah_berkebutuhan_khusus')";
    $result = mysqli_query($koneksi, $query);

    // masukkan id_siswa, nama_ibu, ibu_tahun_lahir, ibu_pendidikan_ortu, ibu_pekerjaan_ortu, ibu_penghasilan_ortu, ibu_berkebutuhan_khusus kedalam tabel ibu
    $query = "INSERT INTO ortu_ibu (id_siswa, nama_ibu, tahun_lahir, id_pendidikan_ortu, id_pekerjaan_ortu, id_penghasilan_ortu, id_kebutuhan_khusus)
    VALUES ('$id_siswa', '$nama_ibu', '$tahun_lahir_ibu', '$pendidikan_ibu', '$pekerjaan_ibu', '$penghasilan_ibu', '$ibu_berkebutuhan_khusus')";
    $result = mysqli_query($koneksi, $query);

    // masukkan kedalam tabel registrasi
    $query = "INSERT INTO registrasi (id_siswa, id_pendaftaran, tgl_masuk_sekolah, nis, no_peserta_ujian, kode_paud, kode_tk, no_skhun, no_ijazah, id_hobi, id_cita) 
VALUES ('$id_siswa', '$id_pendaftaran', '$tanggal_masuk_sekolah ', '$nomor_induk_sekolah', '$nomor_peserta_ujian', '$apakah_pernah_paud', '$apakah_pernah_tk', '$nomor_seri_skhun_sebelumnya', '$nomor_seri_ijazah_sebelumnya', '$hobi', '$cita')";
    $result = mysqli_query($koneksi, $query);
    if (!$result) {
        die("Query gagal dijalankan: " . mysqli_error($koneksi));
    } else {
        // ambil id registrasi
        $id_registrasi = mysqli_insert_id($koneksi);
    }

    // alert sukses
    echo "<script>alert('Data berhasil disimpan.');</script>";

    // $jenis_pendaftaran = $_POST['jenis_pendaftaran'];
    // $tgl_masuk_sekolah = date('Y-m-d', strtotime($_POST['tanggal_masuk_sekolah']));
    // $no_induk = $_POST['nomor_induk_sekolah'];
    // $no_peserta_ujian = $_POST['nomor_peserta_ujian'];
    // $paud = $_POST['apakah_pernah_paud'];
    // $tk = $_POST['apakah_pernah_tk'];
    // $no_seri_skhun = $_POST['nomor_seri_skhun_sebelumnya'];
    // $no_seri_ijazah = $_POST['nomor_seri_ijazah_sebelumnya'];
    // $hobi = $_POST['hobi'];
    // $cita = $_POST['cita_cita'];

    // validasi input
    // $errors = array();
    // if (!preg_match("/^[0-9]{10}$/", $no_induk)) {
    //     $errors[] = "Nomor Induk Mahasiswa harus terdiri dari 10 digit angka.";
    // }
    // if (!preg_match("/^[0-9]{20}$/", $no_peserta_ujian)) {
    //     $errors[] = "Nomor Peserta Ujian harus terdiri dari 20 digit angka.";
    // }
    // if (!preg_match("/^[0-9]{16}$/", $no_seri_skhun)) {
    //     $errors[] = "Nomor Seri SKHUN Sebelumnya harus terdiri dari 16 digit angka.";
    // }
    // if (!preg_match("/^[0-9]{16}$/", $no_seri_ijazah)) {
    //     $errors[] = "Nomor Seri Ijazah Sebelumnya harus terdiri dari 16 digit angka.";
    // }

    // jika tidak ada error, tambahkan data ke database
    // if (empty($errors)) {
    // $query = "INSERT INTO peserta_didik (jenis_pendaftaran, tgl_masuk_sekolah, no_induk, no_peserta_ujian, paud, tk, no_seri_skhun, no_seri_ijazah, hobi, cita)
    //         VALUES ('$jenis_pendaftaran', '$tgl_masuk_sekolah', '$no_induk', '$no_peserta_ujian', '$paud', '$tk', '$no_seri_skhun', '$no_seri_ijazah', '$hobi', '$cita')";
    // if (mysqli_query($koneksi, $query)) {
    //     $id_pendaftaran = mysqli_insert_id($koneksi); // ambil id pendaftaran terakhir
    //     header('Location: selesai-daftar.php?id=' . $id_pendaftaran);
    //     exit();
    // } else {
    //     $errors[] = "Terjadi kesalahan: " . mysqli_error($koneksi);
    //     // NOTE: apakah iya begini?
    //     header('Location: registrasi.php');
    // }
    // mysqli_close($koneksi);

    // }
}

// Kembali ke halaman lihat data inputan
if (isset($_POST['isian'])) {
    header('Location: lihat-data.php');
}

// Kembali ke halaman sebelumnya
if (isset($_POST['back'])) {
    header('Location: data-ibu.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"> -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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
        <form action="" method="post">
            <!-- button untuk lanjut -->
            <button type="submit" class="btn btn-primary float-right" id="submit" name="submit">Simpan ke
                database</button>
            <!-- button lihat isian -->
            <button type="submit" class="btn btn-primary float-right mr-2" id="isian" name="isian">Lihat data
                isian</button>
            <!-- button untuk kembali -->
            <button type="submit" class="btn btn-primary float-right mr-2" id="back" name="back">Back</button>
        </form>
    </div>
</body>

<footer>
    <br><br>
    <reserved-by></reserved-by>
</footer>

<script src="js/default.js"></script>
<!-- <script src='https://www.hCaptcha.com/1/api.js' async defer></script> -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</html>