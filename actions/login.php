<?php
    require_once("../includes/init.php");
    require_once($BASE_DIR."/database/user.php");
    require_once($BASE_DIR."/database/post.php");

    if (isLoginCorrect($_POST["userID"], $_POST["password"])) {
        setCurrentUser($_POST["userID"]);
        echo "success";
    }
    else {
        echo "Failed to sign in!";
    }
?>