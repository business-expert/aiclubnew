<?php 

$model  = $_REQUEST['model'];
$action = $_REQUEST['action'];

include_once(MODELS_ADMIN."/".$model."_model.php");

switch(strtoupper($action))
{
	case 'ADD':
	
				break;
				
	case 'SAVE':
	
				$objRedeem = new redeem();
				$objRedeem->setRedeem();

				$objComm->redirect('index.php?model=redeem');
				break;		
				
	case 'VIEW':
	case 'EDIT':
				$objRedeem = new redeem();
				$row = $objRedeem->getRedeem($_REQUEST['id']);
				break;	
				
	case 'UPDATE':
	
				$objRedeem = new redeem();
				$objRedeem->setRedeem();

				$objComm->redirect('index.php?model='.$model.'&action=edit&id='.$_REQUEST['pk_id']);
				
				break;	
				
	case 'DELETE':
	
				$objRedeem = new redeem();
				$objRedeem->delRedeem($_REQUEST['id']);
				
				$objComm->redirect('index.php?model='.$model);
				
				break;									
	
	default:
				$objRedeem = new redeem();
				$Records = $objRedeem->getAllRedeem();
				break;
}

?>