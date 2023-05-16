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
    $_SESSION['data-ibu'] = [
        'nama_ibu' => $_POST['nama_ibu_kandung'],
        'ibu_tahun_lahir' => $_POST['ibu_tahun_lahir'],
        'ibu_pendidikan_ortu' => $_POST['ibu_pendidikan_ortu'],
        'ibu_pekerjaan_ortu' => $_POST['ibu_pekerjaan_ortu'],
        'ibu_penghasilan_ortu' => $_POST['ibu_penghasilan_ortu'],
        'ibu_berkebutuhan_khusus' => $_POST['ibu_berkebutuhan_khusus'],
    ];

    // Melanjutkan ke halaman data-pribadi.php
    header('Location: proses-pendaftaran.php');
    exit;
}

// Mengecek apakah data-orang-tua sudah ada di session
if (isset($_SESSION['data-ibu'])) {
    // echo "<pre>";
    // print_r($_SESSION['data-ibu']);
    // echo "</pre>";
    // Jika sudah ada, maka data akan disimpan ke dalam variabel
    $nama_ibu = $_SESSION['data-ibu']['nama_ibu'];
    $ibu_tahun_lahir = $_SESSION['data-ibu']['ibu_tahun_lahir'];
    $ibu_pendidikan_ortu = $_SESSION['data-ibu']['ibu_pendidikan_ortu'];
    $ibu_pekerjaan_ortu = $_SESSION['data-ibu']['ibu_pekerjaan_ortu'];
    $ibu_penghasilan_ortu = $_SESSION['data-ibu']['ibu_penghasilan_ortu'];
    $ibu_berkebutuhan_khusus = $_SESSION['data-ibu']['ibu_berkebutuhan_khusus'];
} else {
    // Jika belum ada, maka data akan disimpan dalam variabel kosong
    $nama_ibu = '';
    $ibu_tahun_lahir = '';
    $ibu_pendidikan_ortu = '';
    $ibu_pekerjaan_ortu = '';
    $ibu_penghasilan_ortu = '';
    $ibu_berkebutuhan_khusus = '';
}

