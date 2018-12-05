<?php
    session_start();

    function isLoggedIn() {
        if (isset($_SESSION["username"]) && $_SESSION["username"] != "")
            return true;
        else
            return false;
    }
    
    function isSameUser($username) {
        return isLoggedIn() && $_SESSION["username"] === $username;
    }

    function setCurrentUser($username) {
        $_SESSION["username"] = $username;
    }
?>