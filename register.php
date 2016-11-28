<?php include 'includes/include.php';

$title = "Register";
$content = '';

$results = $pdo->run("SELECT * FROM posts ORDER BY datestamp DESC LIMIT 10");

$content .= <<<HTML
<div class="register-form">
	<form action="{$CONF['url']}actions/register.php" method="post">
		<div class="form-group">
			Username
			<input type="text" name="username" class="form-control" />
		</div>
		<div class="form-group">
			Email
			<input type="email" name="email" class="form-control" />
		</div>
		<div class="form-group">
			Password
			<input type="password" name="pass1" class="form-control" />
		</div>
		<div class="form-group">
			Repeat Password
			<input type="password" name="pass2" class="form-control" />
		</div>
		<input type="submit" value="Register" class="btn btn-default btn-success" />
	</form>
</div>
HTML;

include 'includes/template.php';
?>