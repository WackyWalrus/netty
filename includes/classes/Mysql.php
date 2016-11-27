<?php

class Mysql {
	function __construct($host, $user, $pass, $db) {
		$opt = [
		    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
		    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
		    PDO::ATTR_EMULATE_PREPARES   => false,
		];
		$this->pdo = new PDO("mysql:host={$host};dbname={$db};charset=utf8", $user, $pass, $opt);
	}

	function run($query, $args) {
		try {
			$stmt = $this->pdo->prepare($query);
		} catch(PDOException $e) {
			throw $e;
			return false;
		}



		if (count($args)) {
			foreach($args as $key => $arr) {
				if ($arr['type'] === 'int') {
					$stmt->bindValue($key, $arr['val'], PDO::PARAM_INT);
				} else {
					$stmt->bindValue($key, $arr['val'], PDO::PARAM_STR);
				}
			}
		}

		$stmt->execute();

		$array = array();
		while ($result = $stmt->fetch()) {
			$array[] = $result;
		}

		if (count($array)) {
			return $array;
		}
		return false;
	}
}


?>