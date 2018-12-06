<?php
    require_once($_SERVER["DOCUMENT_ROOT"]."/includes/init.php");
    require_once($_SERVER["DOCUMENT_ROOT"]."/database/user.php");

    $user = getUserById($_SESSION["userID"]);

    if (strcmp($_POST["username"], "")) {
        
        // Valid username
        if (!preg_match("/[\w]{1}[\s\w]{0,1}/", $_POST["username"])) {
            echo "Username is not valid!";
            return;
        }
    
        $username = $_POST["username"];
    }
    else {
        $username = $user["username"];
    }

    if (strcmp($_POST["mail"], "")) {

        // Valid mail
        if (!preg_match("/([\w\.\-_]+)?\w+@[\w-_]+(\.\w+){1,}/", $_POST["mail"])) {
            echo "Mail is not valid!";
            return;
        }

        $mail = $_POST["mail"];
    }
    else {
        $mail = $user["mail"];
    }

    if (strcmp($_POST["bio"], "")) {
        
        // Valid bio
        if (strlen($_POST["bio"]) > 60) {
            echo "Bio is not valid!";
            return;
        }

        $bio = $_POST["bio"];
    }
    else {
        $bio = $user["bio"];
    }

    $birthday = "1998-10-02";

    if (updateUserInfo($_SESSION["userID"], $username, $mail, $bio, $birthday))
        echo "success";
    else
        echo "Failed to update profile!";
?>