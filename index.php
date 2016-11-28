<?php include 'includes/include.php';

$title = "Newsfeed";
$content = '';

$results = $pdo->run("SELECT * FROM posts ORDER BY datestamp DESC LIMIT 10");

$content .= <<<HTML
<div class="post-status">
	<form>
		<div class="form-group">
			<input type="text" placeholder="Post status..." class="form-control" />
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

include 'includes/template.php';
?>