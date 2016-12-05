<?php

include 'includes/include.php';

$default_pic = "{$CONF['url']}images/default.jpg";
$id = intval($_GET['id']);

header('Content-Length: '.filesize($fn));
header('Content-Type: image/png');

if (!$id) {
	$img = $default_pic;
} else {
	$glob = glob("{$CONF['dir']}images/users/{$id}.*");
	if (strlen($glob[0])) {
		$img = str_replace($CONF['dir'], $CONF['url'], $glob[0]);
	}
}

if (isset($img) && strlen($img)) {
	header('Content-Length: ' . filesize($img));
	print file_get_contents($img);
}

?>