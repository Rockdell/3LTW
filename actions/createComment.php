<?php
    require_once("../includes/init.php");
    require_once($BASE_DIR."/database/comment.php");

    if ($_SERVER["REQUEST_METHOD"] == "GET" && realpath(__FILE__) == realpath( $_SERVER["SCRIPT_FILENAME"] )) {
        header("Location: ../pages/error-404.php");
    }

    if (isLoggedIn()) {

        if ($_POST["content"] == null || strlen(trim($_POST["content"])) === 0) {
            echo "Funny guy...";
        } 
        else {
            if (strlen($_POST["content"]) > 120)
                echo "Keep it short, will ya?";
            else if (bindCommentToComment($_POST["postID"], $_SESSION["userID"], htmlspecialchars($_POST["content"]), $_POST["fatherCommentID"]))
                echo "success";
            else
                echo "failure";
        }
    }
    else {
        echo "NOT SIGNED IN!";
    }
?>