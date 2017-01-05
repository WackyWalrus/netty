<?php

if ((@include_once '../includes/include.php') === false) {
	include_once '../includes.php';
}

$pid = $_POST['post_id'];
$comment = $_POST['comment'];
$time = time();

$insert_id = $pdo->insert(array(
	':pid' => array(
		'col' => 'pid',
		'type' => 'int',
		'val' => $pid
	),
	':uid' => array(
		'col' => 'uid',
		'type' => 'int',
		'val' => $viewer->id
	),
	':comment' => array(
		'col' => 'comment',
		'type' => 'string',
		'val' => $comment
	),
	':datestamp' => array(
		'col' => 'datestamp',
		'type' => 'int',
		'val' => $time
	)
));

if ($insert_id) {
}

?>