<?php require_once($_SERVER['DOCUMENT_ROOT'].'/database/timeAgo.php'); ?>

<article class="post container">
    <a href="/pages/post.php?id=<?=$post["postID"]?>">
        <h1><?=$post["title"]?></h3>
        <section id="post-content">
            <p><?=$post["content"]?></p>
        </section>
        <section id="post-comments">
            <?php foreach($comments as $comment) { ?>
                <h1><?=$comment["commentID"]?></h1>
            <?php } ?>
        </section>
    </a>
    <section id="post-info">
            <i id="upvote<?=$post["postID"]?>" class="material-icons">thumb_up_alt</i>
            <p id="pp"><?=$post["points"]?></p>
            <i id="downvote<?=$post["postID"]?>" class="material-icons">thumb_down_alt</i>
            <p><?=time_ago($post["postDate"])?></p>
    </section>
</article>