<?php
    $article = $_GET["article_title"];

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

    //select from mysql
    $sql = "SELECT * FROM `articles` WHERE article_title='".$article."'";
    $result;
    if (!($result=mysqli_query($conn, $sql))) {
        die("select error: " . $sql . "<br>" . mysqli_error($conn));
    }

    $row = mysqli_fetch_assoc($result);

    $article_title = $row["article_title"];
    $description = $row["description"];
    $time = $row["time"];

    echo $article_title."&".$description."&".$time;
?>