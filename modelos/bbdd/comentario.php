<?php


	include_once "config.php";


	function nuevo_comentario($id_usu, $id_ficha, $comentario){	
	
		$mbd = new PDO('mysql:host='.SERVIDOR_BBDD.';dbname='.BBDD, USER_BBDD, PASSWORD_BBDD);
		$sql = "INSERT INTO comentarios (id_usuario, id_recurso, comentario) VALUES (?,?,?)";
		$mbd->prepare($sql)->execute([$id_usu, $id_ficha, $comentario]);
		
    }


	function listado_comentarios_por_recurso($id_recurso){

		$mbd = new PDO('mysql:host='.SERVIDOR_BBDD.';dbname='.BBDD, USER_BBDD, PASSWORD_BBDD);
		$sql = "SELECT 
					usuarios.nombre as el_nombre, 
					usuarios.apellidos as los_apellidos, 
					comentarios.timestamp as fechayhora, 
					comentarios.comentario as el_comentario
				FROM comentarios 
				JOIN usuarios ON comentarios.id_usuario = usuarios.id
				WHERE comentarios.id_recurso = '$id_recurso'";
		$comentarios = $mbd->query($sql);
		$array = $comentarios->fetchAll(PDO::FETCH_ASSOC);
		return $array;
		
	}
	
	
	function ranking_comentarios_por_usuario(){

		$mbd = new PDO('mysql:host='.SERVIDOR_BBDD.';dbname='.BBDD, USER_BBDD, PASSWORD_BBDD);	
		$sql = "SELECT 
					usuarios.nombre as el_nombre, 
					usuarios.apellidos as los_apellidos, 
					count(comentarios.id) as cuenta
				FROM comentarios 
				JOIN usuarios ON comentarios.id_usuario = usuarios.id
				GROUP BY id_usuario
				ORDER BY cuenta DESC";
		$comentarios = $mbd->query($sql);
		$array = $comentarios->fetchAll(PDO::FETCH_ASSOC);
		return $array;
		
	}
	
	
	function ranking_comentarios_por_recurso(){

		$mbd = new PDO('mysql:host='.SERVIDOR_BBDD.';dbname='.BBDD, USER_BBDD, PASSWORD_BBDD);
		$sql = "SELECT 
					id_recurso as recurso, 
					count(id) as cuenta
				FROM comentarios 
				GROUP BY id_recurso
				ORDER BY cuenta DESC";
		$comentarios = $mbd->query($sql);
		$array = $comentarios->fetchAll(PDO::FETCH_ASSOC);
		return $array;
		
	}
	
	
?>