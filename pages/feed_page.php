<?php
	include_once($_SERVER['DOCUMENT_ROOT'].'/templates/common/header.php');

	include_once($_SERVER['DOCUMENT_ROOT'].'/templates/side-bar.php');
?>

<div id='list-posts'>
<?php
	include_once($_SERVER['DOCUMENT_ROOT'].'/database/post.php');
	$posts = getAllPosts();

	foreach($posts as $post) {
		include($_SERVER['DOCUMENT_ROOT'].'/templates/story-post.php');
	}
?>
</div>

<?php
	include_once($_SERVER['DOCUMENT_ROOT'].'/templates/user-bar.php');

	include_once($_SERVER['DOCUMENT_ROOT'].'/templates/common/footer.php'); 
?>