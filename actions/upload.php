<?php
    $args = explode("_", $_FILES["picture"]["name"], 2);
    $upload_ok = 1;

    $target_dir = "../img/".$args[0]."/";
    $target_file = $target_dir.basename($args[1]).".png";

    if (file_exists($target_file) || $_FILES["picture"]["size"] > 500000000)
        $upload_ok = 0;

    if ($upload_ok && move_uploaded_file($_FILES["picture"]["tmp_name"], $target_file))
        echo "success";
    else
        echo "failure";
?>