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
<style>
  #container {
  width: 100%;
  height: 100%;
  position: relative;
}
#div1,
#div2 {
  width: 100%;
  height: 100%;
  position: absolute;
  top: 0;
  left: 0;
}
#div1 {
  z-index: 10;
}
#btnHelp {
	position:absolute;
	bottom:5px;
	right: 5px;
}
</style>
<script type="text/javascript">

	function info(){
		alert("Descrição dos critérios de avaliação da imagem.");
	}
	
	$(document).ready(function(){
  		$("button").click(function(){
    		$("#div1").fadeToggle(1000);
  		});
  	});
</script>
</head>
<body>
	<?php echo ' User: '; echo $_SESSION['User'];

		echo ' Session: '; echo $_SESSION["Sessao"];

		?>
	<h3 align="center">Olhos fechados?</h3>
	<div id="container">

	<!--Ajuda-->
	<div id="div1" style="display:none;" width="100%" height="100%">
		<table class="table" style="background-color: #F0F0F0;" width="100%" height="500px;">
			<tr>
				<td align="center" width="50%"><div align="right" ><img style="border:5px solid #ff0000; max-height: 500px;" src="../ClosedEyes/images/img_34.jpg" width="200px"></div></td>
				<td align="center" width="50%"><div align="left"><img style="border:5px solid #00ff00; max-height: 500px;" src="../ClosedEyes/images/closed_eye_0015.jpg_face_1.jpg" width="200px"></div></td>
			<tr>
		</table>
		<table align="center" width="100%">
			<tr>
				<td><p align="center">Nestas imagens deverá avaliar se os olhos se encontram aberos ou fechdos.</p></td>
			</tr>
		</table>
	</div>

	<div align="center">
		<form action="index.php" method="POST" id="form1" name="form1" style="visibility: visible;">
			<?php require_once 'process.php'; ?>
			<table>
				<tr>
					<td><input type="text" style="visibility: hidden;" name="i" id="i" value="<?php echo $i; ?>"></td>
				</tr>
			</table>
				<table width="100px">
				<tr>
					<td style="padding: 5px">
						<button id="btnNao" class="btn btn-danger" type="submit" name="not">Não</button>
					</td>
					<td style="padding: 5px">
						<button id="btnSim" class="btn btn-success" type="submit" name="next">Sim</button>
					</td>
				</tr>
			</table>
		</form>
	</div>	
	</div>
	<!--Botão de Ajuda-->
	<button id="btnHelp" class="btn btn-primary">Ajuda</button><br><br>
</body>
</html>