<?php
    require_once($_SERVER["DOCUMENT_ROOT"]."/includes/init.php");
    require_once($_SERVER["DOCUMENT_ROOT"]."/database/post.php");

    if(isLoggedIn()) {

        if (getPostById($_POST["postID"])["content"] === "") {
            //It means its an image post!
            unlink($_SERVER["DOCUMENT_ROOT"]."/img/posts/".$_POST["postID"].".png");
        }

        if (removePost($_POST["postID"]))
            echo "success";
        else
            echo "failure";
    }
    else
        echo "NOT SIGNED IN!";
?>