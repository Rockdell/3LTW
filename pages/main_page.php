<?php include_once($_SERVER['DOCUMENT_ROOT']."/templates/common/header.php"); ?>
<header>
    <div id="top_bar">
        <img src="/img/logo.png" />
        <h1><a href="/pages/start_page.php">Redditor<a/></h1>
    </div>
</header>

<main role="main">
    <?php include_once(POSTS); ?>
</main>

<?php include_once($_SERVER['DOCUMENT_ROOT']."/templates/common/footer.php"); ?>