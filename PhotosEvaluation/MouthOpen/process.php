<?php 

// Start the session
session_start();

$mysqli = new mysqli('localhost','root','3492017652!','fotos') or die(mysqli_error($mysqli));

$count = 0;

if(isset($_POST['next'])){
	if($_SESSION["User"]==""){
	header("Location: ../MouthOpen/login.php");
}
	$i =$_POST['i'];
		
		//$mysqli->query("UPDATE imagens SET Interactions = Interactions + 1 WHERE id='$i'") or die($mysqli->error());

	$i++;

	$j=$i-1;

	$dir ="images/";

		$fileList = glob('images/*');

		//array scandir ( string $dir [, int $sorting_order = SCANDIR_SORT_ASCENDING [, resource $context ]] )

		if($opendir = opendir($dir)){
			if(($file=readdir($opendir))!==false)
			{ 
				if($dir+$file=="$fileList[$j]"){

					$s = "SELECT count(*) FROM `imagem` WHERE criterio='crit1' and foto='$fileList[$j]' and user='$fileList[$j]";

					

					//echo $fileList[$j];

					echo "<img src='$fileList[$j]'>";

					//insere novo registo na tabela imagem
					$mysqli->query("INSERT INTO imagem (user,score,foto,data,criterio) VALUES ('user1',1,'$fileList[$j]',now(),'crit1')") or die($mysqli->error());
				}
			}
		}
	if($fileList[$j]==""){//
		$_SESSION['User']="";
		header("Location: ../MouthOpen/login.php");
	}
}


if(isset($_POST['not'])){

	if($_SESSION["User"]==""){
		header("Location: ../MouthOpen/login.php");
	}

	$i =$_POST['i'];
		
		$mysqli->query("UPDATE imagens SET Interactions = Interactions + 1 WHERE id='$i'") or die($mysqli->error());

	$i++;

	$j=$i-1;

	$dir ="images/";

		$fileList = glob('images/*');
		//array scandir ( string $dir [, int $sorting_order = SCANDIR_SORT_ASCENDING [, resource $context ]] )

		if($opendir = opendir($dir)){
			if(($file=readdir($opendir))!==false)
			{ 
				if($dir+$file=="$fileList[$j]"){
					echo "<img src='$fileList[$j]'>";


					//insere novo registo na tabela imagem
					$mysqli->query("INSERT INTO imagem (user,score,foto,data,criterio) VALUES ('user1',0,'$fileList[$j]',now(),'crit1')") or die($mysqli->error());
				}
			}
		}
	if($fileList[$j]==""){
		header("Location: ../MouthOpen/login.php");
	}
}


if(isset($_POST['start'])){
	$i =$_POST['i'];
		//$mysqli->query("UPDATE imagens SET Interactions = Interactions + 1 WHERE id='$i'") or die($mysqli->error());
	
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
		header("Location: ../MouthOpen/index.html");
	}
}

if(isset($_POST['login'])){
	$User=$_POST['User'];
	$Password=$_POST['Password'];

	// Set session variables
	$_SESSION["User"] = $_POST['User'];
	$_SESSION["Password"] = $_POST['Password'];
	
	$result=0;

	$sql = "SELECT id FROM login WHERE user='$User' and password='$Password'";


	if($res = $mysqli->query($sql)){
			$data = mysqli_query($mysqli, $sql);
			$row = mysqli_fetch_assoc($data);
			$idd = $row['id'];
		}

	//$_SESSION['result'] = $result;

	if($idd == 1){
		//$_SESSION['result'] = $result;
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