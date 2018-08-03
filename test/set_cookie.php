<?php
    $expire=time()+60*60*24*365;
    setcookie("cookie_test", "true", $expire);
?>