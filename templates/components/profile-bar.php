<aside class="profile-bar container">

    <section id="user-info">
        <img class="profile-picture" src="/img/users/<?=$user["userID"]?>.png">
        <h1><?=$user["username"]?></h1>
        <p><?=$user["bio"]?></p>
    </section>

    <?php if ($_SESSION["username"] == $user["userID"]) { ?>
    <section id="user-settings">
        <button class="fill" onclick="openSettings()"> Settings </button>
    </section>
    <?php } ?>

</aside>