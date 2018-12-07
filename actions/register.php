<?php
    require_once($_SERVER["DOCUMENT_ROOT"]."/includes/init.php");
    require_once($_SERVER["DOCUMENT_ROOT"]."/database/user.php");

    // Valid userID
    if (!preg_match("/^[a-zA-Z][a-zA-Z0-9-_]{3,32}$/", $_POST["userID"])) {
        echo "UserID is not valid";
        return;
    }

    if (getUserById($_POST["userID"])) {
        echo "UserID already exists.";
        return;
    }

    // Valid username
    if (!preg_match("/[\w]{1}[\s\w]{0,1}/", $_POST["username"])) {
        echo "Username is not valid!";
        return;
    }

    // Valid password
    if (!preg_match("/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$/", $_POST["password"])) {
        echo "Password is not valid!";
        return;
    }

    // Check password
    if (strcmp($_POST["password"], $_POST["chkpassword"])) {
        echo "Passwords don't match!";
        return;
    }

    if (!preg_match("/([\w\.\-_]+)?\w+@[\w-_]+(\.\w+){1,}/", $_POST["mail"])) {
        echo "Mail is not valid!";
        return;
    }

    if (addUser($_POST["userID"], $_POST["username"], $_POST["password"], $_POST["mail"])) {
        setCurrentUser($_POST["userID"]);
        echo "success";
    }
    else {
        echo "Failed sign up!";
    }
?>