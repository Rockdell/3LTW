<!DOCTYPE html>
<html>
    <head>
        <title>Redditter</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="/css/style.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <script src="/js/script.js" defer></script>
    </head>
    <body>
        <header class="top-bar">
            <a href="/pages/feed.php"><img src="/img/logo.png" /></a>
            <?php include_once($_SERVER["DOCUMENT_ROOT"]."/templates/components/user-bar.php"); ?>
        </header>
    