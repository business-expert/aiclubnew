<?php
$model  = $_REQUEST['model'];
$action = $_REQUEST['action'];

include_once(MODELS."/".$model."_model.php");
//echo "<pre>"; print_r($_REQUEST); die(__FILE__."--".__LINE__);
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