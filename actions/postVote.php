<?php
    require_once("../includes/init.php");
    require_once("../database/timeAgo.php");
    require_once($BASE_DIR."/database/post.php");

    if(isLoggedIn()) {
        if($_POST["action"] == "add") {
            if(postVote($_POST["postID"], $_SESSION["userID"], $_POST["value"]))
                echo display_points(getPostById($_POST["postID"])["points"]);
            else
                echo "failure";
        }
        else if($_POST["action"] == "del") {
            if(removePostVote($_POST["postID"], $_SESSION["userID"]))
                echo display_points(getPostById($_POST["postID"])["points"]);
            else
                echo "failure";
        } 
    }
    else
        echo "NOT SIGNED IN!";
?>