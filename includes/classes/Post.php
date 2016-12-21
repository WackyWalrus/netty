<?php

class Post {
	function __construct($id) {
		global $pdo;

		$result = $pdo->run("SELECT * FROM posts WHERE id = :id LIMIT 1", array(
			':id' => array(
				'type' => 'int',
				'val' => $id
			)
		));

		$this->id = $id;
		$this->uid = $result[0]['uid'];
		$this->post = $result[0]['post'];
		$this->link = $result[0]['link'];
		$this->datestamp = $result[0]['datestamp'];

		$this->user = new User($this->uid);
	}

	function likes() {
		global $pdo;

		$result = $pdo->run("SELECT COUNT(*) FROM likes WHERE post_id = :post_id", array(
			':post_id' => array(
				'type' => 'int',
				'val' => $this->id
			)
		));

		$this->likes = $result[0]['COUNT(*)'];
		return $this->likes;
	}
}

?>