<?php
$model  = $_REQUEST['model'];
$action = $_REQUEST['action'];

include_once(MODELS."/".$model."_model.php");

switch(strtoupper($action))
{
	case 'VERIFIED':
				$objVery = new verification();
				$objVery->verifyData();
				break;
	
	case 'PASSWORD':
				$objVery = new verification();
				$objVery->getMemberFromActivation();
				break;	
				
	case 'CREATE':
				$objVery = new verification();
				$objVery->createPassword();
				break;							
	default:
				$objVery = new verification();
				//$objVery->verifyData();
				break;
}

?>