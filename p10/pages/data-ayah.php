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
    $_SESSION['data-ayah'] = [
        'nama_ayah' => $_POST['nama_ayah_kandung'],
        'ayah_tahun_lahir' => $_POST['ayah_tahun_lahir'],
        'ayah_pendidikan_ortu' => $_POST['ayah_pendidikan_ortu'],
        'ayah_pekerjaan_ortu' => $_POST['ayah_pekerjaan_ortu'],
        'ayah_penghasilan_ortu' => $_POST['ayah_penghasilan_ortu'],
        'ayah_berkebutuhan_khusus' => $_POST['ayah_berkebutuhan_khusus']
    ];

    // membuat variable error untuk menampung pesan kesalahan
    $errors = [];
    if (!preg_match("/^[0-9]{4}$/", $_POST['ayah_tahun_lahir'])) {
        $error_no_telp = "Tahun lahir harus berupa angka dan berjumlah 4 digit";
        $errors[] = $error_no_telp;
    }

    // if empty $errors, continue
    if (empty($errors)) {
        // Redirect ke halaman selanjutnya
        header('Location: data-ibu.php');
        exit();
    }
}

// Mengecek apakah data-orang-tua sudah ada di session
if (isset($_SESSION['data-ayah'])) {
    // echo "<pre>";
    // print_r($_SESSION['data-ayah']);
    // echo "</pre>";
    // Jika sudah ada, maka data akan disimpan ke dalam variabel
    $nama_ayah = $_SESSION['data-ayah']['nama_ayah'];
    $ayah_tahun_lahir = $_SESSION['data-ayah']['ayah_tahun_lahir'];
    $ayah_pendidikan_ortu = $_SESSION['data-ayah']['ayah_pendidikan_ortu'];
    $ayah_pekerjaan_ortu = $_SESSION['data-ayah']['ayah_pekerjaan_ortu'];
    $ayah_penghasilan_ortu = $_SESSION['data-ayah']['ayah_penghasilan_ortu'];
    $ayah_berkebutuhan_khusus = $_SESSION['data-ayah']['ayah_berkebutuhan_khusus'];
} else {
    // Jika belum ada, maka data akan disimpan dalam variabel kosong
    $nama_ayah = '';
    $ayah_tahun_lahir = '';
    $ayah_pendidikan_ortu = '';
    $ayah_pekerjaan_ortu = '';
    $ayah_penghasilan_ortu = '';
    $ayah_berkebutuhan_khusus = '';
}

