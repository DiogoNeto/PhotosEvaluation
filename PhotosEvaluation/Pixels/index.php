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

	$(document).ready(function(){
  		$("#btnHelp").click(function(){
    		$("#div1").fadeToggle(1000);
  		});
  	});

  	$(document).ready(function(){
  		$("#btnStart").click(function(){
    		$("#div3").fadeToggle(1000);
  		});
  	});

</script>
</head>
<body>
	<?php echo " User: "; echo $_SESSION['User']; echo " Session: "; echo $_SESSION['Sessao']; ?>
	<h3 align="center">Pouca densidade de pixels?</h3>
<div id="container">

	<!--Ajuda-->
	<div id="div1" style="display:none; background-color: #F0F0F0;" width="100%" height="100%">
		<table class="table" width="100%" height="500px;">
			<tr>
				<td align="center" width="50%"><div align="right" ><img style="border:5px solid #ff0000; height: 500px;" src="../images/img_34.jpg"></div></td>
				<td align="center" width="50%"><div align="left"><img style="border:5px solid #00ff00; height: 500px;" src="../images/closed_eye_0012.jpg_face_1.jpg"></div></td>
			</tr>
		</table>
		<table align="center" width="100%">
			<tr>
				<td><p align="center">Nestas imagens deverá avaliar se a imagem se encontra com pouca densidade de pixels.</p></td>
			</tr>
		</table>
	</div>
	
	<!--Interação-->
	<div id="div2" align="center">

		<form action="index.php" method="POST" id="form1" name="form1" style="visibility: visible;">
			<?php require_once '../ClosedEyes/process.php'; ?>
			<!--<div id="div3" style="display: block; position: absolute; left:43%; top:30px; width:150px; height:100px; background-color:#FFFFFF; z-index: 10;">
				<button class="btn btn-primary" id="btnStart" type="submit" name="not" onclick="function start();">Iniciar</button>
			</div>-->
			<table>
				<tr>
					<td><input type="text" style="visibility:hidden; max-height: 500px;" name="i" id="i" value="<?php echo $i; ?>"></td>
				</tr>
			</table>
				<table id="tbl1" width="100px" style="visibility:visible;">
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

