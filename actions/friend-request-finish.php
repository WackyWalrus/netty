<?php

include '../includes/include.php';

$id = $_POST['id'];
$action = $_POST['action'];

if ($action === 'request') {
	$insert_id = $pdo->insert(array(
		':user_a' => array(
			'col' => 'user_a',
			'type' => 'int',
			'val' => $viewer->id
		),
		':user_b' => array(
			'col' => 'user_b',
			'type' => 'int',
			'val' => $id
		),
		':active' => array(
			'col' => 'active',
			'type' => 'int',
			'val' => 0
		),
		':datestamp' => array(
			'col' => 'datestamp',
			'type' => 'int',
			'val' => time()
		)
	), 'friendships');

	if ($insert_id) {
		echo "Friendship requested!";
		return true;
	}
	return false;
}

?>