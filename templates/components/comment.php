<?php
    require_once($BASE_DIR."/database/timeAgo.php");
    require_once($BASE_DIR."/database/comment.php");
    
    $userVote = null;

    //TODO
?>

<article class="comment container">
    <section id="comment-content">
        <p><?=$comment["content"]?></p>
    </section>

    <section id="comment-info">
        <input type="checkbox" id="upvote<?=$comment["commentID"]?>"
        <?php if(!isLoggedIn()) echo "disabled"; if($userVote === "1") echo "checked"?>>

        <label for="upvote<?=$comment["commentID"]?>">
            <i id="staticUp<?=$comment["commentID"]?>" class="material-icons">thumb_up_alt</i>
        </label>

        <p id="pp<?=$comment["commentID"]?>"><?=display_points($comment["points"])?></p>

        <input type="checkbox" id="downvote<?=$comment["commentID"]?>"
        <?php if(!isLoggedIn()) echo "disabled"; if($userVote === "0") echo "checked"?>>

        <label for="downvote<?=$comment["commentID"]?>">
            <i id="staticDown<?=$comment["commentID"]?>" class="material-icons">thumb_down_alt</i>
        </label>

        <div id="commentByTimeAgo">
            <p id="commentBy">
                Posted by
                <a id="commentByLink" href="/pages/profile.php?user=<?=$comment["userID"]?>"><?=$comment["userID"]?></a>
                &minus;
                <?=time_ago($comment["commentDate"])?>
            </p>
        </div>
    </section>

    <section id="sub-comments">
        <?php
            $subComments = getChildComments($comment["commentID"]);

            foreach($subComments as $comment) {
                include($BASE_DIR."/templates/components/comment.php");
            }
        ?>
    </section>
</article>