<?php
    require_once("../includes/init.php");

    if ($_SERVER["REQUEST_METHOD"] == "GET" && realpath(__FILE__) == realpath( $_SERVER["SCRIPT_FILENAME"] )) {
        header("Location: ../pages/error-404.php");
    }

    $args = explode(".", $_FILES["picture"]["name"], 3);
    $target_dir = $BASE_DIR."/img/".$args[0]."/";

    if ($args[1] !== "")
        $file_path = $target_dir.sha1($args[1]);
    else
        $file_path = $target_dir.sha1($_SESSION["userID"]);

    $target_file = $file_path.".".$args[2];

    // Check if it's valid
    if ($_FILES["picture"]["tmp_name"] == null || !preg_match("/(png|jpeg|jpg|gif)/", $args[2]) || !preg_match("/image\/".$args[2]."/", mime_content_type($_FILES["picture"]["tmp_name"]))) {
        echo "Image is not valid.";
        return;
    }

    $old = glob($file_path.".{png,jpeg,jpg,gif}", GLOB_BRACE);

    if (!empty($old))
        unlink($old[0]);

    if (move_uploaded_file($_FILES["picture"]["tmp_name"], $target_file))
        echo "success";
    else
        echo "Failed to upload!";
?>