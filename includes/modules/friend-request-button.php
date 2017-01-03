<?php if ((@include_once 'includes/include.php') === false) {
	include_once '../include.php';
}
$viewer->friends();
if (isset($_GET['user_id'])) {
	$user = new User($_GET['user_id']);
	$user->friends();
}
?>

<div class="module" data-module="friend-request-button">
	<input type="hidden" name="user_id" value="<?=$user->id;?>"  />
	<?php if ($user->id !== $viewer->id) {
		if (in_array($user->id, $viewer->friends)) { ?>
			<button class="btn btn-default friend-btn">Remove Friends</button>
		<?php }
		if (in_array($user->id, $viewer->pending)) { ?>
			<button class="btn btn-default friend-btn">Pending Request</button>
		<?php }
		if (!in_array($user->id, $viewer->friends) && !in_array($user->id, $viewer->pending)) { ?>
			<button class="btn btn-default friend-btn">Add as Friend</button>
		<?php }
	} ?>
</div>