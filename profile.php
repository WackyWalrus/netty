<?php include 'includes/include.php';
$js = array('events', 'feed', 'profile');

$username = str_replace('/', '', $_GET['username']);

$checkUser = $pdo->run("SELECT id FROM users WHERE username = :username",
	array(
		':username' => array(
			'val' => $username,
			'type' => 'str'
		)
	)
);

if (isset($checkUser) && !empty($checkUser)) {
	if (isset($checkUser[0]['id'])) {
		$user = new User($checkUser[0]['id']);
	} else {
		$title = "User not found";
	}
} else {
	$title = "User not found";
}

$title = '';
$content = <<<HTML
<div class="profile" id="profile-$user->id">
	<img src="{$user->picUrl}" width="150" height="150" class="profile__user-img img-circle" />
	<div class="profile__user-info">
		<h3>{$user->username}</h3>
HTML;

$content .= "<p>Joined " . Utils::EpochToDateTime($user->datestamp) . "</p>";

$viewer->friends();

$content .= Utils::includeToVar('includes/modules/friend-request-button.php', array('user', 'viewer'));

$content .= <<<HTML
	</div>
</div>
<div class="wall">
HTML;

$content .= Utils::includeToVar('includes/modules/feed-form.php', array('user', 'viewer'));

$results = $pdo->run("SELECT id FROM posts WHERE uid = :uid ORDER BY datestamp DESC LIMIT 10",
	array(
		':uid' => array(
			'val' => $user->id,
			'type' => 'int'
		)
	)
);

foreach($results as $result) {
	$post = new Post($result['id']);
	$content .= $post->html();
}

$content .= "</div>";

include 'includes/template.php';
?>