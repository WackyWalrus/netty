<?php include 'includes/include.php';

$js = array('events', 'feed');
$content = '';

/**
 * SELECT posts.id, posts.uid, friendships.user_a, friendships.user_b FROM posts
 * INNER JOIN friendships ON posts.uid = friendships.user_a OR posts.uid = friendships.user_b
 * WHERE friendships.user_a = 1002 OR friendships.user_b = 1002;
 */

if (isset($viewer)) {
	$title = "Newsfeed";
	$results = $pdo->run("SELECT posts.id, posts.uid, friendships.user_a, friendships.user_b FROM posts INNER JOIN friendships ON posts.uid = friendships.user_a OR posts.uid = friendships.user_b WHERE friendships.user_a = :viewer1 OR friendships.user_b = :viewer2 ORDER BY posts.id DESC", array(
		':viewer1' => array(
			'type' => 'int',
			'val' => $viewer->id
		),
		':viewer2' => array(
			'type' => 'int',
			'val' => $viewer->id
		)
	));
	$content .= <<<HTML
<div class="post-status">
	<div class="form-group">
		<textarea placeholder="Post status..." class="form-control"></textarea>
	</div>
	<button class="btn btn-default btn-success">Post</button>
</div>
HTML;
	$content .= '<div class="posts">';
	ob_start();
	foreach($results as $result) {
		$post = new Post($result['id']);
		echo $post->html();
	}
	$content .= ob_get_clean();
	$content .= '</div>';
} else {
	$js[] = 'homepage';
	$title = "Sign up!";
	$content .= <<<HTML
<p>Some content here about signing up</p>
HTML;
}

include 'includes/template.php';
?>
