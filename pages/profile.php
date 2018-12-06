<?php 
    require_once($_SERVER["DOCUMENT_ROOT"]."/includes/init.php");
    require_once($_SERVER["DOCUMENT_ROOT"]."/database/user.php");
    require_once($_SERVER["DOCUMENT_ROOT"]."/database/post.php");

    $user = getUserById($_GET["user"]);
    $posts = getPostByUser($user["userID"]);

    include_once($_SERVER["DOCUMENT_ROOT"]."/templates/common/header.php");
    // include_once($_SERVER["DOCUMENT_ROOT"]."/templates/components/login-register.php");
?>

<div id="profile-page" class="page">
    <?php
        include_once($_SERVER["DOCUMENT_ROOT"]."/templates/components/search-bar.php");
        include_once($_SERVER["DOCUMENT_ROOT"]."/templates/components/list-posts.php");
        include_once($_SERVER["DOCUMENT_ROOT"]."/templates/components/profile-bar.php");
    ?>
</div>

<?php include_once($_SERVER["DOCUMENT_ROOT"]."/templates/common/footer.php") ?>