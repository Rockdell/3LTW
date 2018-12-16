<?php
    require_once($BASE_DIR."/database/comment.php");
    $comments = getCommentsByPost($_GET["id"]);
?>

<section id="list-comments">
    <?php

        function cmp_comment_points($a, $b) {
            if ($a["points"] == $b["points"])
                return 0;

            return ($a["points"] > $b["points"]) ? -1 : 1;
        }

        usort($comments, "cmp_comment_points");

        if (empty($comments)) { ?>
            <h1>No comments to show</h1>
        <?php } else { 
            foreach($comments as $comment) {
                include($BASE_DIR."/templates/components/comment.php");
            }
        } 
    ?>
</section>