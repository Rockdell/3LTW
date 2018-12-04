<article class="post container">
    <a href="/pages/post.php?id=<?=$post["postID"]?>">
        <h1><?=$post["title"]?></h3>
        <section id="post-content">
            <p><?=$post["content"]?></p>
        </section>
        <section id="post-info">
            <p>Points: <?=$post["points"]?> Date:<?=$post["postDate"]?></p>
        </section>
    </a>
</article>