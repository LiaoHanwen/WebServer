<?php
    $user = $_POST["username"];
    $pass = $_POST["password"];

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
    $sql = "SELECT password FROM user Where username='".$user."'";
    $result;
    if (!($result=mysqli_query($conn, $sql))) {
        die("count error: " . $sql . "<br>" . mysqli_error($conn));
    }
    if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_assoc($result);
        if($pass == $row["password"]){
            echo "true";
            $expire=time()+60*60*24*365;
            setcookie("permission", "true", $expire,'/');
        }else{
            echo "incorrect password";
        }
    }else{
        echo "username does not exsit";
    }

?>