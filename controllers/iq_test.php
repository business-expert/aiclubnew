<?php
$model  = $_REQUEST['model'];
$action = $_REQUEST['action'];

$objComm->checkSiteSession();

include_once(MODELS."/iq_test_model.php");

switch(strtoupper($action))
{
	case 'SAVE':
	
				$objIQTest = new iq_test();
				$objIQTest->setIQTest();

				$objComm->redirect1('index.php?model=iq_test');
				break;
				
	default:
				break;
}

?>