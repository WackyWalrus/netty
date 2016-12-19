<?php include 'includes/include.php';

$js = array('events', 'feed');
$content = '';

if (isset($viewer)) {
	$title = "Newsfeed";
	$results = $pdo->run("SELECT * FROM posts ORDER BY datestamp DESC LIMIT 10");
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
		$user = new User($result['uid']);
		include 'includes/post.php';
	}
	$content .= ob_get_clean();
	$content .= '</div>';
} else {
	$title = "Sign up!";
	$content .= <<<HTML
<p>Some content here about signing up</p>
HTML;
}

include 'includes/template.php';
?>