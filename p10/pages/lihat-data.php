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

// ambil data dari tabel registrasi, join dengan tabel cita, hobi, jenis_pendaftaran, paud, tk, dan siswa. kemudian siswa join dengan tabel agama, alamat, jenis_kelamin, kewarganegaraan, ortu_ayah, dan ortu_ibu
$query = "SELECT 
r.id_registrasi,
s.nama_lengkap,
jk.nama_jenis_kelamin,
s.nisn,
s.nik,
s.tempat_lahir,
s.tgl_lahir,
ag.nama_agama,
al.alamat_jalan,
al.rt,
al.rw,
al.dusun,
al.kelurahan_desa,
al.kecamatan,
al.kode_pos,
kw.keterangan,
tt.nama_tempat_tinggal,
mt.nama_moda_transportasi,
jp.keterangan_pendaftaran,
r.tgl_masuk_sekolah,
r.nis,
r.no_peserta_ujian,
paud.keterangan,
tk.keterangan,
r.no_skhun,
r.no_ijazah,
h.nama_hobi,
c.nama_cita

FROM registrasi r
JOIN cita c ON r.id_cita = c.id_cita
JOIN hobi h ON r.id_hobi = h.id_hobi
JOIN jenis_pendaftaran jp ON r.id_pendaftaran = jp.id_pendaftaran
JOIN paud ON r.kode_paud = paud.kode_paud
JOIN tk ON r.kode_tk = tk.kode_tk
JOIN siswa s ON r.id_siswa = s.id_siswa
JOIN agama ag ON s.id_agama = ag.id_agama
JOIN alamat al ON s.id_alamat = al.id_alamat
JOIN tempat_tinggal tt ON s.id_tempat_tinggal = tt.id_tempat_tinggal
JOIN moda_transportasi mt ON mt.id_moda_transportasi = s.id_moda_transportasi
JOIN jenis_kelamin jk ON s.kode_jenis_kelamin = jk.kode_jenis_kelamin
JOIN kewarganegaraan kw ON s.kode_kewarganegaraan = kw.kode_kewarganegaraan
JOIN ortu_ayah oa ON s.id_siswa = oa.id_siswa
JOIN ortu_ibu oi ON s.id_siswa= oi.id_siswa
WHERE r.id_registrasi = '646229'";
$result = mysqli_query($koneksi, $query);

// Cek apakah user yang mengakses halaman ini adalah pemilik data
// if ($_SESSION['id_user'] != $row['id_user']) {
//     echo "Akses ditolak!";
//     return false;
// }

