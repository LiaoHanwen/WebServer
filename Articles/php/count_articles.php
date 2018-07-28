<?php
    //connect to mysql
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "webserver";

    $conn = mysqli_connect($servername, $username, $password, $dbname);
    //test connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    //count from mysql
    $sql = "SELECT COUNT(*) AS NUM FROM articles;";
    $result;
    if (!($result=mysqli_query($conn, $sql))) {
        die("count error: " . $sql . "<br>" . mysqli_error($conn));
    }
    $row = mysqli_fetch_assoc($result);
    echo $row["NUM"];
?>