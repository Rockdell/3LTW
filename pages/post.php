<?php
    require_once($_SERVER['DOCUMENT_ROOT'].'/includes/init.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/database/post.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/database/comment.php');

    $post = getPostById($_GET['id']);
    $comments = getCommentsByPost($_GET['id']);
    $numberComments = getNumberComments($_GET['id']);

    include_once($_SERVER["DOCUMENT_ROOT"]."/templates/common/header.php");
?>

<div id="post-page" class="page">
    <?php include($_SERVER["DOCUMENT_ROOT"]."/templates/components/post.php"); ?>
</div>

<?php include_once($_SERVER["DOCUMENT_ROOT"]."/templates/common/footer.php"); ?>