<?php
    require_once("../includes/init.php");
    require_once($BASE_DIR."/database/post.php");

    if(isLoggedIn()) {
        
        if ($_POST["title"] === null || strlen(trim($_POST["title"])) == 0 || $_POST["content"] === null || strlen(trim($_POST["content"])) == 0)
            echo "failure";
        else
        {
            if (($newPostID = addPost($_SESSION["userID"], $_POST["title"], $_POST["content"])) != -1)
                echo $newPostID;
            else
                echo "failure";
        }
    }
    else
        echo "NOT SIGNED IN!";
?>