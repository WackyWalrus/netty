<?php if ((@include_once 'includes/include.php') === false) {
	include_once '../include.php';
}

if (isset($_GET['user_id'])) {
	$user = new User($_GET['user_id']);
}

if (isset($_GET['page'])) {
	$page = $_GET['page'];
} else {
	$page = $_SERVER['SCRIPT_NAME'];
}

$form = <<<HTML
<div class="post-status">
	<form>
		<div class="form-group">
			<textarea placeholder="Post status..." class="form-control"></textarea>
		</div>
		<input type="submit" value="Post" class="btn btn-default btn-success" />
	</form>
</div>
HTML;
?>

<div class="module module-<?=rand();?>" data-module="feed-form">
	<input type="hidden" name="user_id" value="<?=$user->id;?>" />
	<input type="hidden" name="page" value="<?=$page;?>" />
	<?php if($page === '/profile.php') {
		if ($user->id === $viewer->id) {
			echo $form;
		} else {
			if (in_array($user->id, $viewer->friends)) {
				echo $form;
			}
		}
	} else if($page === '/index.php') {
		echo $form;
	} ?>
</div>