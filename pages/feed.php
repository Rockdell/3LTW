<?php 
	require_once($_SERVER["DOCUMENT_ROOT"]."/includes/init.php");
	require_once($_SERVER["DOCUMENT_ROOT"]."/database/post.php");
	require_once($_SERVER["DOCUMENT_ROOT"]."/database/comment.php");

	$posts = getAllPosts();

	include_once($_SERVER["DOCUMENT_ROOT"]."/actions/sort.php");

	include_once($_SERVER["DOCUMENT_ROOT"]."/templates/common/header.php");
?>

<?php if (!isLoggedIn()) include_once($_SERVER["DOCUMENT_ROOT"]."/templates/components/sign-bar.php"); ?>

<div id="feed-page" class="page">
	<?php
		include_once($_SERVER["DOCUMENT_ROOT"]."/templates/components/search-bar.php");
		include_once($_SERVER["DOCUMENT_ROOT"]."/templates/components/list-posts.php");

		if (isLoggedIn())
			include_once($_SERVER["DOCUMENT_ROOT"]."/templates/components/newPost-bar.php");
		else {
			echo "<div class=\"free-space container\"></div>";
		}
	?>
</div>

<?php include_once($_SERVER["DOCUMENT_ROOT"]."/templates/common/footer.php"); ?>