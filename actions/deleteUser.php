<?php
    require_once("../includes/init.php");
    require_once($BASE_DIR."/database/user.php");

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
    else
        echo "NOT SIGNED IN!";
?>