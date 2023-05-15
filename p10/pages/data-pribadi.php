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
        'kecamatan' => $_POST['kecamatan'],
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

    // Membuat variabel errors untuk mengisi pesan error
    $errors = [];
    if (!preg_match("/^[0-9]{10}$/", $_POST['nisn'])) {
        $error_nisn = "NISN harus terdiri dari 10 digit angka.";
        $errors[] = $error_nisn;
    }
    if (!preg_match("/^[0-9]{16}$/", $_POST['nik'])) {
        $error_nik = "NIK harus terdiri dari 16 digit angka.";
        $errors[] = $error_nik;
    }
    if (!preg_match("/^[0-9]{2,3}$/", $_POST['rt'])) {
        $error_rt = "RT harus terdiri dari 2 atau 3 digit angka.";
        $errors[] = $error_rt;
    }
    if (!preg_match("/^[0-9]{2,3}$/", $_POST['rw'])) {
        $error_rw = "RW harus terdiri dari 2 atau 3 digit angka.";
        $errors[] = $error_rw;
    }
    if (!preg_match("/^[0-9]{5,}$/", $_POST['kode_pos'])) {
        $error_kode_pos = "Nomor kode pos harus terdiri dari setidaknya 5 digit angka.";
        $errors[] = $error_kode_pos;
    }
    if (!preg_match("/^62(\d{9,})$/", $_POST['nomor_hp'])) {
        $error_nomor_hp = "Nomor HP harus diawali dengan 62 dan terdiri dari setidaknya 10 digit angka.";
        $errors[] = $error_nomor_hp;
    }
    if (!preg_match("/^0(\d{8,})$/", $_POST['nomor_telepon'])) {
        $error_nomor_telepon = "Nomor telepon harus diawali dengan 0 dan terdiri dari setidaknya 9 digit angka.";
        $errors[] = $error_nomor_telepon;
    }
    if (!preg_match("/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/", $_POST['email'])) {
        $error_email = "Email tidak valid.";
        $errors[] = $error_email;
    }

    // mengubah format nomor telepon
    //$nomor_telepon_formatted = preg_replace("/^\+62(\d{3})(\d{4})(\d{4})$/", "+62-$1-$2-$3", $_POST['nomor_telepon']);

    // menampilkan nomor telepon dalam form input
    // <input type="text" name="nomor_telepon" value="<?php echo $nomor_telepon_formatted;> " class="form-control" required>

    // if empty $errors, continue
    if (empty($errors)) {
        // Redirect ke halaman selanjutnya
        header('Location: data-ayah.php');
        exit();
    }
}

