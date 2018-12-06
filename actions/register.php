<?php
    require_once($_SERVER["DOCUMENT_ROOT"]."/includes/init.php");
    require_once($_SERVER["DOCUMENT_ROOT"]."/database/user.php");
    
    if (addUser($_POST["userID"], $_POST["username"], $_POST["password"], $_POST["email"])) {
        setCurrentUser($_POST["userID"]);
        echo "success";
    }
    else {
        echo "failure";
    }
?>