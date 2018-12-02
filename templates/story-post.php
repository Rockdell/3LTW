<article id='story-post' class='container'>
    <a href='/pages/post_page.php?id=<?=$post['postID']?>'>
        <header>
            <h3><?=$post['title']?></h3>
        </header>
        <p><?=$post['content']?></p> <br> <?=$post['postDate']?>
        <p> <?=$post['points']?> </p>
    </a>
</article>