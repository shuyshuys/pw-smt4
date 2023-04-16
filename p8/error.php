<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../default.css">
    <title>Error Page</title>
</head>

<body class="container-medium">
    <h1>ERROR</h1>
    <!-- Mengambil pesan dari halaman sebelumnya -->
    <p><?= $_GET['pesan'] ?></p>
    <!-- Membuat link href agar dapat kembali ke halaman login -->
    <button><a href="form-login.php" style="text-decoration: none;">Kembali ke halaman login</a></button>
</body>

</html>