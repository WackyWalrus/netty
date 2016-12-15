<?php

include 'includes/include.php';

$mime = 'images/jpeg';
$default_pic = "{$CONF['url']}images/default.jpeg";
$id = intval($_GET['id']);

if (!$id) {
	$img = $default_pic;
} else {
	$glob = glob("{$CONF['dir']}images/users/{$id}.*");
	if (!empty($glob) && strlen($glob[0])) {
		$mime = mime_content_type($glob[0]);
		$img = str_replace($CONF['dir'], $CONF['url'], $glob[0]);
	} else {
		$img = $default_pic;
	}
}

header("Content-Type: {$mime}");

if (isset($img) && strlen($img)) {
	print file_get_contents($img);
}

?>