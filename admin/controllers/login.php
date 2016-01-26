<?php
$model  = $_REQUEST['model'];
$action = $_REQUEST['action'];

include_once(MODELS_ADMIN."/".$model."_model.php");

switch(strtoupper($action))
{
	case 'LOGIN':
					$objLogin = new login();
					$objLogin->checkLogin();
					break;
	
	case 'LOGOUT':
					$objLogin = new login();
					$objLogin->logout();
					break;				
	default:
				#$objLogin = new login();
				break;
}

?>