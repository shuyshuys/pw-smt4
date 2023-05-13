<?php
// memanggil file auth.php
require_once "auth/auth.php";
include "auth/koneksi.php";

if (!is_authenticated()) {
    // Redirect ke halaman dashboard
    header('Location: auth/login.php');
    exit();
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
                    <div class="card-body">
                        <form id="form_pendaftaran" method="post" action="proses_pendaftaran.php">
                            <div class="form-group row">
                                <label for="jenis_pendaftaran" class="col-sm-3 col-form-label">Jenis
                                    Pendaftaran:</label>
                                <div class="col-sm-9">
                                    <select class="form-control" id="jenis_pendaftaran" name="jenis_pendaftaran">
                                        <option value="">Pilih jenis pendaftaran</option>
                                        <?php
                                        $query_jenis_pendaftaran = "SELECT * FROM jenis_pendaftaran";
                                        $result_jenis_pendaftaran = mysqli_query($koneksi, $query_jenis_pendaftaran);
                                        while ($row_jenis_pendaftaran = mysqli_fetch_assoc($result_jenis_pendaftaran)) { ?>
                                        <option value="<?php echo $row_jenis_pendaftaran['id_pendaftaran']; ?>"
                                            name="id_daftar" id="id_daftar">
                                            <?php echo $row_jenis_pendaftaran['keterangan_pendaftaran']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="tanggal_masuk_sekolah" class="col-sm-3 col-form-label">Tanggal Masuk
                                    Sekolah:</label>
                                <div class="col-sm-9">
                                    <input type="date" class="form-control" id="tanggal_masuk_sekolah"
                                        name="tanggal_masuk_sekolah" value="<?php echo date("d/m/Y"); ?>">

                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="nomor_induk_mahasiswa" class="col-sm-3 col-form-label">Nomor Induk
                                    Mahasiswa:</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="nomor_induk_mahasiswa"
                                        name="nomor_induk_mahasiswa">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="nomor_peserta_ujian" class="col-sm-3 col-form-label">Nomor Peserta
                                    Ujian:</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="nomor_peserta_ujian"
                                        name="nomor_peserta_ujian">

                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="apakah_pernah_paud" class="col-sm-3 col-form-label">Apakah Pernah
                                    PAUD:</label>
                                <div class="col-sm-9">
                                    <select class="form-control" id="apakah_pernah_paud" name="apakah_pernah_paud">
                                        <option value="">Pilih opsi</option>
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
                                        <option value="">Pilih opsi</option>
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
                                    <input type="text" class="form-control" id="nomor_seri_skhun_sebelumnya"
                                        name="nomor_seri_skhun_sebelumnya">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="nomor_seri_ijazah_sebelumnya" class="col-sm-3 col-form-label">Nomor Seri
                                    Ijazah Sebelumnya:</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="nomor_seri_ijazah_sebelumnya"
                                        name="nomor_seri_ijazah_sebelumnya">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="hobi" class="col-sm-3 col-form-label">Hobi:</label>
                                <div class="col-sm-9">
                                    <select class="form-control" id="hobi" name="hobi">
                                        <option value="">Pilih hobi</option>
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
                                        <option value="">Pilih cita-cita</option>
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
                            <button type="submit" class="btn btn-primary float-right ml-2" name="submit">Next</button>
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