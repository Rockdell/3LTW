<?php
    require_once($_SERVER["DOCUMENT_ROOT"]."/includes/init.php");
    require_once($_SERVER["DOCUMENT_ROOT"]."/database/post.php");

    if(isLoggedIn()) {
        if($_POST["action"] == "add") {
            if(postVote($_POST["postID"], $_SESSION["userID"], $_POST["value"])) {
                if($_POST["value"] === "0")
                    echo "-1";
                else
                    echo "+1";
            }
            else
                echo "failure";
        }
        else if($_POST["action"] == "del") {
            if(removePostVote($_POST["postID"], $_SESSION["userID"])) {
                if($_POST["value"] === "0")
                    echo "+1";
                else
                    echo "-1";
            }
            else
                echo "failure";
        } 
    }
    else
        echo "NOT SIGNED IN!";
?>