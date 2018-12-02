<?php include_once($_SERVER['DOCUMENT_ROOT'].'/templates/common/header.php'); ?>

<div id='list-posts'>
    <?php 
        include_once($_SERVER['DOCUMENT_ROOT'].'/database/post.php');
        $post = getPostById($_GET['id'])[0];
        include($_SERVER['DOCUMENT_ROOT'].'/templates/story-post.php');
        // echo '<script>console.log('.json_encode($post).')</script>';
    ?>
</div>

<?php include_once($_SERVER['DOCUMENT_ROOT'].'/templates/common/footer.php'); ?>