<?php
    require_once("../includes/init.php");
    require_once($BASE_DIR."/database/user.php");

    if ($_SERVER["REQUEST_METHOD"] == "GET" && realpath(__FILE__) == realpath( $_SERVER["SCRIPT_FILENAME"] )) {
        header("Location: ../pages/error-404.php");
        return;
    }

    if ($_POST["csfr"] != $_SESSION["csfr"]) {
        header("Location: ../pages/error-404.php");
        return;
    }

    if(isLoggedIn()) {
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
    
            $username = $_POST["username"];
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
                echo "Bio is not valid, 60 words or less mate!";
                return;
            }

            $bio = $_POST["bio"];
        }

        if (updateUserInfo($_SESSION["userID"], htmlspecialchars($username, ENT_QUOTES), $mail, htmlspecialchars($bio, ENT_QUOTES)))
            echo "success";
        else
            echo "Failed to update profile!";
        }
    else {
        echo "NOT SIGNED IN!";
    }
?>