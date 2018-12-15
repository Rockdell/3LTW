<?php 
    require_once("../includes/init.php");
    require_once($BASE_DIR."/database/user.php");
    require_once($BASE_DIR."/database/post.php");

    $user =  getUserById($_GET["user"]);

    if ($user == NULL)
        header("Location: /pages/error-404.php");

    $posts = getPostByUser($_GET["user"]);
    
    include_once($BASE_DIR."/actions/sortPosts.php");

    include_once($BASE_DIR."/templates/common/header.php");
?>

<?php 
    if (!isLoggedIn()) 
        include_once($BASE_DIR."/templates/components/sign-bar.php");
    else if ($_SESSION["userID"] === $user["userID"]) 
        include_once($BASE_DIR."/templates/components/settings-bar.php") 
?>

<div id="profile-page" class="page">
    <?php
        include_once($BASE_DIR."/templates/components/search-bar.php");
        include_once($BASE_DIR."/templates/components/list-posts.php");
        include_once($BASE_DIR."/templates/components/profile-bar.php");
    ?>
</div>

<?php include_once($BASE_DIR."/templates/common/footer.php") ?>