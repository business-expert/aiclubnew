<?php
session_start();
error_reporting(1);
ini_set('error_reporting', E_ALL^E_NOTICE^E_WARNING);

include_once($_SERVER['DOCUMENT_ROOT'].'/aiclub/config/config.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/aiclub/config/database.php');

$objLog		=	new logs(LOG_FILE_NAME);
$QErrLog	=	new logs(SQL_ERROR_FILE_NAME);

$DB 		=	new database(HOST, USER, PASS, DATABASE);
$ln 		=	$DB->dbConnect();

$objComm    = 	new common();
$objHTML    = 	new html();
 
function __autoload($classname)
{
	if(file_exists(MODELS. "/".$classname."/". $classname . 'model.php')){
		include_once MODELS. "/".$classname."/". $classname . 'model.php';
	}
	else
	{
		if(file_exists(LIBS. "/". $classname . '.php')){
			include_once LIBS. "/". $classname . '.php';
		}
		else{
			echo "Class Name '".$classname .".php' not Found";
		}
	}
}

include_once($_SERVER['DOCUMENT_ROOT'].'/aiclub/language.php');
?>