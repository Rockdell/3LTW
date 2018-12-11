<?php
    require_once("../includes/init.php");
    require_once($BASE_DIR."/database/comment.php");

    if(isLoggedIn()) {
        if (removeComment($_POST["commentID"]))
            echo "success";
        else
            echo "failure";
    }
    else
        echo "NOT SIGNED IN!";
?>