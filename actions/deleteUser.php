<?php
    require_once("../includes/init.php");
    require_once($BASE_DIR."/database/user.php");

    if(isLoggedIn()) {

        $userID = $_SESSION["userID"];

        $image = $BASE_DIR."/img/users/".sha1($userID);

        if (file_exists($image.".png")) {
            $image .= ".png";
        } else if (file_exists($image.".jpg")) {
            $image .= ".jpg";
        } else if (file_exists($image.".gif")) {
            $image .= ".gif";
        } else {
            $image = "";
        }

        if ($image !== "")
            unlink($image);

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