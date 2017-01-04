<?php if ((@include_once 'includes/include.php') === false) {
	include_once '../include.php';
}
$viewer->friends();
if (isset($_GET['user_id'])) {
	$user = new User($_GET['user_id']);
}
?>

<div class="module module-<?=rand();?>" data-module="friend-request-button">
	<input type="hidden" name="user_id" value="<?=$user->id;?>"  />
	<?php if ($user->id !== $viewer->id) {
		if (in_array($user->id, $viewer->friends)) { ?>
			<button class="btn btn-default friend-btn">Remove Friend</button>
		<?php }
		if (in_array($user->id, $viewer->pending)) { ?>
			<button class="btn btn-default friend-btn">Pending Request</button>
		<?php }
		if (in_array($user->id, $viewer->requests)) { ?>
			<button class="btn btn-default friend-btn">Accept Request</button>
		<?php }
		if (!in_array($user->id, $viewer->friends) && !in_array($user->id, $viewer->pending) && !in_array($user->id, $viewer->requests)) { ?>
			<button class="btn btn-default friend-btn">Add as Friend</button>
		<?php }
	} ?>
</div>