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
        if(file_exists($dir_new)){
            die("error: original file does not exsit");
        }else{
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
    } else {
        die("$ArticleTitle has existed");
    }

    // //delete origin file    (untested)
    // if($OriginTitle != "")
    // {
    //     $sql_delete = "DELETE FROM `articles` WHERE `articles`.`article_title` = '".$OriginTitle."' ";
    //     if (!mysqli_query($conn, $sql_delete)) {
    //         echo "delete error: " . $sql_delete . "<br>" . mysqli_error($conn);
    //     }

    //     //copy pictures
    //     $source_pic_dir = $dir_delete."/pictures";
    //     $dest_pic_dir = $dir_new."/pictures";
    //     function copydir($source, $dest)
    //     {
    //         if (!file_exists($dest)) mkdir($dest);
    //         $handle = opendir($source);
    //         while (($item = readdir($handle)) !== false) {
    //             if ($item == '.' || $item == '..') continue;
    //             $_source = $source . '/' . $item;
    //             $_dest = $dest . '/' . $item;
    //             if (is_file($_source)) copy($_source, $_dest);
    //             if (is_dir($_source)) copydir($_source, $_dest);
    //         }
    //         closedir($handle);
    //     }
    //     copydir($source_pic_dir,$dest_pic_dir);

    //     //delete origin file
    //     function rmdirs($path)
    //     {
    //         $handle = opendir($path);
    //         while (($item = readdir($handle)) !== false) {
    //             if ($item == '.' || $item == '..') continue;
    //             $_path = $path . '/' . $item;
    //             if (is_file($_path)) unlink($_path);
    //             if (is_dir($_path)) rmdirs($_path);
    //         }
    //         closedir($handle);
    //         return rmdir($path);
    //     }
    //     rmdirs($dir_delete);
    // }

    mysqli_close($conn);
?>
