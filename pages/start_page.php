<?php 
    include_once($_SERVER['DOCUMENT_ROOT'].'/templates/common/header.php');

    $_SESSION['username'] = 'Rockdell';

    if (isset($_SESSION['username'])) {
        header('Location: /pages/feed_page.php');
    }
    else {
        //Go to login/register page
    }
 
    include_once($_SERVER['DOCUMENT_ROOT'].'/templates/common/footer.php'); 
 ?>