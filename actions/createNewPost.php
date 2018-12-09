<?php
    require_once($_SERVER["DOCUMENT_ROOT"]."/includes/init.php");
    require_once($_SERVER["DOCUMENT_ROOT"]."/database/post.php");

    if(isLoggedIn()) {
        if (($newPostID = addPost($_SESSION["userID"], $_POST["title"], $_POST["content"])) != -1)
            echo $newPostID;
        else
            echo "failure";
    }
    else
        echo "NOT SIGNED IN!";
?>