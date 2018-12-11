<?php
    require_once("../includes/init.php");
    require_once($BASE_DIR."/database/post.php");

    if(isLoggedIn()) {

        if (getPostById($_POST["postID"])["content"] === "") {
            //It means its an image post!
            
            $image = $BASE_DIR."/img/posts/".sha1($_POST["postID"]);

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
        }

        if (removePost($_POST["postID"]))
            echo "success";
        else
            echo "failure";
    }
    else
        echo "NOT SIGNED IN!";
?>