// Kembali ke halaman sebelumnya
if (isset($_POST['back'])) {
    header('Location: data-ayah.php');
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
    <title>Formulir Data Orang Tua</title>

</head>

<body>
    <div class="container mt-4 mb-4">
        <?php if (!empty($errors)) :
            foreach ($errors as $error) : ?>
                <div class="alert alert-danger  alert-dismissible fade show mt-2">
                    <?php echo $error; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
        <?php endforeach;
        endif; ?>
        <h1 class="text-center card-header">Formulir Orang Tua</h1>
        <div class="row mt-4">
            <div class="col-sm-12">
                <div class="card mt-3">
                    <h4 class="card-header text-white bg-secondary">DATA IBU KANDUNG</h4>
                    <div class="card-body">
                        <form id="form_pendaftaran" method="post" action="">
                            <div class="form-group row">
                                <label for="nama_ibu_kandung" class="col-sm-3 col-form-label">Nama Ibu
                                    Kandung:</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="nama_ibu_kandung" id="nama_ibu_kandung" placeholder="Masukkan Nama Lengkap" value="<?php echo isset($nama_ibu) ? $nama_ibu : ''; ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="ibu_tahun_lahir" class="col-sm-3 col-form-label">Tahun Lahir:</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="ibu_tahun_lahir" id="ibu_tahun_lahir" placeholder="Masukkan Tahun Lahir Ibu" value="<?php echo isset($ibu_tahun_lahir) ? $ibu_tahun_lahir : ''; ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="ibu_pendidikan_ortu" class="col-sm-3 col-form-label">Pendidikan:</label>
                                <div class="col-sm-9">
                                    <select class="form-control" id="ibu_pendidikan_ortu" name="ibu_pendidikan_ortu">
                                        <option value="">- Pilih Pendidikan -</option>
                                        <?php
                                        $query_pendidikan_ortu = "SELECT * FROM pendidikan_ortu";
                                        $result_pendidikan_ortu = mysqli_query($koneksi, $query_pendidikan_ortu);
                                        while ($row_pendidikan_ortu = mysqli_fetch_assoc($result_pendidikan_ortu)) {
                                            $id_pendidikan_ortu = $row_pendidikan_ortu['id_pendidikan_ortu']; ?>
                                            <option value="<?php echo $row_pendidikan_ortu['id_pendidikan_ortu']; ?>" name="ibu_pendidikan_ortu" id="ibu_pendidikan_ortu" <?php if ($ibu_pendidikan_ortu == $id_pendidikan_ortu) echo 'selected'; ?>>
                                                <?php echo $row_pendidikan_ortu['nama_pendidikan_ortu']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="ibu_pekerjaan_ortu" class="col-sm-3 col-form-label">Pekerjaan:</label>
                                <div class="col-sm-9">
                                    <select class="form-control" id="ibu_pekerjaan_ortu" name="ibu_pekerjaan_ortu">
                                        <option value="">- Pilih Pekerjaan -</option>
                                        <?php
                                        $query_pekerjaan_ortu = "SELECT * FROM pekerjaan_ortu";
                                        $result_pekerjaan_ortu = mysqli_query($koneksi, $query_pekerjaan_ortu);
                                        while ($row_pekerjaan_ortu = mysqli_fetch_assoc($result_pekerjaan_ortu)) {
                                            $id_pekerjaan_ortu = $row_pekerjaan_ortu['id_pekerjaan_ortu']; ?>
                                            <option value="<?php echo $row_pekerjaan_ortu['id_pekerjaan_ortu']; ?>" name="ibu_pekerjaan_ortu" id="ibu_pekerjaan_ortu" <?php if ($ibu_pekerjaan_ortu == $id_pekerjaan_ortu) echo 'selected'; ?>>
                                                <?php echo $row_pekerjaan_ortu['nama_pekerjaan_ortu']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="ibu_penghasilan_ortu" class="col-sm-3 col-form-label">Penghasilan
                                    Bulanan:</label>
                                <div class="col-sm-9">
                                    <select class="form-control" id="ibu_penghasilan_ortu" name="ibu_penghasilan_ortu">
                                        <option value="">- Pilih Penghasilan Bulanan -</option>
                                        <?php
                                        $query_penghasilan_ortu = "SELECT * FROM penghasilan_ortu";
                                        $result_penghasilan_ortu = mysqli_query($koneksi, $query_penghasilan_ortu);
                                        while ($row_penghasilan_ortu = mysqli_fetch_assoc($result_penghasilan_ortu)) {
                                            $id_penghasilan_ortu = $row_penghasilan_ortu['id_penghasilan_ortu']; ?>
                                            <option value="<?php echo $row_penghasilan_ortu['id_penghasilan_ortu']; ?>" name="ibu_penghasilan_ortu" id="ibu_penghasilan_ortu" <?php if ($ibu_penghasilan_ortu == $id_penghasilan_ortu) echo 'selected'; ?>>
                                                <?php echo $row_penghasilan_ortu['jumlah_penghasilan_ortu']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="ibu_berkebutuhan_khusus" class="col-sm-3 col-form-label">Berkebutuhan
                                    Khusus:</label>
                                <div class="col-sm-9">
                                    <select class="form-control" id="ibu_berkebutuhan_khusus" name="ibu_berkebutuhan_khusus">
                                        <option value="">- Pilih opsi -</option>
                                        <?php
                                        $query_kebutuhan_khusus = "SELECT * FROM kebutuhan_khusus";
                                        $result_kebutuhan_khusus = mysqli_query($koneksi, $query_kebutuhan_khusus);
                                        while ($row_kebutuhan_khusus = mysqli_fetch_assoc($result_kebutuhan_khusus)) {
                                            $id_kebutuhan_khusus = $row_kebutuhan_khusus['id_kebutuhan_khusus']; ?>
                                            <option value="<?php echo $row_kebutuhan_khusus['id_kebutuhan_khusus']; ?>" name="ibu_berkebutuhan_khusus" id="ibu_berkebutuhan_khusus" <?php if ($ibu_berkebutuhan_khusus == $id_kebutuhan_khusus) echo 'selected'; ?>>
                                                <?php echo $row_kebutuhan_khusus['nama_kebutuhan_khusus']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <!-- button untuk lanjut -->
                            <button type="submit" class="btn btn-primary float-right ml-2" id="submit" name="submit">Next</button>
                            <!-- button untuk kembali -->
                            <button type="submit" class="btn btn-primary float-right ml-2" id="back" name="back">Back</button>
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