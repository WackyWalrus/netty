<?php

include '../includes/include.php';

$username = $_POST['username'];
$password = $_POST['password'];

$result = $pdo->run("SELECT id, hash, datestamp FROM users WHERE username = :username LIMIT 1",
	array(
		':username' => array(
			'val' => $username,
			'type' => 'str'
		)
	)
);
$hash = $result[0]['hash'];

if (password_verify($password, $hash)) {
	$string = $username . $result[0]['datestamp'];
	$token = password_hash($string, PASSWORD_BCRYPT); 

	$_SESSION['uid'] = $result[0]['id'];
	$_SESSION['token'] = $token;
}

header("Location: {$_SERVER['HTTP_REFERER']}");

?>