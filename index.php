<?php
    include_once('includes/init.php');
    include_once('database/post.php');

    $posts = getAllPosts();
    
    include_once("pages/start_page.php");
?>