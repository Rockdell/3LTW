<?php
    session_start();

    function isLoggedIn() {
        if (isset($_SESSION["username"]) && $_SESSION["username"] != "")
            return true;
        else
            return false;
    }
    
    function setCurrentUser($username) {
        $_SESSION['username'] = $username;
    }
?>