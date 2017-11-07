<?php
/**
 * @author juan pablo muñoz leiva
 * @copyright 2017
 */
$bd_ip	="CMP0047"; 
		//direccion ip del servidor de bd o el nombre que se le dio al conjunto sql
//$bd_ip	="Dark_Notebook\local";
//$bd_ip	="Dark_Tarro";
$bd_login="sa";								//usuario de la base de datos
$bd_password="somela2005";					//password de la base de datos
//$bd_nombre="matriz_riesgo3";
//$bd_nombre="matriz_r_blanco";	
//$bd_nombre="matriz_elbosque";					//nombre que tiene la base de datos en el motor de base de datos
$servidor_sistema= "http://localhost";	//nombre del servidor en donde se encuentra instalado el sistema
error_reporting(E_ALL & ~E_NOTICE);
ini_set('display_errors', 'on');
ini_set('max_execution_time','420');  
ini_set('memory_limit','100M');

$con = mssql_connect ($bd_ip, $bd_login, $bd_password) or die("No pudo conectarse, Verifique conexion");
mssql_select_db ("master", $con) or die("No pudo seleccionarse la BD SQL-SERVER.". mssql_get_last_message());

?>
