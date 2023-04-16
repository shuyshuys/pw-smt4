<?php
session_start();

// Cek apakah user sudah login
if (!isset($_SESSION['nama'])) {
    header("Location: form-login.php");
    exit();
}

// Menampilkan informasi terkait user login
echo "<h1>Welcome, " . $_SESSION['nama'] . "!</h1>";
echo "Email: " . $_SESSION['email'] . "<br><br>";
echo "Login Time: " . $_SESSION['jam'] . " " . $_SESSION['hari'] . ", " . $_SESSION['tanggal'];

if (isset($_POST['logout'])) {
    // menghilangkan semua dari sesi variabel
    $_SESSION = array();

    // Menutup sesi
    session_destroy();

    // Redirect user ke halaman form-login.php
    header("Location: form-login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../default.css">
    <title>Dashboard page</title>
</head>

<body class="container-medium">
    <br><br>
    <form method="POST" action="">
        <!-- Menambahkan button untuk logout -->
        <button type="submit" name="logout">Logout</button>
    </form>

</body>

</html>