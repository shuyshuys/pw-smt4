<html>

<head>
    <title>Koneksi Database MySQL</title>

</head>

<body>
    <h1>Demo Koneksi database MySQL</h1>
    <?php
    $con = mysqli_connect('sql308.epizy.com', 'epiz_33929470', 'Xii0ChiqoTMvRa2', 'epiz_33929470_db_sakila');

    // Check connection
    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
    ?>
</body>

</html>