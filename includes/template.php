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
			<a href="#">home</a>
		</div>

		<div class="container-fluid">
			<?=$content;?>
		</div>

		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	</body>
</html>