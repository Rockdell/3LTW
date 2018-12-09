<section id="list-posts" class="list-posts">
<?php
    require_once($_SERVER["DOCUMENT_ROOT"]."/database/post.php");

    if (empty($posts)) { ?>
        <h1>No posts to show </h1>
    <?php }
    else {
        foreach($posts as $post) {
            include($_SERVER["DOCUMENT_ROOT"]."/templates/components/post.php");
        }
    } 
?>
</section>