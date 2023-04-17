<html>

<head>
    <title>Koneksi Database MySQL</title>

</head>

<body>
    <h1>Demo Koneksi database MySQL</h1>
    <?php
    $con = mysqli_connect('mysql.freehostia.com', 'shuset2_shuya', '2WkeWFn8GaBP8pJ', 'shuset2_shuya');

    // Check connection
    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
    ?>
</body>

</html>