<?php
include 'auth.php';

if (isset($_POST['submit-register'])) {
    $id = $_POST['id'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (empty($id) || empty($username) || empty($password)) {
        $error_message = "USERNAME atau PASSWORD tidak boleh kosong!";
    } else if (register($id, $username, $password)) {
        header('Location: login.php');
        exit();
    }
}
