<?php

class User {
	function __construct($id) {
		global $pdo;
		global $CONF;
		$id = intval($id);

		$u = $pdo->run("SELECT * FROM users WHERE id = :id", array(
			':id' => array ('val' => $id, 'type' => 'int')
		));

		$this->id = $id;
		$this->username = $u[0]['username'];
		$this->datestamp = $u[0]['datestamp'];

		$this->picUrl = "{$CONF['url']}profile-img/{$this->id}/";
		$this->url = "{$CONF['url']}profile/{$this->username}/";

		$d = $pdo->run("SELECT * FROM data WHERE d_id = :d_id AND type = :type", array(
			':d_id' => array ('val' => $id, 'type' => 'int'),
			':type' => array ('val' => 'user', 'type' => 'string')
		));
		$this->data = $d;
	}

	function verifyLogin($token) {
		return password_verify($this->username . $this->datestamp, $token);
	}

	function friends() {
		global $pdo;

		$results = $pdo->run("SELECT user_a, user_b FROM friendships WHERE user_a = :user_a OR user_b = :user_b",
			array(
				':user_a' => array(
					'val' => $this->id,
					'type' => 'int'
				),
				':user_b' => array(
					'val' => $this->id,
					'type' => 'int'
				)
			)
		);

		$friends = array();
		foreach ($results as $result) {
			if ($result['user_a'] !== null &&
					$result['user_a'] !== undefined &&
					$result['user_b'] !== null &&
					$result['user_b'] !== undefined) {
				if ($result['user_a'] === $this->id) {
					$friends[] = $result['user_b'];
				} else {
					$friends[] = $result['user_a'];
				}
			}
		}

		return $friends;
	}
}

?>