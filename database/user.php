<?php

/* Checks if the Login information is correct */
function isLoginCorrect($userID, $password) {
	global $dbh;
	$stmt = $dbh->prepare("SELECT * FROM User WHERE userID = ?");
	$stmt->execute(array($userID));
	$user = $stmt->fetch();
	return $user !== false && password_verify($password, $user["pass"]);
}

/* Returns the user with the given ID */
function getUserById($userID) {
	global $dbh;
	try {
		$stmt = $dbh->prepare("SELECT *	FROM User WHERE userID = ?");
		$stmt->execute(array($userID));
		return $stmt->fetch();
	} catch(PDOException $e) {
		echo $e->getMessage();
		return null;
	}
}

/* Add a new User */
function addUser($userID, $username, $password, $email) {
	global $dbh;
	try {
		$stmt = $dbh->prepare("INSERT INTO User (userID,username,pass,mail) VALUES (?,?,?,?)");
		$stmt->execute(array($userID, $username, password_hash($password, PASSWORD_DEFAULT), $email));
		return 1;
	} catch(PDOException $e) {
		echo $e->getMessage();
		return -1;
	}
}

/* Remove a User with the given ID */
function removeUser($userID) {
	global $dbh;
	try {
		$stmt = $dbh->prepare("DELETE FROM User WHERE userID = ?");
		$stmt->execute(array($userID));
		return 1;
	} catch(PDOException $e) {
		echo $e->getMessage();
		return -1;
	}
}

/* Updates a User's information */
function updateUserInfo($userID, $username, $mail, $bio) {
	global $dbh;

	try {
		$stmt = $dbh->prepare("UPDATE User SET username = ?, mail = ?, bio = ? WHERE userID = ?");
		$stmt->execute(array($username, $mail, $bio, $userID));
		return 1;
	} catch(PDOException $e) {
		echo $e->getMessage();
		return -1;
	}
}

// /* Updates a User's password */
function updateUserPassword($userID, $password) {
	global $dbh;
	try {
		$stmt = $dbh->prepare("UPDATE User SET pass = ? WHERE userID = ?");
		$stmt->execute(array(password_hash($password, PASSWORD_DEFAULT), $userID));
		return 1;
	} catch(PDOException $e) {
		echo $e->getMessage();
		return -1;
	}
}

/* Returns the vote on a current post if the user has already done so */
function getSingleUserPostVote($userID, $postID) {
	global $dbh;
	try {
		$stmt = $dbh->prepare("SELECT * FROM PostVote WHERE userID = ? AND postID = ?");
		$stmt->execute(array($userID, $postID));
		return $stmt->fetch();
	} catch(PDOException $e) {
		echo $e->getMessage();
		return null;
	}
}

/* Returns the vote on a current post if the user has already done so */
function getSingleUserCommentVote($userID, $commentID) {
	global $dbh;
	try {
		$stmt = $dbh->prepare("SELECT * FROM CommentVote WHERE userID = ? AND commentID = ?");
		$stmt->execute(array($userID, $commentID));
		return $stmt->fetch();
	} catch(PDOException $e) {
		echo $e->getMessage();
		return null;
	}
}

/* Returns the postIDs of the posts that a user has already voted for */
function getUserPostVotes($userID) {
	global $dbh;
	try {
		$stmt = $dbh->prepare("SELECT * FROM PostVote WHERE userID = ?");
		$stmt->execute(array($userID));
		return $stmt->fetchAll();
	} catch(PDOException $e) {
		echo $e->getMessage();
		return null;
	}
}

?>