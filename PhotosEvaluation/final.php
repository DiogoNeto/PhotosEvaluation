<?php
// Start the session
session_start();
?>
<!Doctype html>
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
	<?php echo " User: "; echo $_SESSION['User']; echo " Session: "; echo $_SESSION['Sessao']; 
		$User = $_SESSION['User'];
		$Password = $_SESSION['Password'];
	?>
	<div class="container">
		<div class="" align="center">
			<h3 align="center">Fim da avaliação</h3>
			<h5>Obrigado</h5>
		</div>
		<div align="center">
		<form action="login.php" style="width: 200px; padding: 5px;" method="POST" id="form_restart" name="form_restart" align="center">
			<?php require_once 'process.php'; ?>
			<table>
				<tr>
				<td style="padding: 5px;"><button class="btn btn-danger" href="login.php">Terminar</button></td>
				<td style="padding: 5px;"><button class="btn btn-primary" type="submit" name="restart"  href="index.php">Nova Avaliação</button></td></tr>
			</table>
			<div align="center" align="center" style="padding-top: 20px;">
				
			</div>

		<div class="field" style="display: none;">
			<div class="control" style="padding: 5px;">
				<!--<?php $_SESSION["User"]=$User?>-->
				<input id="txtUser" class="form-control" type="text" name="User" placeholder="User" id="User" autofocus="" value="<?php echo $User; ?>">
			</div>
		</div>
		<div class="field" style="display: none;">
			<div class="control" style="padding: 5px;">
				<input id="txtPassword" text="user1" class="form-control" name="Password" id="Password" type="Password" placeholder="Password" value="<?php echo $Password; ?>">
			</div>
		</div>
		</form>
		</div>
	</div>
</body>
</html>