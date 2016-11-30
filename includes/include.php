<?php

session_start();

// Site config
$CONF = array(
	'name' => 'Netty',
	'dir' => '/var/www/netty/public_html/',
	'url' => 'http://netty.local/'
);

$SQL = array(
	'host' => 'localhost',
	'user' => 'root',
	'password' => 'password',
	'db' => 'netty'
);

// Classes
include "{$CONF['dir']}includes/classes/Mysql.php";
$pdo = new Mysql($SQL['host'], $SQL['user'], $SQL['password'], $SQL['db']);
include "{$CONF['dir']}includes/classes/User.php";
include "{$CONF['dir']}includes/classes/Utils.php";

if (isset($_SESSION['uid']) && isset($_SESSION['token'])) {
	$viewer = new User($_SESSION['uid']);
	if (!$viewer->verifyLogin($_SESSION['token'])) {
		$viewer = false;
	}
}

?>