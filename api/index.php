<?php

	/**
	* @file index.php
	* @brief API Restful para el proyecto MorphYX
	* @author Matias Leonardo Baez
	* @date 2024
	* @contact elmattprofe@gmail.com
	*/
	
	/*< inicia o continua la sesión*/
	// session_start();

	/*< La respuesta será un JSON*/
	header("Content-Type: application/json");
	include_once '../env.php';

	// captura el nombre del request method
	$request_method = $_SERVER["REQUEST_METHOD"];

	// captura los datos desde el vector de method correspondiente
	switch ($request_method) {
		case 'DELETE':
		case 'GET':
				$request = $_GET;
			break;

		case 'POST':
				$request = $_POST;
			break;

		case 'PUT':
				/*< las variables que se envian por método PUT viajan en el body */
				/*< se captura la petición y se pasan las variables al vector $_PUT */
				parse_str(file_get_contents('php://input'),$_PUT);
				$request = $_PUT;
			break;
	}
	
	/*< obtiene todo lo que esta delante de /api/ */
	$url = str_replace("/7100/","",$_SERVER["REDIRECT_URL"]);

	/*< averigua si al final de la url hay una barra y la quita */
	if(substr($url, -1) == "/"){
		$url = substr($url, 0, -1);
	}

	/*< separa los elementos que hay en la url */
	$url_detone = explode("/", $url);

	/*< en la primer posición está el nombre del modelo */
	$name_of_model = $url_detone[3];

	// Compatibiliza la peticion del modelo con el nombre de la clase
	$modelo = ucfirst(strtolower($name_of_model));

	/*< Si no existe el modelo entonces  */
	if(!file_exists('../models/'.$modelo.'.php')){
		echo json_encode(["load_errno" => 404 , "load_error" => "No existe el modelo"]);
		exit();	
	}

	// incluye el modelo
	include_once '../models/'.$modelo.'.php';

	/*< si no existe el segundo elemento entonces falta el método */
	if(!isset($url_detone[1])){
		echo json_encode(["load_errno" => 405 , "load_error" => "Falta especificar metodo"]);
		exit();	
	}

	/*< en la segunda posición está el método */
	$name_of_method = $url_detone[4];

	/*< instancia la clase solicitada en el modelo*/
	$object = new $modelo;

	/*< Si no existe el método dentro de la clase */
	if(!method_exists($object, $name_of_method)){
		echo json_encode(["load_errno" => 406 , "load_error" => "Metodo no existente dentro de la clase","modelo"=>$modelo,"name_of_method"=>$name_of_method]);
		exit();	
	}

	/*< almacena la respuesta del método dentro de la posición list */
	$response = ["load_errno" => 200 , "load_error" => "", "list" => $object->$name_of_method($request_method,$request)];

	/*< convierte la respuesta en un JSON */
	echo json_encode($response);