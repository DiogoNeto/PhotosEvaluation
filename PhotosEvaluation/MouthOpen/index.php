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
	<?php echo " User: "; echo $_SESSION['User']; echo " Session: "; echo $_SESSION['Sessao']; ?>
	<h3 align="center">Boca aberta?</h3>
<div id="container">

	<!--Ajuda-->
	<div id="div1" style="display:none;" width="100%" height="100%">
		<table class="table" style="background-color: #F0F0F0;" width="100%" height="500px;">
			<tr>
				<td align="center" width="50%"><div align="right" ><img style="border:5px solid #ff0000; max-height: 500px;" src="../ClosedEyes/images/img_34.jpg" width="200px"></div></td>
				<td align="center" width="50%"><div align="left"><img style="border:5px solid #00ff00; max-height: 500px;" src="../ClosedEyes/images/img_70.jpg" width="200px"></div></td>
			<tr>
		</table>
		<table align="center" width="100%">
			<tr>
				<td><p align="center">Nestas imagens deverá avaliar se a boca se encontra aberta ou fechada.</p></td>
			</tr>
		</table>
	</div>
	
	<!--Interação-->
	<div id="div2" align="center">
	<!--<table>
		<tr>
			<td><div id="divIniciar"><button id="btnIniciar"  class="btn btn-primary" type="submit" name="start" style="visibility: visible;">Iniciar</button></div></td>
		</tr>
	</table>-->
		<form action="index.php" method="POST" id="form1" name="form1" style="visibility: visible;">
			<?php require_once '../ClosedEyes/process.php'; ?>
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


<!--
!moldura a volta da imagem
!juntar as imagens no ecrã inicial
!acrescentar sessão na db
tamanho de sessões variavel
!limitar por tempo
ajuda com fadein/fadeout
colocar no git
limitar 3 avaliações por foto

verificar cedencia de dados (falar com alunos)
escolher fotos aliatórias (aritmetica modular)

user: diogo
pass: pipoca

estado da arte das api's em deep learning
redes neuronais nas api requesitos boas praticas estrategia integração api's disponibilisadas git hub como está estruturado
redes neuronais ja treinadas engenharia de software
google face api rede pre treinada para treinamento de faces (exemplo de api) microsoft deve ter uma parecida
apiś online
apis pre treinadas
pricing calculator
face detection
face api documentation
ler bem os abstracts
avaliar o iso do

outline tese

user do github: jpaos

usuario  GitHub mauriciobreternitz email mbreternitz@gmail.com

zamb.iul.lab

vpn.iscte-iul.pt
google face api
exemplo de api

Microsoft tambem tem algo parecido
Face API - Facial Recognition Software | Microsoft Azure
https://azure.microsoft.com

um exemplo
https://docs.aws.amazon.com/rekognition/latest/dg/faces.html

https://azure.microsoft.com/en-us/services/cognitive-services/face/ -->