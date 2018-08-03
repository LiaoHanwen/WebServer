<?php
    if (isset($_COOKIE["cookie_test"])){
        echo $_COOKIE["cookie_test"];
    }else{
        echo "cookie does not set";
    }
    
?>