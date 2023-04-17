<html>

<head>
    <title>Membuat Database MySQL</title>

</head>

<body>
    <?php
    $servername = "mysql.freehostia.com";
    $username = "shuset2_shuya";
    $password = "2WkeWFn8GaBP8pJ";
    $con = mysqli_connect($servername, $username, $password);

    // Check connection
    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }

    // Create database
    $sql = "CREATE DATABASE myDB";
    if (mysqli_query($con, $sql)) {
        echo "Database created successfully";
    } else {
        echo "Error creating database: " . mysqli_error($con);
    }
    ?>
</body>

</html>