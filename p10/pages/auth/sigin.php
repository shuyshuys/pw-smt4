<?php
// memanggil file auth.php
require_once "auth.php";

if (isset($_POST['submit-login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (authenticate($username, $password)) {
        // Redirect ke halaman registrasi peserta didik baru
        header('Location: ../registrasi.php');
        exit();
    } else {
        $error_message = "USERNAME atau PASSWORD salah!";
        echo $error_message;
    }
} else {
    $error_message = "suhdu";
    echo $error_message;
}