<?php
	require_once($_SERVER['DOCUMENT_ROOT'].'/includes/init.php');

  	function getAllPosts() {
    	global $dbh;
    	$stmt = $dbh->prepare("SELECT * FROM post");
    	$stmt->execute();
    	return $stmt->fetchAll();
  	}
?>