// Kembali ke halaman sebelumnya
if (isset($_POST['back'])) {
    header('Location: data-pribadi.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- cdn bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .warning {
            color: #FF0000;
        }
    </style>
    <title>Formulir Data Orang Tua</title>

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
        <h1 class="text-center card-header">Formulir Orang Tua</h1>
        <div class="row mt-4">
            <div class="col-sm-12">
                <div class="card">
                    <h4 class="card-header text-white bg-secondary">DATA AYAH KANDUNG</h4>
                    <div class="card-body">
                        <form id="form_pendaftaran" method="post" action="">
                            <div class="form-group row mb-2">
                                <label for="nama_ayah_kandung" class="col-sm-3 col-form-label">Nama Ayah
                                    Kandung:</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="nama_ayah_kandung" id="nama_ayah_kandung" placeholder="Masukkan Nama Lengkap" value="<?php echo isset($nama_ayah) ? $nama_ayah : ''; ?>">
                                </div>
                            </div>
                            <div class="form-group row mb-2">
                                <label for="ayah_tahun_lahir" class="col-sm-3 col-form-label">Tahun Lahir:</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="ayah_tahun_lahir" id="ayah_tahun_lahir" placeholder="Masukkan Tahun Lahir Ayah" value="<?php echo isset($ayah_tahun_lahir) ? $ayah_tahun_lahir : ''; ?>">
                                </div>
                            </div>
                            <div class="form-group row mb-2">
                                <label for="ayah_pendidikan_ortu" class="col-sm-3 col-form-label">Pendidikan:</label>
                                <div class="col-sm-9">
                                    <select class="form-control" id="ayah_pendidikan_ortu" name="ayah_pendidikan_ortu">
                                        <option value="">- Pilih Pendidikan -</option>
                                        <?php
                                        $query_pendidikan_ortu = "SELECT * FROM pendidikan_ortu";
                                        $result_pendidikan_ortu = mysqli_query($koneksi, $query_pendidikan_ortu);
                                        while ($row_pendidikan_ortu = mysqli_fetch_assoc($result_pendidikan_ortu)) {
                                            $id_pendidikan_ortu = $row_pendidikan_ortu['id_pendidikan_ortu'];
                                        ?>
                                            <option value="<?php echo $row_pendidikan_ortu['id_pendidikan_ortu']; ?>" name=" ayah_pendidikan_ortu" id="ayah_pendidikan_ortu" <?php if ($ayah_pendidikan_ortu == $id_pendidikan_ortu) echo 'selected'; ?>>
                                                <?php echo $row_pendidikan_ortu['nama_pendidikan_ortu']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row mb-2">
                                <label for="ayah_pekerjaan_ortu" class="col-sm-3 col-form-label">Pekerjaan:</label>
                                <div class="col-sm-9">
                                    <select class="form-control" id="ayah_pekerjaan_ortu" name="ayah_pekerjaan_ortu">
                                        <option value="">- Pilih Pekerjaan -</option>
                                        <?php
                                        $query_pekerjaan_ortu = "SELECT * FROM pekerjaan_ortu";
                                        $result_pekerjaan_ortu = mysqli_query($koneksi, $query_pekerjaan_ortu);
                                        while ($row_pekerjaan_ortu = mysqli_fetch_assoc($result_pekerjaan_ortu)) {
                                            $id_pekerjaan_ortu = $row_pekerjaan_ortu['id_pekerjaan_ortu'];
                                        ?>
                                            <option value="<?php echo $row_pekerjaan_ortu['id_pekerjaan_ortu']; ?>" name="ayah_pekerjaan_ortu" id="ayah_pekerjaan_ortu" <?php if ($ayah_pekerjaan_ortu == $id_pekerjaan_ortu) echo 'selected'; ?>>
                                                <?php echo $row_pekerjaan_ortu['nama_pekerjaan_ortu']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row mb-2">
                                <label forayah_="ayah_penghasilan_ortu" class="col-sm-3 col-form-label">Penghasilan
                                    Bulanan:</label>
                                <div class="col-sm-9">
                                    <select class="form-control" id="ayah_penghasilan_ortu" name="ayah_penghasilan_ortu">
                                        <option value="">- Pilih Penghasilan Bulanan -</option>
                                        <?php
                                        $query_penghasilan_ortu = "SELECT * FROM penghasilan_ortu";
                                        $result_penghasilan_ortu = mysqli_query($koneksi, $query_penghasilan_ortu);
                                        while ($row_penghasilan_ortu = mysqli_fetch_assoc($result_penghasilan_ortu)) {
                                            $id_penghasilan_ortu = $row_penghasilan_ortu['id_penghasilan_ortu'];
                                        ?>
                                            <option value="<?php echo $row_penghasilan_ortu['id_penghasilan_ortu']; ?>" name="ayah_penghasilan_ortu" id="ayah_penghasilan_ortu" <?php if ($ayah_penghasilan_ortu == $id_penghasilan_ortu) echo 'selected'; ?>>
                                                <?php echo $row_penghasilan_ortu['jumlah_penghasilan_ortu']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row mb-2">
                                <label for="ayah_berkebutuhan_khusus" class="col-sm-3 col-form-label">Berkebutuhan
                                    Khusus:</label>
                                <div class="col-sm-9">
                                    <select class="form-control" id="ayah_berkebutuhan_khusus" name="ayah_berkebutuhan_khusus">
                                        <option value="">- Pilih opsi -</option>
                                        <?php
                                        $query_kebutuhan_khusus = "SELECT * FROM kebutuhan_khusus";
                                        $result_kebutuhan_khusus = mysqli_query($koneksi, $query_kebutuhan_khusus);
                                        while ($row_kebutuhan_khusus = mysqli_fetch_assoc($result_kebutuhan_khusus)) {
                                            $id_kebutuhan_khusus = $row_kebutuhan_khusus['id_kebutuhan_khusus'];
                                        ?>
                                            <option value="<?php echo $row_kebutuhan_khusus['id_kebutuhan_khusus']; ?>" name="ayah_kebutuhan_khusus" id="ayah_kebutuhan_khusus" <?php if ($ayah_berkebutuhan_khusus == $id_kebutuhan_khusus) echo 'selected'; ?>>
                                                <?php echo $row_kebutuhan_khusus['nama_kebutuhan_khusus']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <!-- button untuk lanjut -->
                            <button type="submit" class="btn btn-primary float-end mx-1" id="submit" name="submit">Next</button>
                            <!-- button untuk kembali -->
                            <button type="submit" class="btn btn-primary float-end mx-1" id="back" name="back">Back</button>
                            <!-- button reset -->
                            <button type="reset" class="btn btn-danger float-end mx-1" name="reset">Reset</button>
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js"></script>


</html>