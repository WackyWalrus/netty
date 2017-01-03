<?php include 'includes/include.php';

$title = "Requests";

$js = array('events', 'feed');
$content = '';

$viewer->friends();
$viewer->requests;

foreach($viewer->requests as $request) {
	$user = new User($request);
	$content .= $user->html();
}

include 'includes/template.php';
?>
