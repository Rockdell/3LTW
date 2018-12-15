<?php
    require_once($BASE_DIR."/database/timeAgo.php");
    require_once($BASE_DIR."/database/user.php");
    
    $userVote = null;
    
    if(isLoggedIn())
        $userVote = getSingleUserPostVote($_SESSION["userID"], $post["postID"])["vote"];
?>

<article class="post container" data-id="<?=$post["postID"]?>">

    <?php if(isSameUser($post["userID"])) { ?>
        <span id="delete-post-confirmation" class="modal container open-btn">
            <p id="confirm-question">Are you sure you want to delete this post kind human?</p>
            <button type="button" class="fill" id="yes"><i class="material-icons">check</i></button>
            <button type="button" class="fill" id="no"><i class="material-icons">close</i></button>
        </span>

        <i id="delete-post" class="material-icons">delete</i>
    <?php } ?>

    <section id="post-title">
        <a href="/pages/post.php?id=<?=$post["postID"]?>"><h1><?=$post["title"]?></h1></a>
    </section>
    
    <section id="post-content">
        <?php if ($post["content"] === "") { ?>
            <div id="post-image">
                <img class="post-picture" src=<?=str_replace($BASE_DIR, "", glob($BASE_DIR."/img/posts/".sha1($post["postID"]).".{png,jpeg,jpg,gif}", GLOB_BRACE)[0])?>>
            </div>
        <?php } else { ?>
            <div id="post-story">
                <p><?=nl2br($post["content"])?></p>
            </div>
        <?php } ?>
    </section>

    <section id="post-info">
        
        <label>
            <input type="checkbox" id="upvote"
            <?php if(!isLoggedIn()) echo "disabled"; if($userVote === "1") echo "checked"?>>
            <i id="staticUp" class="material-icons">thumb_up_alt</i>
        </label>

        <p id="dp"><?=display_points($post["points"])?></p>

        <label>
            <input type="checkbox" id="downvote"
            <?php if(!isLoggedIn()) echo "disabled"; if($userVote === "0") echo "checked"?>>
            <i id="staticDown" class="material-icons">thumb_down_alt</i>
        </label>

        <p id="nrComments"><?=getNumberComments($post["postID"])["nrComments"]?></p>
        <a id="nrCommentsLink" href="/pages/post.php?id=<?=$post["postID"]?>">
            <i class="material-icons">textsms</i>
        </a>

        <div id="postByTimeAgo">
            <p id="postBy">
                Posted by
                <a id="postByLink" href="/pages/profile.php?user=<?=$post["userID"]?>"><?=$post["userID"]?></a>
                &minus;
                <?=time_ago($post["postDate"])?>
            </p>
        </div>
    </section>
</article>