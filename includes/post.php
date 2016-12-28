<div class="post" id="post-<?=$post->id;?>">
	<div class="post__user-info">
		<a href="<?=$user->url;?>"><img src="<?=$user->picUrl;?>" width="50" height="50" class="post__user-img img-circle" /></a>
		<div class="post__user-info__text">
			<div class="post__user-info__name"><a href="<?=$user->url;?>"><?=$user->username;?></a></div>
			<div class="post__user-info__datestamp"><?=Utils::EpochToDateTime($post->datestamp);?></div>
		</div>
	</div>
	<div class="post__content"><?=nl2br($post->post);?></div>
	<div class="post__options">
		<a href="#" class="action-like"><span class="num"><?=$post->likes();?></span> Like<span class="s"><?php if($post->likes !== 1){?>s<?php } ?></span></a> 
		<a href="#">Comment</a> 
		<a href="#">Share</a>
	</div>
</div>