<aside id="user-bar">
    <?php if (isLoggedIn()) { ?>
        <a href="/pages/profile.php?user=<?=$_SESSION["userID"]?>">
            <span><?=$_SESSION["userID"]?></span>

            <img class="miniature-profile-picture" src=
            <?php 
                $image = "/img/users/".sha1($_SESSION["userID"]);

                if (file_exists($BASE_DIR.$image.".png")) {
                    echo $image.".png";
                } else if (file_exists($BASE_DIR.$image.".jpg")) {
                    echo $image.".jpg";
                } else if (file_exists($BASE_DIR.$image.".gif")) {
                    echo $image.".gif";
                } else {
                    echo "/img/users/unknown.png";
                } 
            ?>>
        </a>
    <?php } else { ?>
        <button id="sign-btn" class="fill open-btn">Login/Register</button>
    <?php } ?>
</aside>