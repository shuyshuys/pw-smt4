<html>

<head>
    <title>Akses Database MySQL</title>
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

    $sql = "SELECT kode, negara, champion FROM liga";
    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while ($row = mysqli_fetch_assoc($result)) {
            echo "kode: " . $row["kode"] . " - Negara: " . $row["negara"] . " " . $row["champion"] . "<br>";
        }
    } else {
        echo "0 results";
    }
    ?>
</body>

</html>