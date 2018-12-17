<?php
    session_start();
    session_regenerate_id(true);

    if (!isset($_SESSION["csfr"]))
        $_SESSION["csfr"] = bin2hex(openssl_random_pseudo_bytes(32));

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