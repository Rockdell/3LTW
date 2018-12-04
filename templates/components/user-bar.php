<aside class="user-bar">
        <?php if (isset($_SESSION["username"]) && $_SESSION["username"] != "") { ?>
            <a href="/pages/profile.php?user=<?=$_SESSION["username"]?>">
                <span><?=$_SESSION["username"]?></span>
                <img class="miniature-profile-picture" src="/img/users/<?=$_SESSION["username"]?>.png">
            </a>
        <?php } else { ?>
            <a href="/pages/register.php">
                <h3>Login/Register</h3>
            </a>
        <?php } ?>
    </a>
</aside>