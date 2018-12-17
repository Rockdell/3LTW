<?php
    require_once("../includes/init.php");
    require_once($BASE_DIR."/database/user.php");

    if ($_SERVER["REQUEST_METHOD"] == "GET" && realpath(__FILE__) == realpath( $_SERVER["SCRIPT_FILENAME"] )) {
        header("Location: ../pages/error-404.php");
        return;
    }
    
    if(isLoggedIn()) {
        if (!preg_match("/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$/", $_POST["password"])) {
            echo "Password is not valid!";
            return;
        }

        if (strcmp($_POST["password"], $_POST["chkpassword"])) {
            echo "Passwords don't match!";
            return;
        }

        if (updateUserPassword($_SESSION["userID"], $_POST["password"]))
            echo "success";
        else
            echo "Failed to update password!";
    }
    else {
        echo "NOT SIGNED IN!";
    }
?>