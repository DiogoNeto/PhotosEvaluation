<?php
// Start the session
session_start();
?>
<!DOCTYPE html>
<html>
<head>
<title>Photos</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
 	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
	<?php $_SESSION["User"]=""?>
	<table align="center">
		<tr>
			<td>
	<form action="login.php" style="width: 200px; padding: 5px;" method="POST" id="form_login" name="form_login" align="center">
		<?php require_once 'process.php'; ?>
		<div class="field">
			<div class="control" style="padding: 5px;">
				<?php $_SESSION["User"]=$User?>
				<input id="txtUser" class="form-control" type="text" name="User" placeholder="User" id="User" autofocus="" value="<?php echo $User; ?>">
			</div>
		</div>
		<div class="field">
			<div class="control" style="padding: 5px;">
				<input id="txtPassword" class="form-control" name="Password" id="Password" type="Password" placeholder="Password" value="<?php echo $Password; ?>">
			</div>
		</div>
		<div style="padding:5px;">
			<button type="submit" name="login" class="btn btn-primary">Login</button>
		</div>
	</form>
		</td>
		</tr>
	</table>
</body>
</html>