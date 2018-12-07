<?php
    require_once($_SERVER['DOCUMENT_ROOT'].'/includes/init.php');

    $args = explode("_", $_FILES["picture"]["name"], 2);
    $upload_ok = 1;

    $target_dir = "../img/".$args[0]."/";

    if (strcmp($args[1], ""))
        $target_file = $target_dir.$args[1].".png";
    else
        $target_file = $target_dir.$_SESSION["userID"].".png";
    
    if ($_FILES["picture"]["size"] > 500000000) {
        echo "File size is bigger than 5MB!";
        return;
    }

    if ($upload_ok && move_uploaded_file($_FILES["picture"]["tmp_name"], $target_file))
        echo "success";
    else
        echo "Failed to upload!";
?>