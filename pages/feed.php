<?php 
	require_once($_SERVER["DOCUMENT_ROOT"]."/includes/init.php");
	require_once($_SERVER["DOCUMENT_ROOT"]."/database/post.php");
	require_once($_SERVER["DOCUMENT_ROOT"]."/database/comment.php");

	$posts = getAllPosts("p", "d");

	include_once($_SERVER["DOCUMENT_ROOT"]."/templates/common/header.php");
?>

<div id="feed-page" class="page">
	<?php
		include_once($_SERVER["DOCUMENT_ROOT"]."/templates/components/list-posts.php");
		include_once($_SERVER["DOCUMENT_ROOT"]."/templates/components/search-bar.php");
	?>
</div>

<?php include_once($_SERVER["DOCUMENT_ROOT"]."/templates/common/footer.php"); ?>