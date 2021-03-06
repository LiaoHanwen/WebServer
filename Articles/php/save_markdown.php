<?php
    $OriginTitle = $_POST["OriginTitle"];
    $ArticleTitle = $_POST["ArticleTitle"];
    $Discription = $_POST["Discription"];
    $MarkDown = $_POST["MarkDown"];
    
    $dir_new = "../../Articles_Storage/".$ArticleTitle;
    $dir_delete = "../../Articles_Storage/".$OriginTitle;

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

    //rename folder
    if($OriginTitle != ""){
        if(!file_exists($dir_delete)){
            die("error: original file does not exsit");
        }else{
            //mysql find time
            $sql_get_time = "SELECT time,description FROM articles WHERE article_title='".$OriginTitle."'";
            $result;
            if (!($result=mysqli_query($conn, $sql_get_time))) {
                die("count error: " . $sql . "<br>" . mysqli_error($conn));
            }
            $row = mysqli_fetch_assoc($result);
            $d = strtotime($row["time"]);
            $time = date("Y-m-d H-i-s", $d);
            $dis = $row["description"];

            //rename file
            $file_old = $dir_delete."/".$OriginTitle.".md";
            $file_rename = $dir_delete."/".$time." && ".$OriginTitle." && ".$dis.".md";
            rename($file_old,$file_rename);

            rename($dir_delete,$dir_new);

            //delete from mysql
            $sql_delete = "DELETE FROM `articles` WHERE `articles`.`article_title` = '".$OriginTitle."' ";
            if (!mysqli_query($conn, $sql_delete)) {
                echo "delete error: " . $sql_delete . "<br>" . mysqli_error($conn);
            }
        }
    }

    //save new file
    $file_new = $dir_new."/".$ArticleTitle.".md";
    if (!file_exists($dir_new)){
        mkdir ($dir_new,0777,true);
    }

    $fp=fopen($file_new,"w+") or die("Unable to open file_new!");
    fwrite($fp,$MarkDown); 
    fclose($fp);
    
    //insert to mysql
    $sql = "INSERT INTO articles (article_title, description, time)
    VALUES ('".$ArticleTitle."', '".$Discription."', '".date("Y-m-d H:i:s")."')";

    if (mysqli_query($conn, $sql)) {
        echo "save < $ArticleTitle > success";
    } else {
        die("insert error: " . $sql . "<br>" . mysqli_error($conn));
    }

    mysqli_close($conn);
?>
