<?php
    require_once($_SERVER["DOCUMENT_ROOT"]."/includes/init.php");
    require_once($_SERVER["DOCUMENT_ROOT"]."/database/comment.php");

    if(isLoggedIn()) {
        if (removeComment($_POST["commentID"]))
            echo "success";
        else
            echo "failure";
    }
    else
        echo "NOT SIGNED IN!";
?>