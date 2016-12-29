<?php

include '../includes/include.php';

if (!isset($viewer)) {
	die();
}

$msg = $_POST['msg'];
$time = time();

$id = $pdo->insert(array(
		':uid' => array(
			'type' => 'int',
			'val' => $viewer->id,
			'col' => 'uid'
		),
		':post' => array(
			'type' => 'string',
			'val' => $msg,
			'col' => 'post'
		),
		':datestamp' => array(
			'type' => 'int',
			'val' => $time,
			'col' => 'datestamp'
		)
	), 'posts'
);

$post = new Post($result[0]['id']);
$user = $post->user;
include "{$CONF['dir']}includes/post.php";

?>