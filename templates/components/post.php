<?php
    require_once($_SERVER['DOCUMENT_ROOT'].'/database/timeAgo.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/database/user.php');
    
    $userVote = null;
    
    if(isLoggedIn())
        $userVote = getSingleUserPostVote($_SESSION["userID"], $post["postID"])["vote"];
?>

<article class="post container">
    <a href="/pages/post.php?id=<?=$post["postID"]?>">
        <h1><?=$post["title"]?></h1>
    </a>
    
    <section id="post-content">

    <?php if ($post["content"] === "") {
            if (file_exists($_SERVER["DOCUMENT_ROOT"]."/img/posts/".$post["postID"].".png")) { ?>
                <img class="post-picture" src="/img/posts/<?=$post["postID"]?>.png">
        <?php } } else { ?>
            <p><?=$post["content"]?></p>
        <?php } ?>

    </section>

    <section id="post-info">

        <input type="checkbox" id="upvote<?=$post["postID"]?>"
        <?php if(!isLoggedIn()) echo " disabled"; if($userVote === "1") echo "checked"?>>

        <label for="upvote<?=$post["postID"]?>">
            <i id="staticUp<?=$post["postID"]?>" class="material-icons">thumb_up_alt</i>
        </label>

        <p id="pp<?=$post["postID"]?>"><?=$post["points"]?></p>

        <input type="checkbox" id="downvote<?=$post["postID"]?>"
        <?php if(!isLoggedIn()) echo " disabled"; if($userVote === "0") echo "checked"?>>

        <label for="downvote<?=$post["postID"]?>">
            <i id="staticDown<?=$post["postID"]?>" class="material-icons">thumb_down_alt</i>
        </label>

        <p id="nbComments"><?=$numberComments["NbComments"]?></p>
        <a id="nbCommentsLink" href="/pages/post.php?id=<?=$post["postID"]?>">
            <i class="material-icons">textsms</i>
        </a>

        <div id="postBytime_ago">
            <p id="postBy">Posted by 
                <a id="postByLink" href="/pages/profile.php?user=<?=$post["userID"]?>"><?=$post["userID"]?></a>
                &minus;
            </p>
            <p id="time_ago"><?=time_ago($post["postDate"])?></p>
        </div>
    </section>

    <?php if (isset($comments)) { ?>
        <section id="post-comments">
            <?php foreach($comments as $comment) { ?>
                <h1><?=$comment["content"]?></h1>
            <?php } ?>
        </section>
    <?php } ?>

</article>