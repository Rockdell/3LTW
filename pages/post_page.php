<?php require_once($_SERVER['DOCUMENT_ROOT'].'/includes/init.php'); ?>

<div id='post' class='page'>
    <?php 
        include_once($_SERVER['DOCUMENT_ROOT'].'/templates/common/header.php');

        include_once($_SERVER['DOCUMENT_ROOT'].'/database/post.php');
        $post = getPostById($_GET['id'])[0];
        
        include($_SERVER['DOCUMENT_ROOT'].'/templates/components/story-post.php');

        include_once($_SERVER['DOCUMENT_ROOT'].'/templates/common/footer.php');
    ?>
</div>