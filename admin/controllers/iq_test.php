<?php 

$model  = $_REQUEST['model'];
$action = $_REQUEST['action'];

include_once(MODELS_ADMIN."/".$model."_model.php");

switch(strtoupper($action))
{
	case 'ADD':
	
				break;
				
	case 'SAVE':
	
				$objIQTest = new iq_test();
				$objIQTest->setIQTest();

				$objComm->redirect('index.php?model=iq_test');
				break;		
				
	case 'VIEW':
	case 'EDIT':
				$objIQTest = new iq_test();
				$row = $objIQTest->getIQTest($_REQUEST['id']);
				break;	
				
	case 'UPDATE':
	
				$objIQTest = new iq_test();
				$objIQTest->setIQTest();

				$objComm->redirect('index.php?model='.$model.'&action=edit&id='.$_REQUEST['pk_id']);
				
				break;	
				
	case 'DELETE':
	
				$objIQTest = new iq_test();
				$objIQTest->delIQTest($_REQUEST['id']);
				
				$objComm->redirect('index.php?model='.$model);
				
				break;									
	
	default:
				$objIQTest = new iq_test();
				$Records = $objIQTest->getAllIQTest();
				break;
}

?>