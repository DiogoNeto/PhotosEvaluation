<?php 

// Start the session
session_start();

$mysqli = new mysqli('localhost','root','3492017652!','fotos') or die(mysqli_error($mysqli));

if(isset($_POST['next'])){
	$user = $_SESSION["User"];
	$sessao = $_SESSION["Sessao"];
	$criterio = $_SESSION["Criterio"];
	
	$a = new DateTime(gmdate("h:i:s"));
	$diff = $a->getTimestamp() - $_SESSION['StartTime']->getTimestamp();
	
	//tempo maximo para responder
	$maxTime=30;

	//flag para ver se a foto ainda nao fez a três avaliações
	$fotoOK=false;
	
	$i =$_POST['i'];
	if($_SESSION["User"]=="" || $diff>$maxTime){
		header("Location: ../ClosedEyes/final.php");
	}
	
		
	$i++;
	$n=$i*$criterio;
	$j=$n-1;
	

	$dir ="../images/";

		$fileList = glob('../images/*');
		
		if($opendir = opendir($dir)){
			if(($file=readdir($opendir))!==false)
			{ 
				if($dir+$file=="$fileList[$j]"){
					while($fotoOK==false){
					$sql = "SELECT count(id) as 'total' FROM `imagem` WHERE criterio='$criterio' and foto='$fileList[$j]' and user='$user'";


					$result = mysqli_query($mysqli, $sql);
					$values = mysqli_fetch_assoc($result);
					$num_rows=$values['total'];
					
					if($num_rows<3){
						echo "<img src='$fileList[$j]' style='height:500px;'>";

						$fotoOK=true;
					}
					else{
						$j=$j+2;
					}
					
					//insere novo registo na tabela imagem se ja tiver imagem
					if($_SESSION[img]!=""){

						$img=$_SESSION[img];
						if($i>1){
						$mysqli->query("INSERT INTO imagem (user,score,foto,data,criterio,session) VALUES ('$user',1,'$img',now(),'$criterio','$sessao')") or die($mysqli->error());
					}
						}
						$_SESSION[img]=$fileList[$j];
					}
				}
			}
		}
	if($fileList[$j]==""){
		$_SESSION['User']="";
		header("Location: ../ClosedEyes/login.php");
	}
}


if(isset($_POST['not'])){

	$user = $_SESSION["User"];
	$sessao = $_SESSION["Sessao"];
	$criterio = $_SESSION["Criterio"];

	$a = new DateTime(gmdate("h:i:s"));
	$diff = $a->getTimestamp() - $_SESSION['StartTime']->getTimestamp();
	
	//tempo maximo para responder
	$maxTime=30;

	$i =$_POST['i'];

	if($_SESSION["User"]=="" || $diff>$maxTime ){
		header("Location: ../ClosedEyes/final.php");
	}


	$i++;
	$n=$i*$criterio;
	$j=$n-1;

	$dir ="../images/";

		$fileList = glob('../images/*');
		//array scandir ( string $dir [, int $sorting_order = SCANDIR_SORT_ASCENDING [, resource $context ]] )

		if($opendir = opendir($dir)){
			if(($file=readdir($opendir))!==false)
			{ 
				if($dir+$file=="$fileList[$j]"){
					while($fotoOK==false){
					$sql = "SELECT count(id) as 'total' FROM `imagem` WHERE criterio='$criterio' and foto='$fileList[$j]' and user='$user'";

					$result = mysqli_query($mysqli, $sql);
					$values = mysqli_fetch_assoc($result);
					$num_rows=$values['total'];
					
					if($num_rows<3){
						$_SESSION["Img"]="$fileList[$j]";
						echo "<img src='$fileList[$j]' style='height:500px;'>";
						$fotoOK=true;
					}
					else{
						$j=$j+2;
					}


					//insere novo registo na tabela imagem
					if($i>1){
					$mysqli->query("INSERT INTO imagem (user,score,foto,data,criterio,session) VALUES ('$user',0,'$fileList[$j]',now(),'$criterio','$sessao')") or die($mysqli->error());
				}
				}
			}
			}
		}
	if($fileList[$j]==""){
		header("Location: ../ClosedEyes/login.php");
	}
}




//login
if(isset($_POST['login'])){
	$User=$_POST['User'];
	$Password=$_POST['Password'];

	// Set session variables
	$_SESSION["User"] = $_POST['User'];
	$_SESSION["Password"] = $_POST['Password'];
	$_SESSION['StartTime']=new DateTime(gmdate("h:i:s"));
	$_SESSION["Sessao"] = rand(1,10);	
	$_SESSION["Criterio"] = rand(1,3);
	$_SESSION["Img"] = "";
	

	//tempo maximo para responder
	$maxTime=30;

	//flag para ver se a foto ainda nao fez a três avaliações
	$fotoOK=false;

	//echo "Session variables are set.";

	$result=0;

	$sql = "SELECT id, HoraInicial, HoraFinal FROM login WHERE user='$User' and password='$Password'";

	if($res = $mysqli->query($sql)){
			$data = mysqli_query($mysqli, $sql);
			$row = mysqli_fetch_assoc($data);
			$idd = $row['id'];
			$hInicial = $row['HoraInicial'];
			$hFinal = $row['HoraFinal'];			
		}

	
	if($hInicial <= gmdate("H:i:s") && $hFinal >= gmdate("H:i:s")){
		if($_SESSION["Criterio"] == 1)
			header("Location: ../ClosedEyes/index.php");
		if($_SESSION["Criterio"] ==2)
			header("Location: ../TooDarkOrTooLight/index.php");
		if($_SESSION["Criterio"] ==3)
			header("Location: ../Pixels/index.php");
		if($_SESSION["Criterio"] == 4)
			header("Location: ../HairAcrossEyes/index.php");
		if($_SESSION["Criterio"] == 5)
			header("Location: ../ShadowsAcrossFace/index.php");

		}
		else{
			echo "Utilizador ou palavra passe errada.";
		}
	}

//nova avaliação
if(isset($_POST['restart'])){
	$User=$_POST['User'];
	$Password=$_POST['Password'];

	$_SESSION['StartTime']=new DateTime(gmdate("H:i:s"));
	$_SESSION["Sessao"] = rand(1,10);	
	$_SESSION["Criterio"] = rand(1,3);
	$_SESSION["Img"] = "";
	


	echo "Session variables are set.";

	$result=0;

	$sql = "SELECT id FROM login WHERE user='$User' and password='$Password'";

	if($res = $mysqli->query($sql)){
			$data = mysqli_query($mysqli, $sql);
			$row = mysqli_fetch_assoc($data);
			$idd = $row['id'];
		}

	
	if($idd == 1){
		if($_SESSION["Criterio"] == 1)
			header("Location: ../ClosedEyes/index.php");
		if($_SESSION["Criterio"] == 2)
			header("Location: ../TooDarkOrTooLight/index.php");
		if($_SESSION["Criterio"] == 3)
			header("Location: ../Pixels/index.php");
		if($_SESSION["Criterio"] == 4)
			header("Location: ../HairAcrossEyes/index.php");
		if($_SESSION["Criterio"] == 5)
			header("Location: ../ShadowsAcrossFace/index.php");
		
	}
	else{
		echo "Utilizador ou palavra passe errada.";
	}

}

