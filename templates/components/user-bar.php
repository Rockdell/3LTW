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
    <?php } else {
        include_once($_SERVER["DOCUMENT_ROOT"]."/templates/components/sign-bar.php"); ?>
        <button id="sign-btn" class="fill open-btn">Login/Register</button>
    <?php } ?>
</aside>