<aside id="profile-bar" class="container">

    <span id="delete-user-confirmation" class="modal container open-btn">
        <p id="confirm-question">To leave, or not to leave, that is the question.</p>
        <p id="confirm-question-warning">THIS IS IRREVERSIBLE!</p>
        <button type="button" class="fill" id="yes"><i class="material-icons">sentiment_very_dissatisfied</i>Leave us...</button>
        <button type="button" class="fill" id="no"><i class="material-icons">sentiment_very_satisfied</i>Love us!</button>
    </span>

    <?php if (isSameUser($user["userID"])) { ?>
        <i id="delete-user" class="material-icons">delete_forever</i>
    <?php } ?>

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