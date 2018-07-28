<?php
$ArticleTitle = "article";
$Discription = "des";
$sql = "INSERT INTO articles (article_title, description, time)
        VALUES ('".$ArticleTitle."', '".$Discription."', '".date("Y-m-d H:i:s")."')";
echo $sql;
?>