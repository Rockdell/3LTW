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
        
        if ($_POST["title"] === null || strlen(trim($_POST["title"])) == 0 || $_POST["content"] === null)
            echo "May I recommend a title with that image?";
        else {
            if (strlen($_POST["title"]) > 60)
                echo "Title too long! We give you a budget of 60 words.";
            else if (($newPostID = addPost($_SESSION["userID"], htmlspecialchars($_POST["title"], ENT_QUOTES), $_POST["content"])) != -1)
                echo $newPostID;
            else
                echo "failure";
        }
    }
    else {
        echo "NOT SIGNED IN!";
    }
?>