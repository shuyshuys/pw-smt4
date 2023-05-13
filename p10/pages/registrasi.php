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

// Proses data agar disimpan dalam variable $_SESSION
if (isset($_POST['submit'])) {
    // Simpan data ke dalam variabel session
    $_SESSION['registrasi'] = [
        'id_daftar' => $_POST['id_daftar'],
        'tanggal_masuk_sekolah' => $_POST['tanggal_masuk_sekolah'],
        'nomor_induk_mahasiswa' => $_POST['nomor_induk_mahasiswa'],
        'apakah_pernah_paud' => $_POST['apakah_pernah_paud'],
        'apakah_pernah_tk' => $_POST['apakah_pernah_tk'],
        'nomor_seri_ijazah_sebelumya' => $_POST['nomor_seri_ijazah_sebelumnya'],
        'hobi' => $_POST['hobi'],
        'cita' => $_POST['cita']
    ];
    echo $_SESSION['registrasi']['hobi'];
    // Melanjutkan ke halaman data-pribadi.php
    header('Location: data-pribadi.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- cdn bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .warning {
            color: #FF0000;
        }
    </style>
    <title>Formulir Peserta Didik</title>

</head>

<body>
    <?php if (!empty($errors)) : ?>
        <div class="alert alert-danger">
            <ul>
                <?php foreach ($errors as $error) : ?>
                    <li><?php echo $error; ?></li>
                <?php endforeach; ?>
            </ul>

        </div>
    <?php endif; ?>
    <div class="container mt-4 mb-4">
        <h1 class="text-center card-header">Formulir Peserta Didik</h1>
        <div class="row mt-4">
            <div class="col-sm-12">
                <div class="card">
                    <h4 class="card-header text-white bg-secondary">REGISTRASI PESERTA DIDIK</h4>
                    <div class="card-body">
                        <form id="form_pendaftaran" method="post" action="">
                            <div class="form-group row">
                                <label for="jenis_pendaftaran" class="col-sm-3 col-form-label">Jenis
                                    Pendaftaran:</label>
                                <div class="col-sm-9">
                                    <select class="form-control" id="jenis_pendaftaran" name="jenis_pendaftaran">
                                        <option value="">- Pilih jenis pendaftaran -</option>
                                        <?php
                                        $query_jenis_pendaftaran = "SELECT * FROM jenis_pendaftaran";
                                        $result_jenis_pendaftaran = mysqli_query($koneksi, $query_jenis_pendaftaran);
                                        while ($row_jenis_pendaftaran = mysqli_fetch_assoc($result_jenis_pendaftaran)) { ?>
                                            <option value="<?php echo $row_jenis_pendaftaran['id_pendaftaran']; ?>" name="id_daftar" id="id_daftar">
                                                <?php echo $row_jenis_pendaftaran['keterangan_pendaftaran']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="tanggal_masuk_sekolah" class="col-sm-3 col-form-label">Tanggal Masuk
                                    Sekolah:</label>
                                <div class="col-sm-9">
                                    <input type="date" class="form-control" id="tanggal_masuk_sekolah" name="tanggal_masuk_sekolah" value="<?php echo date("d/m/Y"); ?>">

                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="nomor_induk_mahasiswa" class="col-sm-3 col-form-label">Nomor Induk
                                    Sekolah:</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="nomor_induk_mahasiswa" name="nomor_induk_mahasiswa" placeholder="Masukkan Nomor Induk Sekolah 10 digit">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="nomor_peserta_ujian" class="col-sm-3 col-form-label">Nomor Peserta
                                    Ujian:</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="nomor_peserta_ujian" name="nomor_peserta_ujian" placeholder="Masukkan Nomor Peserta Ujian 20 digit">
                                    <p>Nomor peserta Ujian adalah 20 digit yang tertera dalam sertifikat
                                        <span class="warning">SKHUN
                                            SD</span>, diisi bagi jenjang SMP.
                                    </p>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="apakah_pernah_paud" class="col-sm-3 col-form-label">Apakah Pernah
                                    PAUD:</label>
                                <div class="col-sm-9">
                                    <select class="form-control" id="apakah_pernah_paud" name="apakah_pernah_paud">
                                        <option value="">- Pilih opsi -</option>
                                        <?php
                                        $query_paud = "SELECT * FROM paud";
                                        $result_paud = mysqli_query($koneksi, $query_paud);
                                        while ($row_paud = mysqli_fetch_assoc($result_paud)) {
                                            echo '<option value="' . $row_paud["kode_paud"] . '">' . $row_paud["keterangan"] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="apakah_pernah_tk" class="col-sm-3 col-form-label">Apakah Pernah TK:</label>
                                <div class="col-sm-9">
                                    <select class="form-control" id="apakah_pernah_tk" name="apakah_pernah_tk">
                                        <option value="">- Pilih opsi -</option>
                                        <?php
                                        $query_tk = "SELECT * FROM tk";
                                        $result_tk = mysqli_query($koneksi, $query_tk);
                                        while ($row_tk = mysqli_fetch_assoc($result_tk)) {
                                            echo '<option value="' . $row_tk["kode_tk"] . '">' . $row_tk["keterangan"] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="nomor_seri_skhun_sebelumnya" class="col-sm-3 col-form-label">Nomor Seri
                                    SKHUN Sebelumnya:</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="nomor_seri_skhun_sebelumnya" name="nomor_seri_skhun_sebelumnya" placeholder="Masukkan Nomor Seri SKHUN Sebelumnya">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="nomor_seri_ijazah_sebelumnya" class="col-sm-3 col-form-label">Nomor Seri
                                    Ijazah Sebelumnya:</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="nomor_seri_ijazah_sebelumnya" name="nomor_seri_ijazah_sebelumnya" placeholder="Masukkan Nomor Seri Ijazah Sebelumnya">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="hobi" class="col-sm-3 col-form-label">Hobi:</label>
                                <div class="col-sm-9">
                                    <select class="form-control" id="hobi" name="hobi">
                                        <option value="">- Pilih hobi -</option>
                                        <?php
                                        $query_hobi = "SELECT * FROM hobi";
                                        $result_hobi = mysqli_query($koneksi, $query_hobi);
                                        while ($row_hobi = mysqli_fetch_assoc($result_hobi)) {
                                            echo '<option value="' . $row_hobi["id_hobi"] . '">' . $row_hobi["nama_hobi"] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="cita_cita" class="col-sm-3 col-form-label">Cita-cita:</label>
                                <div class="col-sm-9">
                                    <select class="form-control" id="cita_cita" name="cita_cita">
                                        <option value="">- Pilih cita-cita -</option>
                                        <?php
                                        $query_cita_cita = "SELECT * FROM cita";
                                        $result_cita_cita = mysqli_query($koneksi, $query_cita_cita);
                                        while ($row_cita_cita = mysqli_fetch_assoc($result_cita_cita)) {
                                            echo '<option value="' . $row_cita_cita["id_cita"] . '">' . $row_cita_cita["nama_cita"] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <!-- button untuk submit -->
                            <button type="submit" class="btn btn-primary float-right ml-2" id="submit" name="submit">Next</button>
                            <!-- button reset -->
                            <button type="reset" class="btn btn-danger float-right" name="reset">Reset</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<footer>
    <reserved-by></reserved-by>
</footer>

<script src="js/default.js"></script>

</html>