<?php

/* Returns the comment with the given ID */
function getCommentById($commentID) {
    global $dbh;
	try {
		$stmt = $dbh->prepare("SELECT *	FROM Comment WHERE commentID = ?");
		$stmt->execute(array($commentID));
		return $stmt->fetchAll();
	} catch(PDOException $e) {
		echo $e->getMessage();
		return null;
	}
}

/* Creates a new comment. SHOULD NOT USED ALONE! */
function addComment($userID, $content) {
    global $dbh;
	try {
		$stmt = $dbh->prepare("INSERT INTO Comment (userID, content) VALUES (?,?)");
        $stmt->execute(array($userID, $content));
        return $dbh->lastInsertId();  //TODO verify if it's ok with Teacher
	} catch(PDOException $e) {
		echo $e->getMessage();
		return null;
	}
}

/* Creates a new comment and binds it to a post */
function bindCommentToPost($postID, $userID, $content) {
    global $dbh;
	try {
        $newCommentID = addComment($userID, $content);
		$stmt = $dbh->prepare("INSERT INTO PostComment VALUES (?,?)");
		$stmt->execute(array($postID, $newCommentID));
		return 1;
	} catch(PDOException $e) {
		echo $e->getMessage();
		return -1;
	}
}

/* Removes a comment with the given ID */
function removeComment($commentID) {
    global $dbh;
	try {
		$stmt = $dbh->prepare("DELETE FROM Comment WHERE commentID = ?");
		$stmt->execute(array($commentID));
		return 1;
	} catch(PDOException $e) {
		echo $e->getMessage();
		return -1;
	}
}

/* User votes (up / down) on a Comment */
function commentVote($commentID, $userID, $vote) {
	global $dbh;
	try {
		$stmt = $dbh->prepare("INSERT INTO CommentVote VALUES (?,?,?)");
		$stmt->execute(array($commentID, $userID, $vote));
		return 1;
	} catch(PDOException $e) {
		echo $e->getMessage();
		return -1;
	}
}

/* Removes a vote of a User on a Comment */
function removePostVote($commentID, $userID) {
	global $dbh;
	try {
		$stmt = $dbh->prepare("DELETE FROM CommentVote WHERE commentID = ? AND userID = ?");
		$stmt->execute(array($commentID, $userID));
		return 1;
	} catch(PDOException $e) {
		echo $e->getMessage();
		return -1;
	}
}

?>