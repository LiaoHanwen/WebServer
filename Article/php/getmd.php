<?php
    $article = $_GET["article_title"];
    $filedir = "../../Articles_Storage/".$article."/".$article.".md";

    $file=fopen($filedir,"r") or exit("Unable to open file!");
    while (!feof($file)){
        echo fgetc($file);
    }
    
    fclose($file);
?>