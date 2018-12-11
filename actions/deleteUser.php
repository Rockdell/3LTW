<?php
    require_once($_SERVER["DOCUMENT_ROOT"]."/includes/init.php");
    require_once($_SERVER["DOCUMENT_ROOT"]."/database/user.php");

    if(isLoggedIn()) {

        $userID = ($_SESSION["userID"]);

        if (removeUser($userID)) {
            unlink($_SERVER["DOCUMENT_ROOT"]."/img/users/".$userID.".png");
            echo "success";
        }
        else
            echo "failure";
    }
    else
        echo "NOT SIGNED IN!";
?>