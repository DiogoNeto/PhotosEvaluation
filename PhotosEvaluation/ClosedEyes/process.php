<?php 

// Start the session
session_start();

$mysqli = new mysqli('localhost','root','3492017652!','fotos') or die(mysqli_error($mysqli));

if(isset($_POST['next'])){
	$user = $_SESSION["User"];
	$sessao = $_SESSION["Sessao"];
	$criterio = $_SESSION["Criterio"];

	$a = new DateTime(date("h:i:s"));
	$diff = $a->getTimestamp() - $_SESSION['StartTime']->getTimestamp();
	
	//tempo maximo para responder
	$maxTime=15;
	//numero máximo de fotos para avaliar
	$maxPhotos=5;

	//flag para ver se a foto ainda nao fez a três avaliações
	$fotoOK=false;
	
	$i =$_POST['i'];
	if($_SESSION["User"]=="" || $diff>$maxTime || $i>$maxPhotos){
		header("Location: ../ClosedEyes/login.php");
	}
	
		
	$i++;
	$n=$i*$criterio;
	$j=$n-1;
	

	$dir ="images/";

		$fileList = glob('images/*');
		
		if($opendir = opendir($dir)){
			if(($file=readdir($opendir))!==false)
			{ 
				if($dir+$file=="$fileList[$j]"){
					while($fotoOK==false){
					$sql = "SELECT count(id) as 'total' FROM `imagem` WHERE criterio='$sessao' and foto='$fileList[$j]' and user='$user'";


					$result = mysqli_query($mysqli, $sql);
					$values = mysqli_fetch_assoc($result);
					$num_rows=$values['total'];
					
					if($num_rows<3){
						echo "<img src='$fileList[$j]' style='max-height:500px; max-width:500px'>";

						$fotoOK=true;
					}
					else{
						$j++;
					}
					
					//insere novo registo na tabela imagem se ja tiver imagem
					if($_SESSION[img]!=""){
						$img=$_SESSION[img];
						$mysqli->query("INSERT INTO imagem (user,score,foto,data,criterio,session) VALUES ('$user',1,'$img',now(),'$criterio','$sessao')") or die($mysqli->error());
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

	$a = new DateTime(date("h:i:s"));
	$diff = $a->getTimestamp() - $_SESSION['StartTime']->getTimestamp();
	
	//tempo maximo para responder
	$maxTime=15;
	//numero máximo de fotos para avaliar
	$maxPhotos=5;

	$i =$_POST['i'];

	if($_SESSION["User"]=="" || $diff>$maxTime || $i>$maxPhotos){
		header("Location: ../ClosedEyes/login.php");
	}

		$mysqli->query("UPDATE imagens SET Interactions = Interactions + 1 WHERE id='$i'") or die($mysqli->error());

	$i++;
	$n=$i*$criterio;
	$j=$n-1;

	$dir ="images/";

		$fileList = glob('images/*');
		//array scandir ( string $dir [, int $sorting_order = SCANDIR_SORT_ASCENDING [, resource $context ]] )

		if($opendir = opendir($dir)){
			if(($file=readdir($opendir))!==false)
			{ 
				if($dir+$file=="$fileList[$j]"){
					while($fotoOK==false){
					$sql = "SELECT count(id) as 'total' FROM `imagem` WHERE criterio='$sessao' and foto='$fileList[$j]' and user='$user'";

					$result = mysqli_query($mysqli, $sql);
					$values = mysqli_fetch_assoc($result);
					$num_rows=$values['total'];
					
					if($num_rows<3){
						$_SESSION["Img"]="$fileList[$j]";
						echo "<img src='$fileList[$j]' style='max-height:500px; max-width:500px'>";
						$fotoOK=true;
					}
					else{
						$j++;
					}

					//insere novo registo na tabela imagem
					$mysqli->query("INSERT INTO imagem (user,score,foto,data,criterio,session) VALUES ('$user',0,'$fileList[$j]',now(),'$criterio','$sessao')") or die($mysqli->error());
				}
			}
			}
		}
	if($fileList[$j]==""){
		header("Location: ../ClosedEyes/login.php");
	}
}


if(isset($_POST['start'])){
	$i =$_POST['i'];

	$i++;
	$dir ="images/";


	$sql = "SELECT Path FROM imagens where id=$i";

		if($res = $mysqli->query($sql)){
			$data = mysqli_query($mysqli, $sql);
			$row = mysqli_fetch_assoc($data);
			$path = $row['Path'];
		}


		if ($opendir = opendir($dir)){
			if(($file=readdir($opendir))!==false)
			{ 
				if($dir+$file=="$path"){
					echo "<img src='$path'>";
				}
			}
		}

	if($path==""){
		header("Location: ../ClosedEyes/index.html");
	}
}

if(isset($_POST['login'])){
	$User=$_POST['User'];
	$Password=$_POST['Password'];

	// Set session variables
	$_SESSION["User"] = $_POST['User'];
	$_SESSION["Password"] = $_POST['Password'];
	$_SESSION['StartTime']=new DateTime(date("h:i:s"));
	$_SESSION["Sessao"] = rand(1,2);	
	$_SESSION["Criterio"] = rand(1,10);
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
		//$_SESSION['result'] = $result;
		if($_SESSION["Sessao"] == 1)
			header("Location: ../ClosedEyes/index.html");
		if($_SESSION["Sessao"] ==2)
			header("Location: ../MouthOpen/index.html");
	}
	else{
		echo "Utilizador ou palavra passe errada.";
	}
}


//Login
//Instruções
//Tirar botão de proxima imagem
//DB
//id user foto criterio score data
//ver o data sets que o jose menciona na tese e outros data sets como faces in the wild
//ver as caracteristicas que estao contempladas no iso e comparar com as que estao na tese do jose
//verificar intrução em html para as imagens n ficarem em cache