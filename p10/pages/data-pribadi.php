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
    $_SESSION['data-pribadi'] = [
        'nama_lengkap' => $_POST['nama_lengkap'],
        'jenis_kelamin' => $_POST['jenis_kelamin'],
        'nisn' => $_POST['nisn'],
        'nik' => $_POST['nik'],
        'tanggal_lahir' => $_POST['tanggal_lahir'],
        'agama' => $_POST['agama'],
        'berkebutuhan_khusus' => $_POST['berkebutuhan_khusus'],
        'alamat' => $_POST['alamat'],
        'rt' => $_POST['rt'],
        'rw' => $_POST['rw'],
        'nama_dusun' => $_POST['nama_dusun'],
        'nama_kelurahan' => $_POST['nama_kelurahan'],
        'kode_pos' => $_POST['kode_pos'],
        'tempat_tinggal' => $_POST['tempat_tinggal'],
        'moda_transportasi' => $_POST['moda_transportasi'],
        'nomor_hp' => $_POST['nomor_hp'],
        'nomor_telepon' => $_POST['nomor_telepon'],
        'email' => $_POST['email'],
        'penerima_kps' => $_POST['penerima_kps'],
        'nomor_kps' => $_POST['nomor_kps'],
        'kewarganegaraan' => $_POST['kewarganegaraan'],
        'nama_negara' => $_POST['nama_negara']
    ];

    // Melanjutkan ke halaman data-pribadi.php
    header('Location: data-orang-tua.php');
    exit;
}

