<?php
    require_once("../includes/init.php");
    require_once($BASE_DIR."/database/post.php");
    require_once($BASE_DIR."/database/comment.php");

    $post = getPostById($_GET['id']);

    if ($post == NULL)
        header("Location: /pages/404.php");

    $comments = getCommentsByPost($_GET['id']);
    $numberComments = getNumberComments($_GET['id']);

    include_once($BASE_DIR."/templates/common/header.php");
?>

<?php if (!isLoggedIn()) include_once($BASE_DIR."/templates/components/sign-bar.php"); ?>

<div id="post-page" class="page">
    <?php include($BASE_DIR."/templates/components/post.php"); ?>
</div>

<?php include_once($BASE_DIR."/templates/common/footer.php"); ?>