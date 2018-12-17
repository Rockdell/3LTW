<?php
    require_once("../includes/init.php");
    require_once($BASE_DIR."/database/utils.php");
    require_once($BASE_DIR."/database/comment.php");

    if ($_SERVER["REQUEST_METHOD"] == "GET" && realpath(__FILE__) == realpath( $_SERVER["SCRIPT_FILENAME"] )) {
        header("Location: ../pages/error-404.php");
        return;
    }

    if(isLoggedIn()) {

        if($_POST["action"] == "add") {
            if(commentVote($_POST["commentID"], $_SESSION["userID"], $_POST["value"]))
                echo display_points(getCommentById($_POST["commentID"])["points"]);
            else
                echo "failure";
        }
        else if($_POST["action"] == "del") {
            if(removeCommentVote($_POST["commentID"], $_SESSION["userID"]))
                echo display_points(getCommentById($_POST["commentID"])["points"]);
            else
                echo "failure";
        }
    }
    else {
        echo "NOT SIGNED IN!";
    }
?>