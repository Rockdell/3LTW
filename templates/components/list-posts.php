<section id="list-posts" class="list-posts">
<?php
    require_once($BASE_DIR."/database/post.php");

    if (empty($posts)) { ?>
        <h1>No posts to show</h1>
    <?php }
    else {
        ?>
            <span id="picture-modal" class="modal">
                <img id="popup-picture"/>
            </span>
        <?php

        foreach($posts as $post) {
            include($BASE_DIR."/templates/components/post.php");
        }
    } 
?>
</section>