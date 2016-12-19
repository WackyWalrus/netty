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

$result = $pdo->run("SELECT * FROM posts WHERE id = :id", array(
	':id' => array(
		'type' => 'int',
		'val' => $id
	)
));

$user = $viewer;
$result = $result[0];

include "{$CONF['dir']}includes/post.php";

?>