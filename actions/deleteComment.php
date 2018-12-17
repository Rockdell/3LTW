<?php
    require_once("../includes/init.php");
    require_once($BASE_DIR."/database/comment.php");

    if ($_SERVER["REQUEST_METHOD"] == "GET" && realpath(__FILE__) == realpath( $_SERVER["SCRIPT_FILENAME"] )) {
        header("Location: ../pages/error-404.php");
        return;
    }
    
    if(isLoggedIn()) {

        if (removeComment($_POST["commentID"]))
            echo "success";
        else
            echo "failure";
    }
    else {
        echo "NOT SIGNED IN!";
    }
?>