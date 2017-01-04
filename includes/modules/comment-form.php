<?php

if ((@include '../includes/include.php') === false) {
	include '../include.php';
}

?>

<div class="module module-<?=rand();?>" data-module="comment-form">
	<form class="comment-form">
		<input type="hidden" name="post_id" value="<?=$post->id;?>" />
		<div class="form-group">
			<textarea class="form-control"></textarea>
		</div>
	</form>
</div>