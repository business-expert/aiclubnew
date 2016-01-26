<?php 

$model  = $_REQUEST['model'];
$action = $_REQUEST['action'];

include_once(MODELS_ADMIN."/".$model."_model.php");

switch(strtoupper($action))
{
	case 'ADD':
				break;
				
	case 'SAVE':
				$objAll = new alliance();
				$objAll->setAlliances($_REQUEST);
				
				$objComm->redirect('index.php?model='.$model);
				break;
				
	case 'VIEW':
	case 'EDIT':
				$objAll = new alliance();
				$row = $objAll->getAlliance($_REQUEST['id']);
				$rowLocation = $objAll->getAllianceLocationDetails($_REQUEST['id']);
				break;	
				
	case 'UPDATE':
	
				$objAll = new alliance();
				$objAll->setAlliances($_REQUEST);
				
				$objComm->redirect('index.php?model='.$model.'&action=edit&id='.$_REQUEST['pk_id']);
				
				break;	
				
	case 'DELETE':
	
				$objAll = new alliance();
				$objAll->delAlliance($_REQUEST['id']);
				
				$objComm->redirect('index.php?model='.$model);
				
				break;									
	
	default:
				$objAll = new alliance();
				$Records = $objAll->getAllAlliance();
				break;
}

?>