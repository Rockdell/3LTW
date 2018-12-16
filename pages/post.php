<?php
    require_once("../includes/init.php");
    require_once($BASE_DIR."/database/post.php");

    include_once($BASE_DIR."/templates/common/header.php");

    $post = getPostById($_GET["id"]);

    if ($post == NULL)
        header("Location: error-404.php");
?>

<?php if (!isLoggedIn()) include_once($BASE_DIR."/templates/components/sign-bar.php"); ?>

<div id="post-page" class="page">
    <?php 
        include_once($BASE_DIR."/templates/components/post.php"); 
        include_once($BASE_DIR."/templates/components/list-comments.php");
        include_once($BASE_DIR."/templates/components/newComment-bar.php");
    ?>
</div>

<?php include_once($BASE_DIR."/templates/common/footer.php"); ?>