<?php 

	session_start();
	if(!isset($_SESSION["perfil"])){header('Location: salir.php');}

	
	include "modelos/bbdd/fotos.php"; 
	include "modelos/bbdd/perfil.php";
	
	$un_array = listado_fotos($_SESSION["id"]);	
	
	include "vistas/biblioteca_fotos.htm"; 

?>

