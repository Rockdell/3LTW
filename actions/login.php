<?php
    require_once($_SERVER["DOCUMENT_ROOT"]."/includes/init.php");
    require_once($_SERVER["DOCUMENT_ROOT"]."/database/user.php");

    if (isLoginCorrect($_POST["username"], $_POST["password"])) {
        setCurrentUser($_POST["username"]);
        echo "success";
    }
    else {
        echo "failure";
    }
?>