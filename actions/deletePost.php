<?php
    require_once("../includes/init.php");
    require_once($BASE_DIR."/database/post.php");

    if ($_SERVER["REQUEST_METHOD"] == "GET" && realpath(__FILE__) == realpath( $_SERVER["SCRIPT_FILENAME"] )) {
        header("Location: ../pages/error-404.php");
        return;
    }

    if ($_POST["csfr"] != $_SESSION["csfr"]) {
        header("Location: ../pages/error-404.php");
        return;
    }

    if(isLoggedIn()) {

        //It means its an image post!
        if (getPostById($_POST["postID"])["content"] === "")
            unlink(glob($BASE_DIR."/img/posts/".sha1($_POST["postID"]).".{png,jpeg,jpg,gif}", GLOB_BRACE)[0]);

        if (removePost($_POST["postID"]))
            echo "success";
        else
            echo "failure";
    }
    else {
        echo "NOT SIGNED IN!";
    }
?>