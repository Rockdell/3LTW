<aside class="profile-bar container">

    <section id="user-info">
        <?php if (file_exists($_SERVER['DOCUMENT_ROOT']."/img/users/".$user["userID"].".png")) { ?>
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
    <?php if ($_SESSION["username"] == $user["userID"]) { ?>
        <button class="fill" onclick="openSettings()"> Settings </button>
        <button type="submit" class="fill"> Logout </button>
    <?php } ?>
    </section>

</aside>