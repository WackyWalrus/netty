<!DOCTYPE html>
<html>
	<head>
		<title>netty</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		<link rel="stylesheet" type="text/css" href="<?=$CONF['url'];?>css/styles.css" />
	</head>
	<body>

		<div id="sidebar">
			<h2><?=$CONF['name'];?></h2>
			<?php if(isset($viewer)) { ?>
				<a href="<?=$CONF['url'];?>profile/<?=$viewer->username;?>"><span class="glyphicon glyphicon-sunglasses"></span> Profile</a>
				<a href="<?=$CONF['url'];?>"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span> Newsfeed</a>
				<a href="#"><span class="glyphicon glyphicon-comment" aria-hidden="true"></span> Messages</a>
				<a href="#"><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span> Events</a>
				<a href="#"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Find Friends</a>
			<?php } else { ?>
				<form action="<?=$CONF['url'];?>actions/login.php" method="post">
					<div class="form-group">
						<input type="text" name="username" class="form-control" placeholder="Username" />
					</div>
					<div class="form-group">
						<input type="password" name="password" class="form-control" placeholder="Password" />
					</div>
					<input type="submit" value="Login" class="btn btn-default btn-success" />
					<a href="<?=$CONF['url'];?>register/"<?php if($_SERVER['SCRIPT_NAME'] === '/register.php'){?> class="current"<?php } ?>><span class="glyphicon glyphicon-cog" aria-hidden="true"></span>Sign up</a>
				</form>
			<?php } ?>
		</div>

		<div id="main" class="container-fluid">
			<div class="heading">
				<?php if (isset($title) && $title !== undefined) { ?>
					<h4><?=$title;?></h4>
				<?php } ?>
				<form>
					<div class="form-group">
						<input type="text" class="form-control" />
					</div>
					<input type="submit" value="Search" class="btn btn-default btn-success" />
				</form>
			</div>
			<?php if ($content !== undefined) {
				echo $content;
			} ?>
		</div>

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
		<script src="<?=$CONF['url'];?>js/scripts.js" type="text/javascript"></script>
	</body>
</html>