// Kembali ke halaman sebelumnya
if (isset($_POST['back'])) {
    header('Location: registrasi.php');
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Informasi Peserta Didik Baru</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- cdn bootstrap v5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .warning {
            color: #FF0000;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <?php echo "Selamat datang, " . $_SESSION['user']['username']; ?>
        <h1>Informasi Peserta Didik Baru</h1>
        <h1>Data Registrasi <?php
                            if (isset($_SESSION['unique_id'])) {
                                echo $_SESSION['unique_id'];
                            }
                            ?></h1>
        <form>
            <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                <div class="row">
                    <div class="mb-3 row">
                        <label for="id_registrasi" class="form-label">ID Registrasi</label>
                        <input type="text" class="form-control" id="id_registrasi" value="<?php echo $row['id_registrasi']; ?>" readonly>
                    </div>
                    <div class="mb-3 row">
                        <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" id="nama_lengkap" value="<?php echo $row['nama_lengkap']; ?>" readonly>
                    </div>
                    <div class="mb-3 row">
                        <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                        <input type="text" class="form-control" id="jenis_kelamin" value="<?php echo $row['nama_jenis_kelamin']; ?>" readonly>
                    </div>
                    <div class="mb-3 row">
                        <label for="nisn" class="form-label">NISN</label>
                        <input type="text" class="form-control" id="nisn" value="<?php echo $row['nisn']; ?>" readonly>
                    </div>
                    <div class="mb-3 row">
                        <label for="nik" class="form-label">NIK</label>
                        <input type="text" class="form-control" id="nik" value="<?php echo $row['nik']; ?>" readonly>
                    </div>
                    <div class="mb-3 row">
                        <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                        <input type="text" class="form-control" id="tempat_lahir" value="<?php echo $row['tempat_lahir']; ?>" readonly>
                    </div>
                    <div class="mb-3 row">
                        <label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
                        <input type="text" class="form-control" id="tgl_lahir" value="<?php echo $row['tgl_lahir']; ?>" readonly>
                    </div>
                    <div class="mb-3 row">
                        <label for="nama_agama" class="form-label">Agama</label>
                        <input type="text" class="form-control" id="nama_agama" value="<?php echo $row['nama_agama']; ?>" readonly>
                    </div>
                    <div class="mb-3 row">
                        <label for="alamat_jalan" class="form-label">Alamat Jalan</label>
                        <input type="text" class="form-control" id="alamat_jalan" value="<?php echo $row['alamat_jalan']; ?>" readonly>
                    </div>
                    <div class="mb-3 row">
                        <label for="rt" class="form-label">RT</label>
                        <input type="text" class="form-control" id="rt" value="<?php echo $row['rt']; ?>" readonly>
                    </div>
                    <div class="mb-3 row">
                        <label for="rw" class="form-label">RW</label>
                        <input type="text" class="form-control" id="rw" value="<?php echo $row['rw']; ?>" readonly>
                    </div>
                    <div class="mb-3 row">
                        <label for="dusun" class="form-label">Dusun</label>
                        <input type="text" class="form-control" id="dusun" value="<?php echo $row['dusun']; ?>" readonly>
                    </div>
                    <div class="mb-3 row">
                        <label for="kelurahan_desa" class="form-label">Kelurahan/Desa</label>
                        <input type="text" class="form-control" id="kelurahan_desa" value="<?php echo $row['kelurahan_desa']; ?>" readonly>
                    </div>
                    <div class="mb-3 row">
                        <label for="kecamatan" class="form-label">Kecamatan</label>
                        <input type="text" class="form-control" id="kecamatan" value="<?php echo $row['kecamatan']; ?>" readonly>
                    </div>
                    <div class="mb-3 row">
                        <label for="kode_pos" class="form-label">Kode Pos</label>
                        <input type="text" class="form-control" id="kode_pos" value="<?php echo $row['kode_pos']; ?>" readonly>
                    </div>
                    <div class="mb-3 row">
                        <label for="keterangan" class="form-label">Kewarganegaraan</label>
                        <input type="text" class="form-control" id="keterangan" value="<?php echo $row['keterangan']; ?>" readonly>
                    </div>
                    <div class="mb-3 row">
                        <label for="nama_tempat_tinggal" class="form-label">Tempat Tinggal</label>
                        <input type="text" class="form-control" id="nama_tempat_tinggal" value="<?php echo $row['nama_tempat_tinggal']; ?>" readonly>
                    </div>
                    <div class="mb-3 row">
                        <label for="nama_moda_transportasi" class="form-label">Moda Transportasi</label>
                        <input type="text" class="form-control" id="nama_moda_transportasi" value="<?php echo $row['nama_moda_transportasi']; ?>" readonly>
                    </div>
                    <div class="mb-3 row">
                        <label for="keterangan_pendaftaran" class="form-label">Keterangan Pendaftaran</label>
                        <input type="text" class="form-control" id="keterangan_pendaftaran" value="<?php echo $row['keterangan_pendaftaran']; ?>" readonly>
                    </div>
                    <div class="mb-3 row">
                        <label for="tgl_masuk_sekolah" class="form-label">Tanggal Masuk Sekolah</label>
                        <input type="text" class="form-control" id="tgl_masuk_sekolah" value="<?php echo $row['tgl_masuk_sekolah']; ?>" readonly>
                    </div>
                    <div class="mb-3 row">
                        <label for="nis" class="form-label">NIS</label>
                        <input type="text" class="form-control" id="nis" value="<?php echo $row['nis']; ?>" readonly>
                    </div>
                    <div class="mb-3 row">
                        <label for="no_peserta_ujian" class="form-label">Nomor Peserta Ujian</label>
                        <input type="text" class="form-control" id="no_peserta_ujian" value="<?php echo $row['no_peserta_ujian']; ?>" readonly>
                    </div>
                    <div class="mb-3 row">
                        <label for="keterangan_paud" class="form-label">Keterangan PAUD</label>
                        <input type="text" class="form-control" id="keterangan_paud" value="<?php echo $row['keterangan']; ?>" readonly>
                    </div>
                    <div class="mb-3 row">
                        <label for="keterangan_tk" class="form-label">Keterangan TK</label>
                        <input type="text" class="form-control" id="keterangan_tk" value="<?php echo $row['keterangan']; ?>" readonly>
                    </div>
                    <div class="mb-3 row">
                        <label for="no_skhun" class="form-label">Nomor SKHUN</label>
                        <input type="text" class="form-control" id="no_skhun" value="<?php echo $row['no_skhun']; ?>" readonly>
                    </div>
                    <div class="mb-3 row">
                        <label for="no_ijazah" class="form-label">Nomor Ijazah</label>
                        <input type="text" class="form-control" id="no_ijazah" value="<?php echo $row['no_ijazah']; ?>" readonly>
                    </div>
                    <div class="mb-3 row">
                        <label for="nama_hobi" class="form-label">Hobi</label>
                        <input type="text" class="form-control" id="nama_hobi" value="<?php echo $row['nama_hobi']; ?>" readonly>
                    </div>
                    <div class="mb-3 row">
                        <label for="nama_cita" class="form-label">Cita-cita</label>
                        <input type="text" class="form-control" id="nama_cita" value="<?php echo $row['nama_cita']; ?>" readonly>
                    </div>
                </div>
            <?php endwhile; ?>
            <!-- button untuk kembali -->
            <button type="submit" class="btn btn-primary float-end mx-1" id="back" name="back">Back</button>
        </form>
    </div>
</body>
<footer>
    <reserved-by></reserved-by>
</footer>

<script src="js/default.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js"></script>

</html>