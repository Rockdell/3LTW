<?php
    include_once($_SERVER['DOCUMENT_ROOT']."/templates/common/header.php");

    include_once($_SERVER['DOCUMENT_ROOT']."/database/connection.php");
    include_once($_SERVER['DOCUMENT_ROOT']."/database/post.php");
    $posts = getAllPosts();

    foreach($posts as $post) {
		include($_SERVER['DOCUMENT_ROOT']."/templates/story_post.php");
    }

    include_once($_SERVER['DOCUMENT_ROOT']."/templates/common/footer.php");
?>