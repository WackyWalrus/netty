<?php

if ((@include '../includes/include.php') === false) {
	include '../include.php';
}

if (isset($post)) {
	$placeholder = "Post comment...";
} else {
	$placeholder = "Post status...";
}

?>

<div class="module module-<?=rand();?>" data-module="comment-form">
	<form class="comment-form">
		<?php if(isset($post)) { ?>
			<input type="hidden" name="post_id" value="<?=$post->id;?>" />
		<?php } ?>
		<div class="form-group">
			<textarea class="form-control fancy" placeholder="<?=$placeholder;?>"></textarea>
		</div>
	</form>
</div>