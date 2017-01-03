<?php $form = <<<HTML
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

<div class="module" data-module="feed-form">
	<?php if($_SERVER['SCRIPT_NAME'] === '/profile.php') {
		if ($user->id === $viewer->id) {
			echo $form;
		} else {
			if (in_array($user->id, $viewer->friends)) {
				echo $form;
			}
		}
	} else if($_SERVER['SCRIPT_NAME'] === '/index.php') {
		echo $form;
	} ?>
</div>