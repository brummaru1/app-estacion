<?php

	
	# index es un Router el cual redirecciona a las distintas secciones
	
	# el router tiene ahora autocarga de controladores
	include_once "env.php";
	include_once 'models/Estacion.php';

	// Carga del motor de plantillas
	include_once 'lib/kiwi/Kiwi.php';

	// por defecto seccion es landing
	 $seccion = "listado";

	// si existe slug entonces la sección es su contenido
	if(isset($_GET['slug']))
		$seccion = $_GET['slug'];

	// verificamos que exista el controlador
	if(!file_exists('controllers/'.$seccion.'Controller.php')){
		// si no existe el controlador lo llevamos al controlador de error 404
		// $seccion = "error404";
		echo "no existe";
	}

	// Carga del controlador
	include_once 'controllers/'.$seccion.'Controller.php';









	// // incluimos a User para poder hacer uso de la variable cargada en session
	// //include_once 'models/User.php';
	
	// // Inicia la sesión
	// //session_start();

	// // motor de plantillas
	// include 'lib/kiwi/Kiwi.php';  
	// include_once 'env.php'
	// // para pasar variables a las plantillas
	// //$vars = [];

	// // por defecto se va a landing
	// $controlador = "landing";

	// // si pidieron una seccion lo llevamos a ella
	// if(strlen($_GET['slug'])!=0){
	// 	$controlador = $_GET['slug'];	
	// }

	// // averiguamos si existe el controlador
	// if(!is_file('controllers/'.$controlador.'Controller.php')){
	// 	$controlador = "error404";
	// }

	// //=== firewall

	// // Listas de acceso dependiendo del estado del usuario
	// //$controlador_login = ["panel", "logout", "perfil", "abandonar"];
	// //$controlador_anonimo = ["landing", "login", "register"];

	// // recorre la lista de secciones no permitidas
	// 	foreach ($controlador_anonimo as $key => $value) {
	// 		// si esta solicitando una sección no permitida
	// 		if($controlador==$value){
	// 			$controlador = "landing";
	// 			break;
	// 		}
	// 	}


	// // sesion iniciada
	// if(isset($_SESSION['morphyx'])){

	// 	// recorre la lista de secciones no permitidas
	// 	foreach ($controlador_anonimo as $key => $value) {
	// 		// si esta solicitando una sección no permitida
	// 		if($controlador==$value){
	// 			$controlador = "panel";
	// 			break;
	// 		}
	// 	}

	// }else{ // sesión no iniciada

	// 		// recorre la lista de secciones no permitidas
	// 		foreach ($controlador_login as $key => $value) {
	// 		// si esta solicitando una sección no permitida
	// 		if($controlador==$value){
	// 			$controlador = "landing";
	// 			break;
	// 		}
	// 	}

	// }

	// // === fin firewall


	// include 'controllers/'.$controlador.'Controller.php';

 ?>