<?php

/* Returns posts ordered accordingly
* $cat - Category that is ordered by (p->points, d->date, c->number of comments)
* $order - Order of the result (a->ascendant, d->descendant)
*/
function getAllPosts($cat, $order) {
	global $dbh;

	try {
		switch($cat) {
			case "p":
				if($order == "a")
					$stmt = $dbh->prepare("SELECT * FROM Post ORDER BY points ASC");
				else if($order == "d")
					$stmt = $dbh->prepare("SELECT * FROM Post ORDER BY points DESC");
				break;
			case "d":
				if($order == "a")
					$stmt = $dbh->prepare("SELECT * FROM Post ORDER BY postDate ASC");
				else if($order == "d")
					$stmt = $dbh->prepare("SELECT * FROM Post ORDER BY postDate DESC");
				break;
			case "c":
				if($order == "a")
					$stmt = $dbh->prepare("SELECT * FROM Post LEFT JOIN PostComment ON Post.postID = PostComment.postID GROUP BY Post.postID ORDER BY count(commentID) ASC");
				else if($order == "d")	
					$stmt = $dbh->prepare("SELECT * FROM Post LEFT JOIN PostComment ON Post.postID = PostComment.postID GROUP BY Post.postID ORDER BY count(commentID) DESC");
			break;
		}

		$stmt->execute();
		return $stmt->fetchAll();
	} catch(PDOException $e) {
		echo $e->getMessage();
		return null;
	}
}

function getPostByUser($userID) {
	global $dbh;
	try {
		$stmt = $dbh->prepare("SELECT * FROM Post Where userID = ?");
		$stmt->execute(array($userID));
		return $stmt->fetchAll();
	} catch(PDOException $e) {
		echo $e->getMessage();
		return null;
	}
}

/* Returns the post with the given ID */
function getPostById($postID) {
	global $dbh;
	try {
		$stmt = $dbh->prepare("SELECT *	FROM Post WHERE postID = ?");
		$stmt->execute(array($postID));
		return $stmt->fetch();
	} catch(PDOException $e) {
		echo $e->getMessage();
		return null;
	}
}

/* Returns the number of comments of a post with the given ID */
function getNumberComments($postID) {
	global $dbh;
	try {
		$stmt = $dbh->prepare("SELECT count(*) as NbComments FROM PostComment Where postID = ?");
		$stmt->execute(array($postID));
		return $stmt->fetch();
	} catch(PDOException $e) {
		echo $e->getMessage();
		return null;
	}
}

// /* Returns the points of a post with the given ID */
// function getPostPoints($postID) {
// 	global $dbh;
// 	try {
// 		$stmt = $dbh->prepare("SELECT *	FROM PostVote WHERE postID = ?");
// 		$stmt->execute(array($postID));
// 		$stmt->fetchAll();

// 		$points = 0;
// 		foreach($stmt as $vote) {
// 			if($vote['vote'] == 1)
// 				$points++;
// 			else
// 				$points--;
// 		}
		
// 		return $points;
// 	} catch(PDOException $e) {
// 		echo $e->getMessage();
// 		return null;
// 	}
// }

/* Add a new Post */
function addPost($userID, $title, $content) {
	global $dbh;
	try {
		$stmt = $dbh->prepare("INSERT INTO Post (userID,title,content) VALUES (?,?,?)");
		$stmt->execute(array($userID, $title, $content));
		return 1;
	} catch(PDOException $e) {
		echo $e->getMessage();
		return -1;
	}
}

/* Remove a Post with the given ID */
function removePost($postID) {
	global $dbh;
	try {
		$stmt = $dbh->prepare("DELETE FROM Post WHERE postID = ?");
		$stmt->execute(array($postID));
		return 1;
	} catch(PDOException $e) {
		echo $e->getMessage();
		return -1;
	}
}

/* User votes (up / down) on a Post */
function postVote($postID, $userID, $vote) {
	global $dbh;
	try {
		$stmt = $dbh->prepare("INSERT INTO PostVote VALUES (?,?,?)");
		$stmt->execute(array($postID, $userID, $vote));
		return 1;
	} catch(PDOException $e) {
		echo $e->getMessage();
		return -1;
	}
}

/* Removes a vote of a User on a Post */
function removePostVote($postID, $userID) {
	global $dbh;
	try {
		$stmt = $dbh->prepare("DELETE FROM PostVote WHERE postID = ? AND userID = ?");
		$stmt->execute(array($postID, $userID));
		return 1;
	} catch(PDOException $e) {
		echo $e->getMessage();
		return -1;
	}
}

?>