<?php

class User {
	function __construct($id) {
		global $pdo;
		$id = intval($id);

		$u = $pdo->run("SELECT * FROM users WHERE id = :id", array(
			':id' => array ('val' => $id, 'type' => 'int')
		));

		$this->username = $u[0]['username'];
		$this->datestamp = $u[0]['datestamp'];

		$d = $pdo->run("SELECT * FROM data WHERE d_id = :d_id AND type = :type", array(
			':d_id' => array ('val' => $id, 'type' => 'int'),
			':type' => array ('val' => 'user', 'type' => 'string')
		));
	}

	function verifyLogin($token) {
		return password_verify($this->username . $this->datestamp, $token);
	}
}

?>