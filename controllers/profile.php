<?php
$model  = $_REQUEST['model'];
$action = $_REQUEST['action'];

$objComm->checkSiteSession();

$SessUserDetails = $_SESSION['site']['ai_row'];

include_once(MODELS."/profile_model.php");

switch(strtoupper($action))
{
	case 'UPDATE':
				$objProfile = new profile();
				$objProfile->setMembers($_REQUEST);

				$objComm->redirect1('index.php?model=dashboard');
				break;
				
	case 'EDIT':
	default:
				$objProfile = new profile();
				$row 		= $objProfile->getMembers($SessUserDetails->id);
				break;
}

?>