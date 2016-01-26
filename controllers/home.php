<?php

$model  = $_REQUEST['model'];
$action = $_REQUEST['action'];

include_once(MODELS."/".$model."_model.php");


switch(strtoupper($action))
{
	case 'LOGIN':
	case 'LOGOUT':
					include_once(CONTROLLERS."/".$model.".php");
					break;

	default:
				#$objLogin = new login();
				break;
}

?>