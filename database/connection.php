<?php	
    $dbh = new PDO('sqlite:'.$BASE_DIR.'/database/redditter.db');
    $dbh->exec('PRAGMA foreign_keys = ON;');
    $dbh->exec('PRAGMA recursive_triggers = ON;');
    $dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>