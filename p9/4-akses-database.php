<html>

<head>
    <title>Akses Database MySQL</title>
</head>

<body>
    <?php
    $servername = "sql308.epizy.com";
    $username = "epiz_33929470";
    $password = "Xii0ChiqoTMvRa2";
    $dbname = "epiz_33929470_mydb";

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