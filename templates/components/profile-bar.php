<aside class="profile-bar container">

    <section id="user-info">
        <?php if (file_exists($_SERVER["DOCUMENT_ROOT"]."/img/users/".$user["userID"].".png")) { ?>
            <img class="profile-picture" src="/img/users/<?=$user["userID"]?>.png"?>
        <?php } else { ?>
            <img class="profile-picture" src="/img/users/unknown.png">
        <?php } ?>
            
        <h1><?=$user["username"]?></h1>
    </section>

    <section id="user-bio">
        <p><?=$user["bio"]?></p>
    </section>

    <section id="user-settings">
    <?php if (isLoggedIn() && $_SESSION["userID"] === $user["userID"]) { ?>
        <button class="fill" onclick="openSettings()">Settings</button>
        <button id="logout-button" type="submit" class="fill">Logout</button>
    <?php } ?>
    </section>

    <?php include_once($_SERVER["DOCUMENT_ROOT"]."/templates/components/settings-bar.php") ?>

</aside>