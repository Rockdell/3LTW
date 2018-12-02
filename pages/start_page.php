<?php 
    require_once($_SERVER['DOCUMENT_ROOT'].'/includes/init.php');
    include_once($_SERVER['DOCUMENT_ROOT'].'/templates/common/header.php');

    // Temporary login
    setCurrentUser('Rockdell');

    if (isset($_SESSION['username'])) {
        header('Location: /pages/feed_page.php');
    }
    else {
        //Go to login/register page
    }
 
    include_once($_SERVER['DOCUMENT_ROOT'].'/templates/common/footer.php'); 
 ?>