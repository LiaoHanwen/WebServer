<?php
    $title = $_GET["article_title"];
    $dir_delete = "../../Articles_Storage/".$title;

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

    function del_dir($dir) {
        if (!is_dir($dir)) {
            return false;
        }
        $handle = opendir($dir);
        while (($file = readdir($handle)) !== false) {
            if ($file != "." && $file != "..") {
                is_dir("$dir/$file") ? del_dir("$dir/$file") : @unlink("$dir/$file");
            }
        }
        if (readdir($handle) == false) {
            closedir($handle);
            @rmdir($dir);
        }
    }

    //delete
    if($title != ""){
        if(!file_exists($dir_delete)){
            die("error: original file does not exsit");
        }else{
            del_dir($dir_delete);

            //delete from mysql
            $sql_delete = "DELETE FROM `articles` WHERE `articles`.`article_title` = '".$title."' ";
            if (!mysqli_query($conn, $sql_delete)) {
                echo "delete error: " . $sql_delete . "<br>" . mysqli_error($conn);
            }

            echo "delete < $title > success";
        }
    }

    mysqli_close($conn);
?>
