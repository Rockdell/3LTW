<section class="list-posts">
<?php  
    require_once($_SERVER["DOCUMENT_ROOT"]."/database/post.php");

    foreach($posts as $post) {
        $numberComments = getNumberComments($post['postID']);
        include($_SERVER["DOCUMENT_ROOT"]."/templates/components/post.php");
    }
?>
</section>