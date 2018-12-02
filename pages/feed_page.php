<?php 
	require_once($_SERVER['DOCUMENT_ROOT'].'/includes/init.php'); 
	include_once($_SERVER['DOCUMENT_ROOT'].'/templates/common/header.php');
?>

<div id='feed' class='page'>
	<?php include_once($_SERVER['DOCUMENT_ROOT'].'/templates/components/side-bar.php'); ?>
	
	<div id='list-posts'>
		<?php 
			include_once($_SERVER['DOCUMENT_ROOT'].'/database/post.php');
			$posts = getAllPosts('p', 'd');
			foreach($posts as $post) { 
				include($_SERVER['DOCUMENT_ROOT'].'/templates/components/story-post.php'); 
			}
		?>
	</div>
</div>

<?php include_once($_SERVER['DOCUMENT_ROOT'].'/templates/common/footer.php'); ?>