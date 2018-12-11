<?php 
	require_once("../includes/init.php");
	require_once($BASE_DIR."/database/post.php");
	require_once($BASE_DIR."/database/comment.php");

	$posts = getAllPosts();

	include_once($BASE_DIR."/actions/sort.php");

	include_once($BASE_DIR."/templates/common/header.php");
?>

<?php if (!isLoggedIn()) include_once($BASE_DIR."/templates/components/sign-bar.php"); ?>

<div id="feed-page" class="page">
	<?php
		include_once($BASE_DIR."/templates/components/search-bar.php");
		include_once($BASE_DIR."/templates/components/list-posts.php");

		if (isLoggedIn())
			include_once($BASE_DIR."/templates/components/newPost-bar.php");
		else {
			echo "<div class=\"free-space container\"></div>";
		}
	?>
</div>

<?php include_once($BASE_DIR."/templates/common/footer.php"); ?>