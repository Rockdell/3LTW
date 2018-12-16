<aside id="user-bar">
    <?php if (isLoggedIn()) { ?>
        <a href="profile.php?user=<?=$_SESSION["userID"]?>">
            <span><?=$_SESSION["userID"]?></span>

            <img class="miniature-profile-picture" src=
            <?php 
                $image = glob($BASE_DIR."/img/users/".sha1($_SESSION["userID"]).".{png,jpeg,jpg,gif}", GLOB_BRACE);
                echo (!empty($image) ? str_replace($BASE_DIR, "", "../".$image[0]) : "../img/users/unknown.png");
            ?>>
        </a>
    <?php } else { ?>
        <button id="sign-btn" class="fill open-btn">Login/Register</button>
    <?php } ?>
</aside>