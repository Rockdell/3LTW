<?php
    require_once($_SERVER["DOCUMENT_ROOT"]."/includes/init.php");
    
    // Temporary login
    setCurrentUser("");
    
    header("Location: /pages/feed.php");
?>