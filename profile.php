<?php include 'includes/include.php';

$checkUser = $pdo->run("SELECT id FROM users WHERE username = :username",
	array(
		':username' => array(
			'val' => $_GET['username'],
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

$title = $user->username;
$content = <<<HTML
<div class="profile">
	<img src="{$CONF['url']}images/mike.jpeg" width="150" height="150" class="profile__user-img img-circle" />
	<div class="profile__user-info">
		<h3>{$user->username}</h3>
		<p>{$user->datestamp}</p>
	</div>
</div>
HTML;

include 'includes/template.php';
?>