<?php 

$model  = $_REQUEST['model'];
$action = $_REQUEST['action'];

include_once(MODELS_ADMIN."/".$model."_model.php");

switch(strtoupper($action))
{
	case 'ADD':
	
				break;
				
	case 'SAVE':
				$objMem = new members();
				$objMem->setMembers($_REQUEST);
				
				$objComm->redirect('index.php?model=members');
				break;			
				
	case 'VIEW':
	case 'EDIT':
				$objMem = new members();
				$row = $objMem->getMembers($_REQUEST['id']);
				$rowChilds = $objMem->getMemberChildDetails($_REQUEST['id']);
				break;	
				
	case 'UPDATE':
	
				$objMem = new members();
				$objMem->setMembers($_REQUEST);

				$objComm->redirect('index.php?model=members&action=edit&id='.$_REQUEST['pk_id']);
				
				break;	
				
	case 'DELETE':
	
				$objMem = new members();
				$objMem->delMembers($_REQUEST['id']);
				
				$objComm->redirect('index.php?model=members');
				
				break;									
	
	default:
				$objMem = new members();
				$Records = $objMem->getAllMembers();
				break;
}

?>