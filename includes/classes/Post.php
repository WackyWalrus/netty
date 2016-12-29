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
		$this->likes();
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

	function html() {
		$user = $this->user;
		$date = Utils::EpochToDateTime($this->datestamp);
		$content = nl2br($this->post);
		$s = ($this->likes !== 1) ? 's' : '';
		$html = <<<HTML
<div class="post" id="post-$this->id">
	<div class="post__user-info">
		<a href="$user->url"><img src="$user->picUrl" width="50" height="50" class="post__user-img img-circle" /></a>
		<div class="post__user-info__text">
			<div class="post__user-info__name"><a href="$user->url">$user->username</a></div>
			<div class="post__user-info__datestamp">$date</div>
		</div>
	</div>
	<div class="post__content">$content</div>
	<div class="post__options">
		<a href="#" class="action-like"><span class="num">$this->likes</span> Like<span class="s">$s</span></a> 
		<a href="#">Comment</a> 
		<a href="#">Share</a>
	</div>
</div>
HTML;
		return $html;
	}
}

?>