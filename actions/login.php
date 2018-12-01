<?php
    include_once($_SERVER['DOCUMENT_ROOT'].'database/user.php');

    if (isLoginCorrect($_POST['username'], $_POST['password'])) {
        setCurrentUser($_POST['username']);
    }
    else {
        print("Wrong credentials... change this later");
    }
?>