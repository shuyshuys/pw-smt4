<?php
// Import string koneksi ke database
include('database.php');

// Mengecek koneksi
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

// Proses simpan data
if (isset($_POST['submit'])) {
    // Menangkap data yang dikirimkan dari form
    $nama = $_POST['nama_buat'];
    $id_jabatan = $_POST['jabatan_buat'];

    // Menyimpan data ke tabel
    $sql = "INSERT INTO pegawai (nama_pegawai, id_jabatan) VALUES ('$nama', '$id_jabatan')";
    if (mysqli_query($con, $sql)) {
        echo "<div class='alert alert-success'>Data berhasil disimpan.</div>";
    } else {
        echo "<div class='alert alert-danger'>Terjadi kesalahan saat menyimpan data: " . mysqli_error($con) . "</div>";
    }
}

// Proses mengubah data
if (isset($_POST['change'])) {
    // Menangkap data yang dikirimkan dari form
    $id = $_POST['id_ubah'];
    $nama = $_POST['nama_ubah'];
    $jabatan = $_POST['jabatan_ubah'];

    // Menyimpan data ke tabel
    $sql = "UPDATE pegawai SET nama_pegawai='$nama', id_jabatan='$jabatan' WHERE id_pegawai='$id'";

    // Memunculkan pesan sukses/error
    if (mysqli_query($con, $sql)) {
        echo "<div class='alert alert-success'>Data berhasil disimpan.</div>";
    } else {
        echo "<div class='alert alert-danger'>Terjadi kesalahan saat menyimpan data: " . mysqli_error($con) . "</div>";
    }
}

