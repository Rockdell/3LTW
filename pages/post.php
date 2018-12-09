<?php
    require_once($_SERVER['DOCUMENT_ROOT'].'/includes/init.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/database/post.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/database/comment.php');

    $post = getPostById($_GET['id']);

    if ($post == NULL)
        header("Location: /pages/404.php");

    $comments = getCommentsByPost($_GET['id']);
    $numberComments = getNumberComments($_GET['id']);

    include_once($_SERVER["DOCUMENT_ROOT"]."/templates/common/header.php");
?>

<?php if (!isLoggedIn()) include_once($_SERVER["DOCUMENT_ROOT"]."/templates/components/sign-bar.php"); ?>

<div id="post-page" class="page">
    <?php include($_SERVER["DOCUMENT_ROOT"]."/templates/components/post.php"); ?>
</div>

<?php include_once($_SERVER["DOCUMENT_ROOT"]."/templates/common/footer.php"); ?>