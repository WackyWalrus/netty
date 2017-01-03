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
} else {
	$f_id = $pdo->run("SELECT id FROM friendships WHERE (user_a = :user_a1 AND user_b = :user_b1) OR (user_a = :user_a2 AND user_b = :user_b2) LIMIT 1", array(
		':user_a1' => array(
			'type' => 'int',
			'val' => $viewer->id
		),
		':user_b1' => array(
			'type' => 'int',
			'val' => $id
		),
		':user_a2' => array(
			'type' => 'int',
			'val' => $id
		),
		':user_b2' => array(
			'type' => 'int',
			'val' => $viewer->id
		)
	));

	if (isset($f_id[0]['id'])) {
		if (intval($f_id[0]['id'])) {
			$pdo->run("DELETE FROM friendships WHERE id = :id", array(
				':id' => array(
					'type' => 'int',
					'val' => intval($f_id[0]['id'])
				)
			));

			if ($action === 'cancel') {
				echo "Friend request cancelled";
			} else if ($action === 'remove') {
				echo "Friend removed";
			}
		}
	}
}

?>