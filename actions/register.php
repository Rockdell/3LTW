<?php
    require_once("../includes/init.php");
    require_once($BASE_DIR."/database/user.php");

    if ($_POST["csfr"] != $_SESSION["csfr"]) {
        header("Location: ../pages/error-404.php");
        return;
    }

    if ($_SERVER["REQUEST_METHOD"] == "GET" && realpath(__FILE__) == realpath( $_SERVER["SCRIPT_FILENAME"] )) {
        header("Location: ../pages/error-404.php");
        return;
    }

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