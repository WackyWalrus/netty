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
			<a href="#"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>Newsfeed</a>
			<a href="#"><span class="glyphicon glyphicon-comment" aria-hidden="true"></span>Messages</a>
			<a href="#"><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span>Events</a>
			<a href="#"><span class="glyphicon glyphicon-user" aria-hidden="true"></span>Find Friends</a>
		</div>

		<div class="container-fluid">
			<div class="heading">
				<?php if ($title !== undefined) { ?>
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

		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	</body>
</html>