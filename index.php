<?php
    include_once('includes/init.php');

    require_once($_SERVER['DOCUMENT_ROOT'].'/includes/init.php');
    
    // Temporary login
    setCurrentUser('Rockdell');

    if (isset($_SESSION['username'])) {
        header('Location: /pages/feed_page.php');
    }
    else {
        //Go to login/register page
    }
?>