<?php
    require_once("../includes/init.php");

    $args = explode(".", $_FILES["picture"]["name"], 3);
    $target_dir = "../img/".$args[0]."/";

    if ($args[1] !== "") {
        $target_file = $target_dir.sha1($args[1]).".".$args[2];
    } else {
        $target_file = $target_dir.sha1($_SESSION["userID"]).".".$args[2];
    }

    $file_extension = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check file extension
    if ($file_extension !== "png" && $file_extension !== "jpg" && $file_extension !== "gif") {
        echo "File extension is not acceptable.";
        return;
    }

    if ($_FILES["picture"]["tmp_name"] == null || getimagesize($_FILES["picture"]["tmp_name"]) == FALSE) {
        echo "Image is not valid.";
        return;
    }

    if ($args[1] !== "") {
        $image = $target_dir.sha1($args[1]);
    } else {
        $image = $target_dir.sha1($_SESSION["userID"]);
    }

    if (file_exists($image.".png")) {
        $image .= ".png";
    } else if (file_exists($image.".jpg")) {
        $image .= ".jpg";
    } else if (file_exists($image.".gif")) {
        $image .= ".gif";
    } else {
        $image = "";
    }

    if ($image !== "")
        unlink($image);

    if (move_uploaded_file($_FILES["picture"]["tmp_name"], $target_file))
        echo "success";
    else
        echo "Failed to upload!";
?>