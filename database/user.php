<?php
	function isLoginCorrect($username, $password) {
    	global $dbh;
    	$stmt = $dbh->prepare('SELECT * FROM user WHERE username = ? AND pass = ?');
    	$stmt->execute(array($username, hash('sha256', $password)));
    	return $stmt->fetch() !== false;
  	}
?>