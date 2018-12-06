<?php
    include_once($_SERVER['DOCUMENT_ROOT'].'/includes/init.php');

    session_destroy();
    session_start();

    echo "success";
?>