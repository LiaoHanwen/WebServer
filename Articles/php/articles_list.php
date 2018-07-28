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

    //select from mysql
    $sql = "SELECT * FROM articles;";
    $result;
    if (!($result=mysqli_query($conn, $sql))) {
        die("select error: " . $sql . "<br>" . mysqli_error($conn));
    }

    //make html
    while($row = mysqli_fetch_assoc($result)) {
        $article_title = $row["article_title"];
        $description = $row["description"];
        $time = $row["time"];
        echo <<<EOF
        <div class="media text-muted pt-3">
            <a href="/Article/?article=$article_title" class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                <strong class="text-gray-dark big-text">$article_title</strong>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$time<br>
                $description
            </a>
        </div>
EOF;
    }
?>