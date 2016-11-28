<?php

session_start();

include '../includes/include.php';

$username = $_POST['username'];
$email = $_POST['email'];
$pass1 = $_POST['pass1'];
$pass2 = $_POST['pass2'];

/**
 * Check that they filled out all the fields
 */
if (!strlen($username) || !strlen($pass1) || !strlen($pass2)) {
	die();
}

/**
 * Check if the passwords are the same
 */
if ($pass1 !== $pass2) {
	die();
}

/**
 * Check if the username is taken
 */

$userCount = $pdo->run("SELECT COUNT(*) FROM users WHERE username = :username OR email = :email",
	array(
		':username' => array(
			'type' => 'str',
			'val' => $username
		),
		':email' => array(
			'type' => 'str',
			'val' => $email
		)
	)
);

if ($userCount[0]['COUNT(id)'] > 0) {
	die();
}


/**
 * Make datestamp
 */
$time = time();

/**
 * Make hash
 */
$options = [
    'cost' => 11,
    'salt' => md5($time),
];
$hash = password_hash($pass1, PASSWORD_BCRYPT, $options);

/**
 * Insert user
 */
$id = $pdo->insert(array(
	':username' => array(
		'type' => 'str',
		'val' => $username,
		'col' => 'username'
	),
	':email' => array(
		'type' => 'str',
		'val' => $email,
		'col' => 'email'
	),
	':hash' => array(
		'type' => 'str',
		'val' => $hash,
		'col' => 'hash'
	),
	':datestamp' => array(
		'type' => 'str',
		'val' => $time,
		'col' => 'datestamp'
	)
), "users");

$string = $u['username'].$u['datestamp'];
$token = password_hash($string, PASSWORD_BCRYPT); 

$_SESSION['uid'] = $u['id'];
$_SESSION['token'] = $token;

header("Location: {$CONF['url']}");
die();

?>