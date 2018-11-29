<?php
  function getAllPosts() {
    global $dbh;
    $stmt = $dbh->prepare("SELECT * FROM post ORDER BY postDate");
    $stmt->execute();
    return $stmt->fetchAll();
  }
?>