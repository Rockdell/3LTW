<!DOCTYPE html>
<html>
    <head>
        <title>Redditter</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="/css/style.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css">
        <script src="/js/script.js" defer></script>
    </head>
    <body>
        <div id="dim-mask"></div>
        <header>
            <i id="search-btn" class="open-btn icon1 fas fa-search mobile"></i>
            <a href="/pages/feed.php" class="logo"><i class="fas fa-paper-plane">  Redditer</i></a>
            <i id="sign-btn" class="open-btn icon2 fas fa-sign-in-alt mobile"></i>
            <?php include_once($_SERVER["DOCUMENT_ROOT"]."/templates/components/user-bar.php"); ?>
        </header>
