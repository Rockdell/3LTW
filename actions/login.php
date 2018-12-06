<?php
    require_once($_SERVER["DOCUMENT_ROOT"]."/includes/init.php");
    require_once($_SERVER["DOCUMENT_ROOT"]."/database/user.php");

    if (isLoginCorrect($_POST["userID"], $_POST["password"])) {
        setCurrentUser($_POST["userID"]);
        echo "success";
    }
    else {
        echo "failure";
    }
?>