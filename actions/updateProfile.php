<?php
    require_once("../includes/init.php");
    require_once($BASE_DIR."/database/user.php");

    $user = getUserById($_SESSION["userID"]);

    // Default
    $username = $user["username"];
    $mail = $user["mail"];
    $bio = $user["bio"];

    if ($_POST["username"] !== "") {
        
        // Valid username
        if (!preg_match("/[\w]{1}[\s\w]{0,1}/", $_POST["username"])) {
            echo "Username is not valid!";
            return;
        }
    
        $username = htmlspecialchars($_POST["username"], ENT_QUOTES);
    }

    if ($_POST["mail"] !== "") {

        // Valid mail
        if (!preg_match("/([\w\.\-_]+)?\w+@[\w-_]+(\.\w+){1,}/", $_POST["mail"])) {
            echo "Mail is not valid!";
            return;
        }

        $mail = $_POST["mail"];
    }

    if ($_POST["bio"] !== "") {
        
        // Valid bio
        if (strlen($_POST["bio"]) > 60) {
            echo "Bio is not valid!";
            return;
        }

        $bio = htmlspecialchars($_POST["bio"], ENT_QUOTES);
    }

    $birthday = "1998-10-02";

    if (updateUserInfo($_SESSION["userID"], $username, $mail, $bio, $birthday))
        echo "success";
    else
        echo "Failed to update profile!";
?>