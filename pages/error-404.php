<?php
    require_once("../includes/init.php");
    
    include_once($BASE_DIR."/templates/common/header.php");

    if (!isLoggedIn()) include_once($BASE_DIR."/templates/components/sign-bar.php");
?>

<div id="error-404-page" class="page fof">
    <h1>Error 404</h1>
</div>

<?php include_once($BASE_DIR."/templates/common/footer.php") ?>