// Mengecek data apakah sudah ada di session
if (isset($_SESSION['data-pribadi'])) {
    // echo "<pre>";
    // print_r($_SESSION['data-pribadi']);
    // echo "</pre>";
    // Jika sudah ada, maka data akan diambil dari session
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
    $kecamatan = $_SESSION['data-pribadi']['kecamatan'];
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
} else {
    // Jika belum ada, maka data akan diisi dengan data kosong
    $nama_lengkap = '';
    $jenis_kelamin = '';
    $nisn = '';
    $nik = '';
    $tanggal_lahir = '';
    $agama = '';
    $berkebutuhan_khusus = '';
    $alamat = '';
    $rt = '';
    $rw = '';
    $nama_dusun = '';
    $nama_kelurahan = '';
    $kecamatan = '';
    $kode_pos = '';
    $tempat_tinggal = '';
    $moda_transportasi = '';
    $nomor_hp = '';
    $nomor_telepon = '';
    $email = '';
    $penerima_kps = '';
    $nomor_kps = '';
    $kewarganegaraan = '';
    $nama_negara = '';
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
    <!-- cdn bootstrap v5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .warning {
            color: #FF0000;
        }
    </style>
    <title>Formulir Data Pribadi</title>

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
        <h1 class="text-center card-header">Formulir Data Pribadi</h1>
        <div class="row mt-4">
            <div class="col-sm-12">
                <div class="card">
                    <h4 class="card-header text-white bg-secondary">DATA PRIBADI</h4>
                    <div class="card-body">
                        <form id="form_pendaftaran" method="post" action="">
                            <div class="form-group row mb-2">
                                <label for="nama_lengkap" class="col-sm-3 col-form-label">Nama Lengkap:</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="nama_lengkap" id="nama_lengkap" placeholder="Masukkan Nama Lengkap" value="<?php echo isset($nama_lengkap) ? $nama_lengkap : ''; ?>">
                                </div>
                            </div>
                            <div class=" form-group row mb-2">
                                <label for="jenis_kelamin" class="col-sm-3 col-form-label">Jenis
                                    Kelamin:</label>
                                <div class="col-sm-9">
                                    <select class="form-control" id="jenis_kelamin" name="jenis_kelamin">
                                        <option value="">- Pilih jenis kelamin -</option>
                                        <?php
                                        $query_jenis_kelamin = "SELECT * FROM jenis_kelamin";
                                        $result_jenis_kelamin = mysqli_query($koneksi, $query_jenis_kelamin);
                                        while ($row_jenis_kelamin = mysqli_fetch_assoc($result_jenis_kelamin)) {
                                            $kode_jenis_kelamin = $row_jenis_kelamin['kode_jenis_kelamin'];
                                        ?>
                                            <option value="<?php echo $row_jenis_kelamin['kode_jenis_kelamin']; ?>" name="jenis_kelamin" id="jenis_kelamin" <?php if ($jenis_kelamin == $kode_jenis_kelamin) echo 'selected'; ?>>
                                                <?php echo $row_jenis_kelamin['nama_jenis_kelamin']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row mb-2">
                                <label for="nisn" class="col-sm-3 col-form-label">NISN:</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="nisn" name="nisn" placeholder="Masukkan NISN 10 digit" value="<?php echo isset($nisn) ? $nisn : ''; ?>">
                                </div>
                            </div>
                            <div class=" form-group row mb-2">
                                <label for="nik" class="col-sm-3 col-form-label">NIK:</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="nik" name="nik" placeholder="Masukkan NIK 16 digit" value="<?php echo isset($nik) ? $nik : ''; ?>">

                                </div>
                            </div>
                            <div class=" form-group row mb-2">
                                <label for="tanggal_lahir" class="col-sm-3 col-form-label">Tanggal
                                    Lahir:</label>
                                <div class="col-sm-9">
                                    <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" value="<?php echo isset($tanggal_lahir) ? $tanggal_lahir : ''; ?>">
                                </div>
                            </div>
                            <div class=" form-group row mb-2">
                                <label for="agama" class="col-sm-3 col-form-label">Agama:</label>
                                <div class="col-sm-9">
                                    <select class="form-control" id="agama" name="agama">
                                        <option value="">- Pilih opsi -</option>
                                        <?php
                                        $query_agama = "SELECT * FROM agama";
                                        $result_agama = mysqli_query($koneksi, $query_agama);
                                        while ($row_agama = mysqli_fetch_assoc($result_agama)) {
                                            $id_agama = $row_agama['id_agama'];

                                            if ($agama == $id_agama) {
                                                $selected = "selected";
                                            } else {
                                                $selected = "";
                                            }
                                            echo '<option name="agama" id="agama" value="' . $row_agama["id_agama"] . '"' . $selected . '>' . $row_agama["nama_agama"] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row mb-2">
                                <label for="berkebutuhan_khusus" class="col-sm-3 col-form-label">Berkebutuhan
                                    Khusus:</label>
                                <div class="col-sm-9">
                                    <select class="form-control" id="berkebutuhan_khusus" name="berkebutuhan_khusus">
                                        <option value="">- Pilih opsi -</option>
                                        <?php
                                        $query_kebutuhan_khusus = "SELECT * FROM kebutuhan_khusus";
                                        $result_kebutuhan_khusus = mysqli_query($koneksi, $query_kebutuhan_khusus);
                                        while ($row_kebutuhan_khusus = mysqli_fetch_assoc($result_kebutuhan_khusus)) {
                                            $id_kebutuhan_khusus = $row_kebutuhan_khusus['id_kebutuhan_khusus'];

                                            if ($berkebutuhan_khusus == $id_kebutuhan_khusus) {
                                                $selected = "selected";
                                            } else {
                                                $selected = "";
                                            }
                                            echo '<option name="berkebutuhan_khusus" id="berkebutuhan_khusus" value="' . $row_kebutuhan_khusus["id_kebutuhan_khusus"] . '" ' . $selected . '>' . $row_kebutuhan_khusus["nama_kebutuhan_khusus"] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row mb-2">
                                <label for="alamat" class="col-sm-3 col-form-label">Alamat:</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Masukkan Alamat" value="<?php echo isset($alamat) ? $alamat : ''; ?>">
                                </div>
                            </div>
                            <div class="form-group row mb-2">
                                <label for="rt" class="col-sm-3 col-form-label">RT:</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="rt" name="rt" placeholder="Masukkan RT" value="<?php echo isset($rt) ? $rt : ''; ?>">
                                </div>
                            </div>
                            <div class=" form-group row mb-2">
                                <label for="rw" class="col-sm-3 col-form-label">RW:</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="rw" name="rw" placeholder="Masukkan RW" value="<?php echo isset($rw) ? $rw : ''; ?>">
                                </div>
                            </div>
                            <div class=" form-group row mb-2">
                                <label for="nama_dusun" class="col-sm-3 col-form-label">Nama
                                    Dusun:</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="nama_dusun" name="nama_dusun" placeholder="Masukkan Nama Dusun" value="<?php echo isset($nama_dusun) ? $nama_dusun : ''; ?>">
                                </div>
                            </div>
                            <div class=" form-group row mb-2">
                                <label for="nama_kelurahan" class="col-sm-3 col-form-label">Nama
                                    Kelurahan/Desa:</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="nama_kelurahan" name="nama_kelurahan" placeholder="Masukkan Nama Kelurahan/Desa" value="<?php echo isset($nama_kelurahan) ? $nama_kelurahan : ''; ?>">
                                </div>
                            </div>
                            <div class="form-group row mb-2">
                                <label for="kecamatan" class="col-sm-3 col-form-label">Kecamatan:</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="kecamatan" name="kecamatan" placeholder="Masukkan Kecamatan" value="<?php echo isset($kecamatan) ? $kecamatan : ''; ?>">
                                </div>
                            </div>
                            <div class="form-group row mb-2">
                                <label for="kode_pos" class="col-sm-3 col-form-label">Kode
                                    Pos:</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="kode_pos" name="kode_pos" placeholder="Masukkan Kode Pos" value="<?php echo isset($kode_pos) ? $kode_pos : ''; ?>">
                                </div>
                            </div>
                            <div class="form-group row mb-2">
                                <label for="tempat_tinggal" class="col-sm-3 col-form-label">Tempat
                                    Tinggal:</label>
                                <div class="col-sm-9">
                                    <select class="form-control" id="tempat_tinggal" name="tempat_tinggal">
                                        <option value="">- Pilih opsi -</option>
                                        <?php
                                        $query_tempat_tinggal = "SELECT * FROM tempat_tinggal";
                                        $result_tempat_tinggal = mysqli_query($koneksi, $query_tempat_tinggal);
                                        while ($row_tempat_tinggal = mysqli_fetch_assoc($result_tempat_tinggal)) {
                                            $id_tempat_tinggal = $row_tempat_tinggal['id_tempat_tinggal'];

                                            if ($tempat_tinggal == $id_tempat_tinggal) {
                                                $selected = "selected";
                                            } else {
                                                $selected = "";
                                            }
                                            echo '<option name="tempat_tinggal" id="tempat_tinggal" value="' . $row_tempat_tinggal["id_tempat_tinggal"] . '"' . $selected  . '>' . $row_tempat_tinggal["nama_tempat_tinggal"] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row mb-2">
                                <label for="moda_transportasi" class="col-sm-3 col-form-label">Moda
                                    Transportasi:</label>
                                <div class="col-sm-9">
                                    <select class="form-control" id="moda_transportasi" name="moda_transportasi">
                                        <option value="">- Pilih opsi -</option>
                                        <?php
                                        $query_moda_transportasi = "SELECT * FROM moda_transportasi";
                                        $result_moda_transportasi = mysqli_query($koneksi, $query_moda_transportasi);
                                        while ($row_moda_transportasi = mysqli_fetch_assoc($result_moda_transportasi)) {
                                            $id_moda_transportasi = $row_moda_transportasi['id_moda_transportasi'];

                                            if ($moda_transportasi == $id_moda_transportasi) {
                                                $selected = "selected";
                                            } else {
                                                $selected = "";
                                            }
                                            echo '<option name="moda_transportasi" id="moda_transportasi"  value="' . $row_moda_transportasi["id_moda_transportasi"] . '"' . $selected . '>' . $row_moda_transportasi["nama_moda_transportasi"] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row mb-2">
                                <label for="nomor_hp" class="col-sm-3 col-form-label">Nomor
                                    HP:</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="nomor_hp" name="nomor_hp" placeholder="Masukkan Nomor HP" value="<?php echo isset($nomor_hp) ? $nomor_hp : ''; ?>">
                                </div>
                            </div>
                            <div class="form-group row mb-2">
                                <label for="nomor_telepon" class="col-sm-3 col-form-label">Nomor
                                    Telepon
                                    Rumah:</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="nomor_telepon" name="nomor_telepon" placeholder="Masukkan Nomor Telepon Rumah" value="<?php echo isset($nomor_telepon) ? $nomor_telepon : ''; ?>">
                                </div>
                            </div>
                            <div class="form-group row mb-2">
                                <label for="email" class="col-sm-3 col-form-label">Email
                                    Pribadi:</label>
                                <div class="col-sm-9">
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan Email Pribadi" value="<?php echo isset($email) ? $email : ''; ?>">
                                </div>
                            </div>
                            <div class="form-group row mb-2">
                                <label for="penerima_kps" class="col-sm-3 col-form-label">Penerima
                                    KPS/PKH/KIP:</label>
                                <div class="col-sm-9">
                                    <?php
                                    $query_kps = "SELECT * FROM kps_kks_pkh_kip";
                                    $result_kps = mysqli_query($koneksi, $query_kps);
                                    while ($row_kps = mysqli_fetch_assoc($result_kps)) {
                                        $id_kps = $row_kps['kode_kps_kks_pkh_kip'];

                                        if ($penerima_kps == $id_kps) {
                                            $checked = "checked";
                                        } else {
                                            $checked = "";
                                        }
                                        echo '<input type="radio" class="mx-2" name="penerima_kps" id="penerima_kps" value="' . $row_kps["kode_kps_kks_pkh_kip"] . '"' . $checked . '>' . $row_kps["keterangan"] . '</input>';
                                    }
                                    ?>

                                </div>
                            </div>
                            <div class="form-group row mb-2">
                                <label for="nomor_kps" class="col-sm-3 col-form-label">No.
                                    KPS/KKS/PKH/KIP:</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" id="nomor_kps" name="nomor_kps" placeholder="Masukkan Nomor KPS/KKS/PKH/KIP" value="<?php echo isset($nomor_kps) ? $nomor_kps : ''; ?>">
                                </div>
                                <div class="col-sm-2 warning">
                                    <p>*) apabila menerima</p>
                                </div>
                            </div>
                            <div class="form-group row mb-2">
                                <label for="kewarganegaraan" class="col-sm-3 col-form-label">Kewarganegaraan:</label>
                                <div class="col-sm-5">
                                    <?php
                                    $query_kewarganegaraan = "SELECT * FROM kewarganegaraan";
                                    $result_kewarganegaraan = mysqli_query($koneksi, $query_kewarganegaraan);
                                    while ($row_kewarganegaraan = mysqli_fetch_assoc($result_kewarganegaraan)) {
                                        $id_kewarganegaraan = $row_kewarganegaraan['kode_kewarganegaraan'];

                                        if ($kewarganegaraan == $id_kewarganegaraan) {
                                            $checked = "checked";
                                        } else {
                                            $checked = "";
                                        }
                                        echo '<input ' . $selected . 'name="kewarganegaraan" id="kewarganegaraan" type=radio class="mx-2" value="' . $row_kewarganegaraan["kode_kewarganegaraan"] . '"' . $checked . '>' . $row_kewarganegaraan["keterangan"] . '</input>';
                                    }
                                    ?>
                                </div>
                                <div class="col-sm-4">
                                    <label for="nama-negara" class="col-form-label">Nama Negara:</label>
                                    <input type="text" class="form-control" id="nama_negara" name="nama_negara" value="<?php echo isset($nama_negara) ? $nama_negara : ''; ?>">
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