// Kembali ke halaman sebelumnya
if (isset($_POST['back'])) {
    header('Location: registrasi.php');
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
    <title>Formulir Data Pribadi</title>

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
        <h1 class="text-center card-header">Formulir Data Pribadi</h1>
        <div class="row mt-4">
            <div class="col-sm-12">
                <div class="card">
                    <h4 class="card-header text-white bg-secondary">DATA PRIBADI</h4>
                    <div class="card-body">
                        <form id="form_pendaftaran" method="post" action="">
                            <div class="form-group row">
                                <label for="nama_lengkap" class="col-sm-3 col-form-label">Nama Lengkap:</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="nama_lengkap" id="nama_lengkap"
                                        placeholder="Masukkan Nama Lengkap">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="jenis_kelamin" class="col-sm-3 col-form-label">Jenis
                                    Kelamin:</label>
                                <div class="col-sm-9">
                                    <select class="form-control" id="jenis_pendaftaran" name="jenis_pendaftaran">
                                        <option value="">- Pilih jenis kelamin -</option>
                                        <?php
                                        $query_jenis_kelamin = "SELECT * FROM jenis_kelamin";
                                        $result_jenis_kelamin = mysqli_query($koneksi, $query_jenis_kelamin);
                                        while ($row_jenis_kelamin = mysqli_fetch_assoc($result_jenis_kelamin)) { ?>
                                        <option value="<?php echo $row_jenis_kelamin['kode_jenis_kelamin']; ?>"
                                            name="jenis_kelamin" id="jenis_kelamin">
                                            <?php echo $row_jenis_kelamin['nama_jenis_kelamin']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="nisn" class="col-sm-3 col-form-label">NISN:</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="nisn" name="nisn"
                                        placeholder="Masukkan NISN 10 digit">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="nik" class="col-sm-3 col-form-label">NIK:</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="nik" name="nik"
                                        placeholder="Masukkan NIK 16 digit">

                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="tanggal_lahir" class="col-sm-3 col-form-label">Tanggal Lahir:</label>
                                <div class="col-sm-9">
                                    <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="agama" class="col-sm-3 col-form-label">Agama:</label>
                                <div class="col-sm-9">
                                    <select class="form-control" id="agama" name="agama">
                                        <option value="">- Pilih opsi -</option>
                                        <?php
                                        $query_agama = "SELECT * FROM agama";
                                        $result_agama = mysqli_query($koneksi, $query_agama);
                                        while ($row_agama = mysqli_fetch_assoc($result_agama)) {
                                            echo '<option name="agama" id="agama" value="' . $row_agama["id_agama"] . '">' . $row_agama["nama_agama"] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="berkebutuhan_khusus" class="col-sm-3 col-form-label">Berkebutuhan
                                    Khusus:</label>
                                <div class="col-sm-9">
                                    <select class="form-control" id="berkebutuhan_khusus" name="berkebutuhan_khusus">
                                        <option value="">- Pilih opsi -</option>
                                        <?php
                                        $query_kebutuhan_khusus = "SELECT * FROM kebutuhan_khusus";
                                        $result_kebutuhan_khusus = mysqli_query($koneksi, $query_kebutuhan_khusus);
                                        while ($row_kebutuhan_khusus = mysqli_fetch_assoc($result_kebutuhan_khusus)) {
                                            echo '<option name="berkebutuhan_khusus" id="berkebutuhan_khusus" value="' . $row_kebutuhan_khusus["id_kebutuhan_khusus"] . '">' . $row_kebutuhan_khusus["nama_kebutuhan_khusus"] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="alamat" class="col-sm-3 col-form-label">Alamat:</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="alamat" name="alamat">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="rt" class="col-sm-3 col-form-label">RT:</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="rt" name="rt">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="rw" class="col-sm-3 col-form-label">RW:</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="rw" name="rw">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="nama_dusun" class="col-sm-3 col-form-label">Nama Dusun:</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="nama_dusun" name="nama_dusun">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="nama_kelurahan" class="col-sm-3 col-form-label">Nama Kelurahan/Desa:</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="nama_kelurahan" name="nama_kelurahan">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="kecamatan" class="col-sm-3 col-form-label">Kecamatan:</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="kecamatan" name="kecamatan">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="kode_pos" class="col-sm-3 col-form-label">Kode Pos:</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="kode_pos" name="kode_pos">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="tempat_tinggal" class="col-sm-3 col-form-label">Tempat Tinggal:</label>
                                <div class="col-sm-9">
                                    <select class="form-control" id="tempat_tinggal" name="tempat_tinggal">
                                        <option value="">- Pilih opsi -</option>
                                        <?php
                                        $query_tempat_tinggal = "SELECT * FROM tempat_tinggal";
                                        $result_tempat_tinggal = mysqli_query($koneksi, $query_tempat_tinggal);
                                        while ($row_tempat_tinggal = mysqli_fetch_assoc($result_tempat_tinggal)) {
                                            echo '<option name="tempat_tinggal" id="tempat_tinggal" value="' . $row_tempat_tinggal["id_tempat_tinggal"] . '">' . $row_tempat_tinggal["nama_tempat_tinggal"] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="moda_transportasi" class="col-sm-3 col-form-label">Moda
                                    Transportasi:</label>
                                <div class="col-sm-9">
                                    <select class="form-control" id="moda_transportasi" name="moda_transportasi">
                                        <option value="">- Pilih opsi -</option>
                                        <?php
                                        $query_moda_transportasi = "SELECT * FROM moda_transportasi";
                                        $result_moda_transportasi = mysqli_query($koneksi, $query_moda_transportasi);
                                        while ($row_moda_transportasi = mysqli_fetch_assoc($result_moda_transportasi)) {
                                            echo '<option name="moda_transportasi" id="moda_transportasi"  value="' . $row_moda_transportasi["id_moda_transportasi"] . '">' . $row_moda_transportasi["nama_moda_transportasi"] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="nomor_hp" class="col-sm-3 col-form-label">Nomor
                                    HP:</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="nomor_hp" name="nomor_hp">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="nomor_telepon" class="col-sm-3 col-form-label">Nomor Telepon
                                    Rumah:</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="nomor_telepon" name="nomor_telepon">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email" class="col-sm-3 col-form-label">Email
                                    Pribadi:</label>
                                <div class="col-sm-9">
                                    <input type="email" class="form-control" id="email" name="email">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="penerima_kps" class="col-sm-3 col-form-label">Penerima
                                    KPS/PKH/KIP:</label>
                                <div class="col-sm-9">
                                    <input type="radio" class="" id="penerima_kps" name="penerima_kps"> test
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="nomor_kps" class="col-sm-3 col-form-label">No.
                                    KPS/KKS/PKH/KIP:</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" id="nomor_kps" name="nomor_kps">
                                </div>
                                <div class="col-sm-2 warning">
                                    <p>*) apabila menerima</p>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="kewarganegaraan" class="col-sm-3 col-form-label">Kewarganegaraan:</label>
                                <div class="col-sm-5">
                                    <?php
                                    $query_kewarganegaraan = "SELECT * FROM kewarganegaraan";
                                    $result_kewarganegaraan = mysqli_query($koneksi, $query_kewarganegaraan);
                                    while ($row_kewarganegaraan = mysqli_fetch_assoc($result_kewarganegaraan)) {
                                        echo '<input name="kewarganegaraan" id="kewarganegaraan" type=radio class="mr-1 ml-2" value="' . $row_kewarganegaraan["kode_kewarganegaraan"] . '">' . $row_kewarganegaraan["keterangan"] . '</input>';
                                    }
                                    ?>
                                </div>
                                <label for="nama-negara" class="col-sm-2 col-form-label">Nama Negara:</label>
                                <input type="text" class="form-control col-sm-1 col-form-label" id="nama_negara"
                                    name="nama_negara">
                            </div>

                            <!-- button untuk lanjut -->
                            <button type="submit" class="btn btn-primary float-right ml-2" id="submit"
                                name="submit">Next</button>
                            <!-- button untuk kembali -->
                            <button type="submit" class="btn btn-primary float-right ml-2" id="back"
                                name="back">Back</button>
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