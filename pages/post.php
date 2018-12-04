<?php 
    require_once($_SERVER['DOCUMENT_ROOT'].'/includes/init.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/database/post.php');

    $post = getPostById($_GET['id']);

    include_once($_SERVER['DOCUMENT_ROOT'].'/templates/common/header.php');
?>

<div id='post' class='page'>
    <?php include($_SERVER['DOCUMENT_ROOT'].'/templates/components/post.php'); ?>
</div>

<?php include_once($_SERVER['DOCUMENT_ROOT'].'/templates/common/footer.php'); ?>