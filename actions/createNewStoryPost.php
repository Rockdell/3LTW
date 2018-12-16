<?php
    require_once("../includes/init.php");
    require_once($BASE_DIR."/database/post.php");

    if ($_SERVER["REQUEST_METHOD"] == "GET" && realpath(__FILE__) == realpath( $_SERVER["SCRIPT_FILENAME"] )) {
        header("Location: ../pages/error-404.php");
    }

    if(isLoggedIn()) {
        
        if ($_POST["title"] === null || strlen(trim($_POST["title"])) === 0 || $_POST["content"] === null || strlen(trim($_POST["content"])) == 0)
            echo "Funny guy...";
        else {
            if (strlen($_POST["title"]) > 60)
                echo "Title too long! We give you a budget of 60 words.";
            else if (strlen($_POST["content"]) > 280)
                echo "Content too long! Try less than 281 words.";
            else if (($newPostID = addPost($_SESSION["userID"], htmlspecialchars($_POST["title"], ENT_QUOTES), htmlspecialchars($_POST["content"], ENT_QUOTES))) != -1)
                echo $newPostID;
            else
                echo "failure";
        }
    }
    else {
        echo "NOT SIGNED IN!";
    }
?>