// Memeriksa apakah tombol Hapus telah ditekan
if (isset($_GET['delete_id'])) {
    // Mendapatkan id_bt yang dipilih
    $id = $_GET['delete_id'];

    // Menghapus data dari tabel
    $sql = "DELETE FROM pegawai WHERE id_pegawai = $id";

    // Memunculkan pesan sukses/error
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
    <title>Data Pegawai</title>
</head>

<body>
    <div class="container">
        <a href="../index.html" class="btn btn-info mt-2">Back</a>
        <h1 class="mt-2">Form Pegawai</h1>
        <!-- Form tambah data -->
        <div class="row mt-2">
            <?php
            $query_jabatan = "SELECT * FROM jabatan";
            $result_jabatan = mysqli_query($con, $query_jabatan);
            ?>
            <div class="col-sm-6 mx-auto">
                <div class="card-header text-white bg-secondary text-center">
                    Tambah Data Pegawai
                </div>
                <div class="card px-5">
                    <form method="POST">
                        <!-- Label nama pegawai -->
                        <div class="form-group mt-3">
                            <label for="nama">Nama</label>
                            <input type="text" class="form-control" id="nama_buat" name="nama_buat" required>
                        </div>
                        <!-- Label jabatan pegawai berupa dropdown -->
                        <div class="form-group">
                            <label for="text">Jabatan</label>
                            <select class="form-control" id="jabatan_buat" name="jabatan_buat">
                                <option value="">- Pilih Jabatan -</option>
                                <?php while ($row_jabatan = mysqli_fetch_assoc($result_jabatan)) { ?>
                                    <option value="<?php echo $row_jabatan['id_jabatan']; ?>" name="jabatan_buat" id="jabatan_buat">
                                        <?php echo $row_jabatan['nama_jabatan']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <!-- Label gaji pegawai -->
                        <div class="form-group">
                            <label for="gaji">Gaji</label>
                            <input class="form-control" id="gaji_buat" name="gaji_buat" readonly value=""></input>
                        </div>
                        <!-- Tombol submit -->
                        <button type="submit" class="btn btn-primary mb-3" name="submit">Tambah</button>
                    </form>
                </div>
            </div>
            <div class="col-sm-6 mx-auto">
                <div class="card-header text-white bg-secondary text-center">
                    Ubah Data Pegawai
                </div>
                <div class="card px-5">
                    <form method="POST">
                        <!-- Label id pegawai -->
                        <div class="form-group mt-3">
                            <label for="nama">ID</label>
                            <input type="text" class="form-control" id="id_ubah" name="id_ubah" readonly>
                        </div>
                        <!-- Label nama pegawai -->
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" class="form-control" id="nama_ubah" name="nama_ubah" required>
                        </div>
                        <?php
                        // Menampilkan data jabatan ke dalam dropdown
                        $query_jabatan = "SELECT * FROM jabatan";
                        $result_jabatan = mysqli_query($con, $query_jabatan);
                        ?>
                        <!-- Label Jabatan berupa dropdown -->
                        <div class="form-group">
                            <label for="text">Jabatan</label>
                            <select class="form-control" id="jabatan_ubah" name="jabatan_ubah">
                                <option value="">- Pilih Jabatan -</option>
                                <?php while ($row_jabatan = mysqli_fetch_assoc($result_jabatan)) { ?>
                                    <option value="<?php echo $row_jabatan['id_jabatan']; ?>" name="jabatan_ubah" id="jabatan_ubah">
                                        <?php echo $row_jabatan['nama_jabatan']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <!-- Label Gaji pegawai -->
                        <div class="form-group">
                            <label for="isi">Gaji</label>
                            <input class="form-control" id="gaji_ubah" name="gaji" readonly value=""></input>
                        </div>
                        <button type="submit" class="btn btn-primary mb-3" name="change">Ubah</button>
                    </form>
                </div>
            </div>
        </div>
        <hr>
        <h1 class="mb-3">Daftar Pegawai</h1>
        <!-- Tabel daftar pegawai -->
        <table class="table mx-auto">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>NAMA</th>
                    <th>JABATAN</th>
                    <th>ACTION</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Menampilkan data pegawai dari database
                $sql = "SELECT id_pegawai, nama_pegawai, nama_jabatan, gaji_pokok, j.id_jabatan FROM pegawai p JOIN jabatan j WHERE p.id_jabatan = j.id_jabatan ORDER BY id_pegawai ASC";
                $result = mysqli_query($con, $sql);

                // Menampilkan data pegawai ke dalam tabel
                while ($row = mysqli_fetch_array($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['id_pegawai'] . "</td>";
                    echo "<td>" . $row['nama_pegawai'] . "</td>";
                    echo "<td>" . $row['nama_jabatan'] . "</td>";
                    echo "<td>
                <button class='btn btn-primary' data-toggle='modal' data-target='#myModal' data-id='" . $row['id_pegawai'] . "'
                data-nama='" . $row['nama_pegawai'] . "' data-jabatan='" . $row['nama_jabatan'] . "' data-gaji='" . $row['gaji_pokok'] . "'>Tampilkan Data</button>
                <a onclick='fillForm(" . $row['id_pegawai'] . "," . $row['id_jabatan'] . ")' class='btn btn-warning'>Edit</a>
                <a href='?delete_id=$row[id_pegawai]' class='btn btn-danger'>Hapus</a>
                </td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
        <hr>
        <!-- Modal button tampilkan data -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Detail Pegawai</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>ID: <span id="modal-id"></span></p>
                        <p>Nama: <span id="modal-nama"></span></p>
                        <p>Jabatan: <span id="modal-jabatan"></span></p>
                        <p>Gaji Pokok: <span id="modal-gaji"></span></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>

        <script src="js/jquery-3.6.3.min.js"></script>
        <script src="js/popper.min.js"></script>
        <script src="js/bootstrap.js"></script>
        <script>
            // Script untuk menampilkan data pegawai ke dalam modal
            $('#myModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget)
                var id_bt = button.data('id')
                var nama_bt = button.data('nama')
                var jabatan = button.data('jabatan')
                var gaji = button.data('gaji')
                var modal = $(this)
                modal.find('#modal-id').text(id_bt)
                modal.find('#modal-nama').text(nama_bt)
                modal.find('#modal-jabatan').text(jabatan)
                modal.find('#modal-gaji').text(gaji)
            })

            // Script untuk mengisi form edit pegawai 
            function fillForm(id, jabatan) {
                console.log(id);
                document.getElementById("id_ubah").value = id;
                var dropdown = document.getElementById("jabatan_ubah");
                dropdown.value = jabatan;
                var event = new Event('change');
                dropdown.dispatchEvent(event);
                document.getElementById("nama_ubah").focus();
                window.scrollTo(0, 0);
            }

            // Menambahkan event listener untuk dropdown
            document.getElementById("jabatan_ubah").addEventListener("change", function() {
                // Mendapatkan nilai id_jabatan yang dipilih
                var id_jabatan = this.value;
                // Mengirim request AJAX ke file PHP untuk mendapatkan gaji berdasarkan id_jabatan
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        // Mengisi nilai gaji dengan hasil request AJAX
                        document.getElementById("gaji_ubah").value = this.responseText;
                    }
                };
                // Mengirim request AJAX
                xmlhttp.open("GET", "get_gaji.php?id_jabatan=" + id_jabatan, true);
                xmlhttp.send();
            });

            // Menambahkan event listener untuk dropdown
            document.getElementById("jabatan_buat").addEventListener("change", function() {
                // Mendapatkan nilai id_jabatan yang dipilih
                var id_jabatan = this.value;
                console.log(id_jabatan);
                // Mengirim request AJAX ke file PHP untuk mendapatkan gaji berdasarkan id_jabatan
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        // Mengisi nilai gaji dengan hasil request AJAX
                        document.getElementById("gaji_buat").value = this.responseText;
                    }
                };
                // Mengirim request AJAX
                xmlhttp.open("GET", "get_gaji.php?id_jabatan=" + id_jabatan, true);
                xmlhttp.send();

            });
        </script>
</body>

<footer>
    <!-- memanggil footer menggunakan component javascript -->
    <footer-component></footer-component>
</footer>

<script src="../default.js"></script>

</html>