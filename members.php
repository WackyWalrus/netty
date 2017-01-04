<?php include 'includes/include.php';

$js = array('events', 'friendButton');
$content = '';

if (isset($viewer)) {
	$title = "Members";

	$results = $pdo->run("SELECT id FROM users ORDER BY datestamp DESC LIMIT 10");

	foreach($results as $result) {
		$user = new User($result['id']);
		$content .= $user->html();
	}

} else {
	header("Location: {$CONF['url']}");
	die();
}

include 'includes/template.php';
?>