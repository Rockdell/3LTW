<?php
    require_once("../includes/init.php");

    if ($_SERVER["REQUEST_METHOD"] == "GET" && realpath(__FILE__) == realpath( $_SERVER["SCRIPT_FILENAME"] )) {
        header("Location: ../pages/error-404.php");
        return;
    }

    if (isLoggedIn()) {
        
        session_destroy();
        session_start();

        echo "success";
    }    
    else {
        echo "NOT SIGNED IN!";
    }
?>