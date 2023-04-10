<?php
if (empty($_POST['nama'])) {
    header("Location:8-kosong.php");
} else {
    echo "<center>Nama : " . $_POST['nama'] . "</center><br>";
}
