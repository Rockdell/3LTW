<?php
    require_once("../includes/init.php");
    require_once($BASE_DIR."/database/post.php");

    if(isLoggedIn()) {
        
        if ($_POST["title"] === null || strlen(trim($_POST["title"])) == 0 || $_POST["content"] === null || strlen(trim($_POST["content"])) == 0)
            echo "Funny guy...";
        else
        {
            if (strlen($_POST["title"]) > 60)
                echo "Title too long! We give you a budget of 60 words.";
            else if (strlen($_POST["content"]) > 280)
                echo "Content too long! Try less than 281 words.";
            else if (($newPostID = addPost($_SESSION["userID"], $_POST["title"], $_POST["content"])) != -1)
                echo $newPostID;
            else
                echo "failure";
        }
    }
    else
        echo "NOT SIGNED IN!";
?>