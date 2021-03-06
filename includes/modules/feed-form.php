<?php include_once 'includes/include.php';

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
HTML;
			$form .= Utils::includeToVar("{$CONF['dir']}includes/modules/comment-form.php");
			$form .= <<<HTML
		</div>
		<button type="button" class="btn btn-default btn-success">Post</button>
	</form>
</div>
HTML;
?>

<div class="module module-<?=rand();?>" data-module="feed-form">
	<?php if(isset($_GET['user_id'])) { ?>
		<input type="hidden" name="user_id" value="<?=$user->id;?>" />
	<?php } ?>
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