<?php require_once($_SERVER['DOCUMENT_ROOT'].'/database/timeAgo.php');?>

<article class="post container">
    <a href="/pages/post.php?id=<?=$post["postID"]?>">
        <h1 id="post_title"><?=$post["title"]?></h3>
        <section id="post-content">
            <p><?=$post["content"]?></p>
        </section>
    </a>

    <section id="post-info">
            <input type="checkbox" id="upvote<?=$post["postID"]?>">
            <label for="upvote<?=$post["postID"]?>">
                <i class="material-icons">thumb_up_alt</i>
            </label>

            <p id="pp"><?=$post["points"]?></p>

            <input type="checkbox" id="downvote<?=$post["postID"]?>">
            
            <label for="downvote<?=$post["postID"]?>">
                <i class="material-icons">thumb_down_alt</i>
            </label>

            <p id="nbComments"><?=$numberComments["NbComments"]?></p>
            <a id="nbCommentsLink" href="/pages/post.php?id=<?=$post["postID"]?>">
                <i class="material-icons">textsms</i>
            </a>  
    </section>

    <section id="post_date">
        <p id="time_ago"><?=time_ago($post["postDate"])?></p>
    </section>

    <?php if (isset($comments)) { ?>
        <section id="post-comments">
            <?php foreach($comments as $comment) { ?>
                <h1><?=$comment["content"]?></h1>
            <?php } ?>
        </section>
    <?php } ?>

</article>