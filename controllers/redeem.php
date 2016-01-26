<?php
$model  = $_REQUEST['model'];
$action = $_REQUEST['action'];

$objComm->checkSiteSession();

include_once(MODELS."/redeem_model.php");

switch(strtoupper($action))
{
	case 'SAVE':
	
				$objRedeem = new redeem();
				$objRedeem->setRedeem();

				$objComm->redirect1('index.php?model=redeem');
				break;
				
	default:
				break;
}

?>