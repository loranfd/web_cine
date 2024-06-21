<?php

	include_once "config.php";


	function nueva_foto($id_usu, $comentario){	
	
		$mbd = new PDO('mysql:host='.SERVIDOR_BBDD.';dbname='.BBDD, USER_BBDD, PASSWORD_BBDD);
		$sql = "INSERT INTO fotos (id_usuario, comentario) VALUES (?,?)";
		$mbd->prepare($sql)->execute([$id_usu, $comentario]);
		return $mbd->lastInsertId();

    }
	
		function listado_comentarios_por_recurso($id_recurso){

		$mbd = new PDO('mysql:host='.SERVIDOR_BBDD.';dbname='.BBDD, USER_BBDD, PASSWORD_BBDD);
		$sql = "SELECT 
					fotos.comentario as el_comentario
				FROM fotos
				JOIN usuarios ON fotos.id_usuario = usuarios.id
				WHERE fotos.id_usuario = '$id_usu'";
		$comentarios = $mbd->query($sql);
		$array = $comentarios->fetchAll(PDO::FETCH_ASSOC);
		return $array;
		
	}
	
	
?>