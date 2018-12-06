<?php

/* Checks if the Login information is correct */
function isLoginCorrect($userID, $password) {
	global $dbh;
	$stmt = $dbh->prepare("SELECT * FROM User WHERE userID = ? AND pass = ?");
	$stmt->execute(array($userID, hash("sha256", $password)));
	return $stmt->fetch() !== false;
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
		$stmt->execute(array($userID, $username, hash('sha256', $password), $email));
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
function updateUserInfo($userID, $username, $mail, $bio, $birthDay) {
	global $dbh;

	//Date must be in format "YYYY-MM-DD"
	if (!preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $birthDay)) {
		echo "Error updating User's info! : birthDay INCORRECT FORMAT!";
		return -1;
	}

	try {
		$stmt = $dbh->prepare("UPDATE User SET username = ?, mail = ?, bio = ?, birthDay = ? WHERE userID = ?");
		$stmt->execute(array($username, $mail, $bio, $birthDay, $userID));
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
		$stmt->execute(array(hash('sha256', $password), $userID));
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