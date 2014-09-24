<?php 
$vee = true;
require_once("../config.php");

$email = $_GET['email'];

$user = new user();
$qtd = $user->verifExistsEmail($email);

if($qtd > 0){
	$valid = false;
}else{
	$valid = true;	
}
echo json_encode($valid);
	