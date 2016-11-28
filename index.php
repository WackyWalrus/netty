<?php include 'includes/include.php';

$title = "Newsfeed";
$content = '';

$results = $pdo->run("SELECT * FROM posts LIMIT 10");


foreach($results as $result) {
	$user = new User($result['uid']);
	$content .= '<div class="post">';
		$content .= '<div class="post__user-info">';
			$content .= '<img src="images/mike.jpeg" width="50" height="50" class="post__user-img img-circle" />';
			$content .= '<div class="post__user-info__text">';
				$content .= '<div class="post__user-info__name">' . $user->username . '</div>';
				$content .= '<div class="post__user-info__datestamp">' . $result['datestamp'] . '</div>';
			$content .= '</div>';
		$content .= '</div>';
		$content .= '<div class="post__content">' . $result['post'] . '</div>';
		$content .= '<div class="post__options"><a href="#">Like</a> <a href="#">Comment</a> <a href="#">Share</a></div>';
	$content .= '</div>';
}

include 'includes/template.php';
?>