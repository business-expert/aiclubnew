<?php
session_start();
error_reporting(1);
ini_set('error_reporting', E_ALL^E_NOTICE^E_WARNING);

include_once($_SERVER['DOCUMENT_ROOT'].'/aiclub/config/config.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/aiclub/config/database.php');

#print_r($_SESSION);

#------------- LANGUAGE  CODE ------------
if(isset($_REQUEST['lang']))
{
	#echo "<hr>"; print_r($_REQUEST);
	$langs = $_REQUEST['lang'];
	$_SESSION['ai_session_lang'] = $langs;
	setcookie('ai_session_lang', $langs, time() + (3600 * 24 * 30));
}
else if(isSet($_SESSION['ai_session_lang']))
{
	$langs = $_SESSION['ai_session_lang'];
}
else if(isSet($_COOKIE['ai_session_lang']))
{
	$langs = $_COOKIE['ai_session_lang'];
}
else
{
	$langs = 'english';
}

include_once($_SERVER['DOCUMENT_ROOT'].'/aiclub/language/'.$langs.'/index.php');

#echo "<hr>"; print_r($_SESSION);
#------------- LANGUAGE  CODE ------------#

$objLog		=	new logs(LOG_FILE_NAME);
$QErrLog	=	new logs(SQL_ERROR_FILE_NAME);

$DB 		=	new database(HOST, USER, PASS, DATABASE);
$ln 		=	$DB->dbConnect();

$objComm    = 	new common();
$objHTML    = 	new html();

/*function __autoload($classname)
{
	if(file_exists(MODELS_ADMIN. "/".$classname."/". $classname . 'model.php')){
		
		include_once MODELS_ADMIN. "/".$classname."/". $classname . 'model.php';
	}
	else
	{
		if(file_exists(LIBS. "/". $classname . '.php')){
			include_once LIBS. "/". $classname . '.php';
		}
		else if(file_exists(LIBS_ADMIN. "/". $classname . '.php')){
			include_once LIBS_ADMIN. "/". $classname . '.php';
		}
		else{
			echo "Class Name '".$classname .".php' not Found";
		}
	}
}*/

function __autoload($classname)
{
	if(file_exists(MODELS_ADMIN. "/". $classname . '_model.php')){
		include_once MODELS_ADMIN. "/". $classname . '_model.php';
	}
	else
	{
		if(file_exists(LIBS. "/". $classname . '.php')){
			include_once LIBS. "/". $classname . '.php';
		}
		else if(file_exists(LIBS_ADMIN. "/". $classname . '.php')){
			include_once LIBS_ADMIN. "/". $classname . '.php';
		}
		else{
			echo "Class Name '".$classname .".php' not Found";
		}
	}
}



?>