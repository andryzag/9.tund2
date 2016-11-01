<?php
	require("../../config.php");
	
	
	
	
	// ühendus
	$database = "if16_andryzag";
	$mysqli = new mysqli($serverHost, $serverUsername, $serverPassword, $database);
	
	require("User.class.php");
	$User = new User($mysqli);
	
	require("Interest.class.php");
	$Interest = new Interest($mysqli);
	
	require("Get.class.php");
	$Get = new Get($mysqli);
	
	// functions.php
	//var_dump($GLOBALS);
	
	// see fail, peab olema kõigil lehtedel kus 
	// tahan kasutada SESSION muutujat
	session_start();
	
	function cleanInput($input){
		
		$input = trim($input);
		$input = stripslashes($input);
		$input = htmlspecialchars($input);
		
		return $input;
		
	}

?>