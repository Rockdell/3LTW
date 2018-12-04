<section class="list-posts">
<?php  
    foreach($posts as $post) {
        include($_SERVER["DOCUMENT_ROOT"]."/templates/components/post.php");
    }
?>
</section>