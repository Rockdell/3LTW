<aside id="profile-bar" class="container">

    <section id="user-info">
        <?php if (file_exists($_SERVER["DOCUMENT_ROOT"]."/img/users/".$user["userID"].".png")) { ?>
            <img class="profile-picture" src="/img/users/<?=$user["userID"]?>.png"?>
        <?php } else { ?>
            <img class="profile-picture" src="/img/users/unknown.png">
        <?php } ?>
            
        <h1><?=$user["username"]?></h1>
    </section>

    <section id="user-bio">
        <?php if (strcmp($user["bio"], "")) { ?>
            <p><?=$user["bio"]?></p>
        <?php } else { ?>
            <p>Nothing to show</p>
        <?php } ?>
    </section>

    <?php if (isLoggedIn() && $_SESSION["userID"] === $user["userID"]) { ?>
    <section id="user-settings">
        <button id="settings-btn" class="fill open-btn">Settings</button>
        <button id="logout-btn" type="submit" class="fill logout-btn">Logout</button>
    </section>
    <?php } ?>

</aside>