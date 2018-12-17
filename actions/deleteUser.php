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

        $userID = $_SESSION["userID"];

        $image = glob($BASE_DIR."/img/users/".sha1($userID).".{png,jpeg,jpg,gif}", GLOB_BRACE);

        if (!empty($image))
            unlink($image[0]);

        if (removeUser($userID)) {
            unlink($BASE_DIR."/img/users/".$userID.".png");
            echo "success";
        }
        else
            echo "failure";
    }
    else {
        echo "NOT SIGNED IN!";
    }
?>