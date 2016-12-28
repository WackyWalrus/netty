<?php

include '../includes/include.php';

$array = array(
	':uid' => array(
		'col' => 'uid',
		'type' => 'int',
		'val' => $_POST['uid']
	),
	':post_id' => array(
		'col' => 'post_id',
		'type' => 'int',
		'val' => $_POST['post_id']
	),
	':type' => array(
		'col' => 'type',
		'type' => 'string',
		'val' => $_POST['type']
	),
	':datestamp' => array(
		'col' => 'datestamp',
		'type' => 'int',
		'val' => time()
	)
);

$check = $pdo->run("SELECT COUNT(*) FROM likes WHERE uid = :uid AND post_id = :post_id AND type = :type", $array);

if ($check[0]['COUNT(*)'] === 0) {
	$like = $pdo->insert($array, "likes");
	echo "1";
} else {
	$pdo->run("DELETE FROM likes WHERE uid = :uid AND post_id = :post_id AND type = :type", $array);
	echo "0";	
}


?>