<?php include_once($_SERVER['DOCUMENT_ROOT']."/templates/common/header.php"); ?>

<header>
    <div id="logo"></div>
    <img src="/img/logo.png" />
    <p>Redditer</p>
</header>
<section>
    <h1> Posts </h1>
    <?php
        foreach($posts as $post) {
            ?>
            <article>
                <h3> <?=$post['title']?> </h3>
                <p> <?=$post['content']?> </p>
            </article>
            <?php
        }
    ?>
</section>
<aside>
    SidePanel
    <ul>
        <li><h1><a href="/pages/main_page.php">Main Page</a></h1></li>
        <li><h1><a href="/pages/feed_page.php">Feed Page</a></h1></li>
    </ul>
</aside>

<?php include_once($_SERVER['DOCUMENT_ROOT']."/templates/common/footer.php"); ?>