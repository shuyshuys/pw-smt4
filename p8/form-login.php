<?php
// mengincludekan inc-data-validation yang akan digunakan untuk form post login
include('inc-data-validation.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Halaman Login</title>
    <link rel="stylesheet" href="../default.css">
</head>

<body class="container-medium">
    <!-- Action dikosongi agar memproses dari halaman ini -->
    <form method="POST" action="">
        <h1>Tugas Form Login</h1>
        <label for="nama">Nama:</label>
        <input placeholder="Masukkan Nama" type="text" name="nama" id="nama"><br><br>

        <label for="email">Email:</label>
        <input placeholder="Masukkan Email" type="email" name="email" id="email"><br><br>

        <button type="submit" value="submit" name="submit">Submit</button>
        <input type="reset" value="reset" class="btn">
    </form>
</body>

</html>