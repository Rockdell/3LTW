<?php
    require_once($_SERVER["DOCUMENT_ROOT"]."/includes/init.php");
    require_once($_SERVER["DOCUMENT_ROOT"]."/database/post.php");

    postVote($_POST["postID"], $_SESSION["username"], $_POST["value"]);
    echo "success";
?>