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
    
    if (isLoginCorrect($_POST["userID"], $_POST["password"])) {
        setCurrentUser($_POST["userID"]);
        echo "success";
    }
    else {
        echo "Failed to sign in!";
    }
?>