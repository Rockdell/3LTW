<?php 
    require_once($_SERVER["DOCUMENT_ROOT"]."/includes/init.php");
    require_once($_SERVER["DOCUMENT_ROOT"]."/database/user.php");
    require_once($_SERVER["DOCUMENT_ROOT"]."/database/post.php");

    include_once($_SERVER["DOCUMENT_ROOT"]."/templates/common/header.php");

    $user = getUserById($_GET["user"]);
    $posts = getPostByUser($user["userID"]);
    // echo "<script>console.log(".json_encode($posts).") </script>";
?>

<div class="profile">

    <?php include($_SERVER["DOCUMENT_ROOT"]."/templates/components/profile-bar.php"); ?>

    <section id="posts">
        <?php foreach($posts as $post) {
            include($_SERVER["DOCUMENT_ROOT"]."/templates/components/story-post.php");
        } ?>
    </section>
</div>


<?php include_once($_SERVER["DOCUMENT_ROOT"]."/templates/common/footer.php"); ?>