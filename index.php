<?php
    require_once($_SERVER["DOCUMENT_ROOT"]."/includes/init.php");
    
    // Temporary login
    setCurrentUser("Rockdell");

    header("Location: /pages/profile.php?user=Rockdell");
    
    // if (isset($_SESSION['username'])) {
    //     header('Location: /pages/feed_page.php');
    // }
    // else {
    //     //Go to login/register page
    // }
?>