<?php
    require_once($BASE_DIR."/database/utils.php");
    require_once($BASE_DIR."/database/comment.php");
    
    $userVote = null;
    if(isLoggedIn())
        $userVote = getSingleUserCommentVote($_SESSION["userID"], $comment["commentID"])["vote"];
?>

<article class="comment container" data-commentid="<?=$comment["commentID"]?>">

    <?php if (isSameUser($comment["userID"])) { ?>
        <span id="delete-comment-confirmation" class="modal container open-btn">
            <p id="confirm-question">Are you sure you want to delete this comment kind human?</p>
            <button type="button" class="fill" id="yes"><i class="material-icons">check</i></button>
            <button type="button" class="fill" id="no"><i class="material-icons">close</i></button>
        </span>

        <i id="delete-comment" class="material-icons">delete</i>
    <?php } ?>

    <section id="comment-content">
        <p><?=$comment["content"]?></p>
    </section>

    <section id="comment-info">
        
        <label>
            <input type="checkbox" id="upvote"
            <?php if(!isLoggedIn()) echo "disabled"; if($userVote === "1") echo "checked"?>>
            <i id="staticUp" class="material-icons">arrow_upward</i>
        </label>

        <p id="dp"><?=display_points($comment["points"])?></p>
        
        <label>
            <input type="checkbox" id="downvote"
            <?php if(!isLoggedIn()) echo "disabled"; if($userVote === "0") echo "checked"?>>
            <i id="staticDown" class="material-icons">arrow_downward</i>
        </label>

        <?php if (isLoggedIn()) { ?>
            <i id="reply-comment" class="material-icons">reply</i>
        <?php } ?>

        <div id="commentByTimeAgo">
            <p id="commentBy">
                Posted by
                <a id="commentByLink" href="profile.php?user=<?=$comment["userID"]?>"><?=$comment["userID"]?></a>
                &minus;
                <?=time_ago($comment["commentDate"])?>
            </p>
        </div>
    </section>

    <section id="sub-comments">
        <?php
            $subComments = getChildComments($comment["commentID"]);
            usort($subComments, "cmp_comment_points");

            foreach($subComments as $comment) {
                include($BASE_DIR."/templates/components/comment.php");
            }
        ?>
    </section>
</article>