<?php include '../includes/include.php';

if ($_GET['page'] === 'newsfeed') {

	$id = $_GET['id'];

	$results = $pdo->run("SELECT * FROM posts WHERE id > :id ORDER BY id DESC", array (
		':id' => array(
			'type' => 'int',
			'val'=> $id
		)
	));

}

if (isset($results) && (is_array($results) | is_object($results))) {
	foreach ($results as $result) {
		$post = new Post($result['id']);
		$user = $post->user;
		include '../includes/post.php';
	}
}
?>