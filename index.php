<?php include 'includes/include.php';

$content = '';

if ($viewer) {
	$title = "Newsfeed";
	$results = $pdo->run("SELECT * FROM posts ORDER BY datestamp DESC LIMIT 10");
	$content .= <<<HTML
<div class="post-status">
	<form>
		<div class="form-group">
			<textarea placeholder="Post status..." class="form-control"></textarea>
		</div>
		<input type="submit" value="Post" class="btn btn-default btn-success" />
	</form>
</div>
HTML;

	ob_start();
	foreach($results as $result) {
		$user = new User($result['uid']);
		include 'includes/post.php';
	}
	$content .= ob_get_clean();
} else {
	$title = "Sign up!";
	$content .= <<<HTML
<p>Some content here about signing up</p>
HTML;
}

include 'includes/template.php';
?>