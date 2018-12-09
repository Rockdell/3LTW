<aside id="user-bar">
    <?php if (isLoggedIn()) { ?>
        <a href="/pages/profile.php?user=<?=$_SESSION["userID"]?>">
            <span><?=$_SESSION["userID"]?></span>

            <img class="miniature-profile-picture" src=
            <?php 
                if (file_exists($_SERVER['DOCUMENT_ROOT']."/img/users/".$_SESSION["userID"].".png"))
                    echo "/img/users/".$_SESSION["userID"].".png";
                else
                    echo "/img/users/unknown.png";
            ?>>
        </a>
    <?php } else { ?>
        <button id="sign-btn" class="fill open-btn">Login/Register</button>
    <?php } ?>
</aside>