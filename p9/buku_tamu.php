<?php
// Import string koneksi ke database
include('database.php');
// $servername = "localhost";
// $username = "root";
// $password = "";
// $dbname = "buku_tamu";

// Membuat koneksi
$con = mysqli_connect($servername, $username, $password, $dbname);

// Mengecek koneksi
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

// Proses simpan data
if (isset($_POST['submit'])) {
    // Menangkap data yang dikirimkan dari form
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $isi = $_POST['isi'];

    // Menyimpan data ke tabel
    $sql = "INSERT INTO buku_tamu (nama, email, isi) VALUES ('$nama', '$email', '$isi')";
    if (mysqli_query($con, $sql)) {
        echo "<div class='alert alert-success'>Data berhasil disimpan.</div>";
    } else {
        echo "<div class='alert alert-danger'>Terjadi kesalahan saat menyimpan data: " . mysqli_error($con) . "</div>";
    }

    // Menutup Koneksi
    // mysqli_close($conn);
}

// Proses mengubah data
if (isset($_POST['change'])) {
    // Menangkap data yang dikirimkan dari form
    $id_bt = $_POST['id_ubah'];
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $isi = $_POST['isi'];

    // Menyimpan data ke tabel
    $sql = "UPDATE buku_tamu SET nama='$nama', email='$email', isi='$isi' WHERE id_bt=$id_bt";
    if (mysqli_query($con, $sql)) {
        echo "<div class='alert alert-success'>Data berhasil disimpan.</div>";
    } else {
        echo "<div class='alert alert-danger'>Terjadi kesalahan saat menyimpan data: " . mysqli_error($con) . "</div>";
    }
}

// Memeriksa apakah tombol Hapus telah ditekan
if (isset($_GET['delete_id'])) {
    // Mendapatkan id_bt yang dipilih
    $id_bt = $_GET['delete_id'];

    // Menghapus data dari tabel
    $sql = "DELETE FROM buku_tamu WHERE id_bt = $id_bt";
    if (mysqli_query($con, $sql)) {
        echo "<div class='alert alert-success'>Data berhasil dihapus.</div>";
    } else {
        echo "<div class='alert alert-danger'>Terjadi kesalahan saat menghapus data: " . mysqli_error($con) . "</div>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <style>
        * {
            scroll-behavior: smooth;
        }
    </style>
    <title>Buku Tamu</title>
</head>

<body>
    <div class="container">
        <a href="../index.html" class="btn btn-info mt-2">Back</a>
        <h1 class="mb-3 mt-3">Daftar Buku Tamu</h1>
        <table class="table mx-auto">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>NAMA</th>
                    <th>EMAIL</th>
                    <th>ISI</th>
                    <th>ACTION</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM buku_tamu";
                $result = mysqli_query($con, $sql);
                while ($row = mysqli_fetch_array($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['id_bt'] . "</td>";
                    echo "<td>" . $row['nama'] . "</td>";
                    echo "<td>" . $row['email'] . "</td>";
                    echo "<td>" . $row['isi'] . "</td>";
                    echo "<td>
                <button class='btn btn-primary' data-toggle='modal' data-target='#myModal' data-id='" . $row['id_bt'] . "'
                data-nama='" . $row['nama'] . "' data-isi='" . $row['isi'] . "'>Tampilkan Data</button>
                <a onclick='fillForm(" . $row['id_bt'] . ")' class='btn btn-warning'>Edit</a>
                <a href='?delete_id=$row[id_bt]' class='btn btn-danger'>Hapus</a>
                </td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Detail Tamu</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>ID: <span id="modal-id"></span></p>
                        <p>Nama: <span id="modal-nama"></span></p>
                        <p>Keterangan: <span id="modal-isi"></span></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form tambah data -->
        <h1 class="mt-2">Form Buku Tamu</h1>
        <div class="row mt-3">
            <div class="col-sm-6 mx-auto">
                <div class="card-header text-white bg-secondary text-center">
                    Tambah Data Tamu
                </div>
                <div class="card px-5">
                    <form method="POST">
                        <div class="form-group mt-3">
                            <label for="nama">Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="isi">Isi</label>
                            <textarea class="form-control" id="isi" name="isi" rows="3" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary mb-2" name="submit">Tambah</button>
                    </form>
                </div>
            </div>
            <div class="col-sm-6 mx-auto">
                <div class="card-header text-white bg-secondary text-center">
                    Ubah Data Tamu
                </div>
                <div class="card px-5">
                    <form method="POST">
                        <div class="form-group mt-3">
                            <label for="nama">ID</label>
                            <input type="text" class="form-control" id="id_ubah" name="id_ubah" readonly>
                        </div>
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" class="form-control" id="nama_ubah" name="nama" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email_ubah" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="isi">Isi</label>
                            <textarea class="form-control" id="isi_ubah" name="isi" rows="3" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary mb-2" name="change">Ubah</button>
                    </form>
                </div>
            </div>
        </div>
</body>
<footer>
    <footer-component></footer-component>

    <script src="../default.js"></script>

    <script src="js/jquery-3.6.3.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <script>
        // Modal controller
        $('#myModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id_bt = button.data('id')
            var nama_bt = button.data('nama')
            var isi = button.data('isi')
            var modal = $(this)
            modal.find('#modal-id').text(id_bt)
            modal.find('#modal-nama').text(nama_bt)
            modal.find('#modal-isi').text(isi)
        })

        // Fill form for table
        function fillForm(id) {
            console.log(id);
            document.getElementById("id_ubah").value = id;
            document.getElementById("nama_ubah").focus();
            window.scrollTo(0, 0);
        }
    </script>
</footer>

</html>