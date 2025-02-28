<?php
include_once 'DBAbstract.php';

	// se crea la clase User que hereda de DBAbstract
	class Estacion extends DBAbstract{


		/*< constructor de la clase*/
		function __construct(){

		}

		/**
		 * 
		 * @brief retorna todas las estaciones metereologicas
		 * @params array $request por ahora no necesita parámetros
		 * @return array asociativo con los datos de las estaciones metereologicas
		 * 
		 * */
		function getAll(){

			/*< Recupera el método por el cual fue invocado*/
			$request_method = $_SERVER["REQUEST_METHOD"];

			/*< Es el método correcto en HTTP?*/
			if($request_method!="GET"){
				return ["errno" => 410, "error" => "Metodo invalido"];
			}

			/*< Solo un usuario logueado puede ver el listado */
			// if(!isset($_SESSION["morphyx"])){
			// 	return ["errno" => 411, "error" => "Para usar este método debe estar logueado"];
			// }

			/*< query de busqueda*/
			$ssql = "SELECT * FROM estaciones";

			/*< ejecuta la consulta a la base de datos*/
			$response = $this->query($ssql);
			return $response;
		}


		/**
		 * 
		 * @params retorna los datos de una estación metereologica especifica por chipip
		 * 
		 * 
		 * */
		function get($params){
			/*< recupera el método por el cual fue invocado*/
			$request_method = $_SERVER["REQUEST_METHOD"];

			/*< Es el método correcto en HTTP?*/
			if($request_method!="GET"){
				return ["errno" => 410, "error" => "Metodo invalido"];
			}

			/*< recupera el chipid de los parámetros*/
		  
			 $chipid= $_GET["chipId"];


			/*< consulta que recupera los datos de la estación metereologica especificada*/
			$ssql = "SELECT * FROM estaciones INNER JOIN tiempo ON tiempo.chipid = estaciones.chipid WHERE estaciones.chipid='$chipid' LIMIT 1";

			// ejecuta la consulta en la base de datos
			$response = $this->query($ssql);

			return $response;
		}


	}



 ?>