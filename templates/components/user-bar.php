<aside class="user-bar">
    <?php if (isset($_SESSION["username"]) && $_SESSION["username"] != "") { ?>
        <a href="/pages/profile.php?user=<?=$_SESSION["username"]?>">

            <span><?=$_SESSION["username"]?></span>

            <?php if (file_exists($_SERVER['DOCUMENT_ROOT']."/img/users/".$_SESSION["username"].".png")) { ?>
                <img class="miniature-profile-picture" src="/img/users/<?=$_SESSION["username"]?>.png"?>
            <?php } else { ?>
                <img class="miniature-profile-picture" src="/img/users/unknown.png">
            <?php } ?>
        </a>
    <?php } else { ?>
        <button class="fill" onclick="openSignIn()">Login/Register</button>
    <?php } ?>
</aside>