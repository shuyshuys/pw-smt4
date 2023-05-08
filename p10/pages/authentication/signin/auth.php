<?php
session_start();
require('../../../koneksi.php');
$username = $_POST['username'];
$password = $_POST['password'];
$query = "SELECT * FROM userlogin WHERE username='$username' AND password ='$password'";
$login = mysqli_query($koneksi, $query);
$cek = mysqli_num_rows($login);
if ($cek > 0) {
    $data = mysqli_fetch_array($login);

    $_SESSION['username'] = $data['username'];
    header("location:../../../index.php");
} else {
    echo "<h1>ERROR</h1>";
}
