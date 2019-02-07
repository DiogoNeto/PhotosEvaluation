<?php 
include('connection.php');
if(empty($_POST['user']) || empty($_POST['password'])){
	header('Location: login.php');
}

$user = mysqli_real_escape_string($connection, $_POST['User']);
$password = mysqli_real_escape_string($connection, $_POST['Password']);

$query = 'SELECT user, password FROM `login` WHERE user='$user' and password=md5('$password')';

$result	= mysqli_query($connection, $query);

$row = mysqli_num_rows($result);

if($row==1){
	$_SESSION['user']=$user;
	header('Location: index.php');
	exit();
}
else{
	header('Location: login.php');
	exit();
}
