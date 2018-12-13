<?php

    // session_set_cookie_params(0, "/", "", true, true);
    session_start();
    session_regenerate_id(true);

    function isLoggedIn() {
        if (isset($_SESSION["userID"]) && $_SESSION["userID"] !== "")
            return true;
        else
            return false;
    }
    
    function isSameUser($userID) {
        return isLoggedIn() && $_SESSION["userID"] === $userID;
    }

    function setCurrentUser($userID) {
        $_SESSION["userID"] = $userID;
    }
?>