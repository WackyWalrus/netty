<?php include 'includes/include.php';

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
<div class="profile">
	<img src="{$user->picUrl}" width="150" height="150" class="profile__user-img img-circle" />
	<div class="profile__user-info">
		<h3>{$user->username}</h3>
HTML;

$content .= "<p>Joined " . Utils::EpochToDateTime($user->datestamp) . "</p>";

$viewer->friends();

if ($user->id !== $viewer->id) {
	if (in_array($user->id, $viewer->friends)) {
		$content .= '<button class="btn btn-default">Remove Friends</button>';
	}
	if (in_array($user->id, $viewer->pending)) {
		$content .= '<button class="btn btn-default">Pending Request</button>';
	}
	if (!in_array($user->id, $viewer->friends)) {
		$content .= '<button class="btn btn-default">Add as Friend</button>';
	}
}

$content .= <<<HTML
	</div>
</div>
HTML;

include 'includes/template.php';
?>