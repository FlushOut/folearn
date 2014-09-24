<?php 
$vee = true;
require_once("../config.php");

$emailold = $_GET['emailold'];
$emailnew = $_GET['emailnew'];

$user = new user();
$qtd = $user->verifExistsEmailUp($emailold,$emailnew);

if($qtd > 0){
	$valid = false;
}else{
	$valid = true;	
}
echo json_encode($valid);
	