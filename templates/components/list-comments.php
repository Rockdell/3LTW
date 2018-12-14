<section id="list-comments">
    <?php
        require_once($BASE_DIR."/database/comment.php");

        $comments = getCommentsByPost($_GET["id"]);

        if (empty($comments)) { ?>
            <h1>No comments to show</h1>
        <?php } else { 
            foreach($comments as $comment) {
                include($BASE_DIR."/templates/components/comment.php");
            }
        } 
    ?>
</section>