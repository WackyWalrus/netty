<div class="post" id="post-<?=$result['id'];?>">
	<div class="post__user-info">
		<a href="<?=$user->url;?>"><img src="<?=$user->picUrl;?>" width="50" height="50" class="post__user-img img-circle" /></a>
		<div class="post__user-info__text">
			<div class="post__user-info__name"><a href="<?=$user->url;?>"><?=$user->username;?></a></div>
			<div class="post__user-info__datestamp"><?=Utils::EpochToDateTime($result['datestamp']);?></div>
		</div>
	</div>
	<div class="post__content"><?=nl2br($result['post']);?></div>
	<div class="post__options"><a href="#">Like</a> <a href="#">Comment</a> <a href="#">Share</a></div>
</div>