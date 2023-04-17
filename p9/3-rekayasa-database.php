<html>

<head>
    <title>Rekaayasa Database MySQL</title>

</head>

<body>
    <?php
    $servername = "mysql.freehostia.com";
    $username = "shuset2_shuya";
    $password = "2WkeWFn8GaBP8pJ";
    $dbname = "shuset2_shuya";

    // Create connection
    $con = mysqli_connect($servername, $username, $password, $dbname);

    // Check connection
    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }

    // Drop table if it exists
    if (mysqli_query($con, "DROP TABLE IF EXISTS liga")) {
        echo "Table liga deleted successfully <br><br>";
    } else {
        echo "Error deleting table: " . mysqli_error($con);
    }

    // Create table
    $sql = "CREATE TABLE liga (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        kode VARCHAR(3) NOT NULL,
        negara VARCHAR(30) NOT NULL,
        champion int(3)
        )";

    if (mysqli_query($con, $sql)) {
        echo "Table liga created successfully <br><br>";
    } else {
        echo "Error creating table: " . mysqli_error($con);
    }

    $sql = "INSERT INTO liga (kode, negara, champion)
    VALUES ('Jer', 'Jerman', '4')";

    if (mysqli_query($con, $sql)) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($con);
    }

    mysqli_close($con);
    ?>
</body>

</html>