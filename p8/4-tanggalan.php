<html>

<head>
    <title>Tanggalan</title>
</head>
<?php
echo "<br>";
$timezone = date_default_timezone_get();
echo "Timezone in this server: " . $timezone . "<br>";
echo date("m-F-Y, g:i:s a") . "<br>"; //membaca tanggal sekarang di server
echo "<br>";
date_default_timezone_set('Asia/Jakarta');
$mytimezone = date_default_timezone_get();
echo "Timezone in my country: " . $mytimezone . "<br>";
echo date("m-F-Y, g:i:s a"); //membaca tanggal sekarang di negara saya
?>

</html>