<?php
ini_set('display_errors', 1);
error_reporting(~0);
/**
 * Fichier de lancement du service Web
 * @author Jonathan Martel
 * @version 1.1
 * @update 2022-09-29
 * @license MIT
 * @see http://www.lornajane.net/posts/2012/building-a-restful-php-server-understanding-the-request
 * 
 */
//header('Content-Type: application/json; charset=utf8');
header('Access-Control-Allow-Origin: *');
		
header('Access-Control-Allow-Methods: OPTIONS, PUT, POST, GET, DELETE');
header('Access-Control-Allow-Credentials: true');

if($_SERVER['REQUEST_METHOD'] == 'OPTIONS')
{
    // Source: https://stackoverflow.com/a/43498290
    if (isset($_SERVER["HTTP_ACCESS_CONTROL_REQUEST_HEADERS"])){
        header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
    }
	return;
}

	/***************************************************/
    /** Fichier de configuration, contient l'autoloader **/
    /***************************************************/
	require_once("./config.php");
	
   	/***************************************************/
    /** Initialisation des variables **/
    /***************************************************/
   	//var_dump($_GET);
   
	$oReq = new Requete();

	
	/* Instanciation du controlleur */
	if($oReq->ressource == ""){
		http_response_code(400);
		exit();
	}
	
	$nomControlleur = ucfirst($oReq->ressource) . 'Controlleur';
	
	if (class_exists($nomControlleur)) {
		
		$reflectionClass = new ReflectionClass($nomControlleur);
		
		if($reflectionClass->isInstantiable()){
			$oControlleur = new $nomControlleur();
			$nomAction = strtolower($oReq->verbe) . 'Action';
			$resultat = $oControlleur->$nomAction($oReq);

			// La vue!
			echo json_encode($resultat);
		}
		else{
			http_response_code(400);
			exit();
		}	
		
	}
	else{
		http_response_code(400);
		exit();
	}	
	
	
	
	
	
	
	
	
	
	
	
	
			