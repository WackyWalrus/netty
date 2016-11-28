<div class="post">
	<div class="post__user-info">
		<img src="<?=$CONF['url'];?>images/mike.jpeg" width="50" height="50" class="post__user-img img-circle" />
		<div class="post__user-info__text">
			<div class="post__user-info__name"><?=$user->username;?></div>
			<div class="post__user-info__datestamp"><?=date('m/d/y g:ia', $result['datestamp']);?></div>
		</div>
	</div>
	<div class="post__content"><?=$result['post'];?></div>
	<div class="post__options"><a href="#">Like</a> <a href="#">Comment</a> <a href="#">Share</a></div>
</div>