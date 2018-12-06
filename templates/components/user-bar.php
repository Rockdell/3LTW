<aside class="user-bar">
    <?php if (isLoggedIn()) { ?>
        <a href="/pages/profile.php?user=<?=$_SESSION["userID"]?>">

            <span><?=$_SESSION["userID"]?></span>

            <?php if (file_exists($_SERVER['DOCUMENT_ROOT']."/img/users/".$_SESSION["userID"].".png")) { ?>
                <img class="miniature-profile-picture" src="/img/users/<?=$_SESSION["userID"]?>.png"?>
            <?php } else { ?>
                <img class="miniature-profile-picture" src="/img/users/unknown.png">
            <?php } ?>
        </a>
    <?php } else { ?>
        <button class="fill" onclick="openSignIn()">Login/Register</button>
    <?php } ?>
</aside>