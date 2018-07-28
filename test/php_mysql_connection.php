<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "webserver";
    
// 创建连接
$conn = mysqli_connect($servername, $username, $password, $dbname);

// 检测连接
if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
} 
echo "连接成功";

$sql = "INSERT INTO articles (article_title, description, time)
        VALUES ('new title','dis~','2018-5-9 12:05:33')";
    
        if (mysqli_query($conn, $sql)) {
            echo "insert success";
        } else {
            echo "insert error: " . $sql . "<br>" . mysqli_error($conn);
        }
?>