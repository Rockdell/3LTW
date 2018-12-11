<?php
    require_once("../includes/init.php");
    require_once($BASE_DIR."/database/user.php");

    if(isLoggedIn()) {

        $userID = ($_SESSION["userID"]);

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