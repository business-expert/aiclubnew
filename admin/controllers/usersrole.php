<?php 

$model  = $_REQUEST['model'];
$action = $_REQUEST['action'];

include_once(MODELS_ADMIN."/".$model."_model.php");

switch(strtoupper($action))
{
	case 'ADD':
				break;
				
	case 'SAVE':
				$objURole = new userrole();
				$objURole->setUserRole($_REQUEST);
				
				$objComm->redirect('index.php?model='.$model);
				break;
				
	case 'VIEW':
	case 'EDIT':
				$objURole = new userrole();
				$row = $objURole->getUser($_REQUEST['id']);
				$rowModule = $objURole->getModulePermission($_REQUEST['id']);

				break;	
				
	case 'UPDATE':
	
				$objURole = new userrole();
				$objURole->setUserRole($_REQUEST);
				
				$objComm->redirect('index.php?model='.$model.'&action=edit&id='.$_REQUEST['pk_id']);
				
				break;	
				
	case 'DELETE':
	
				$objURole = new userrole();
				$objURole->delUserRole($_REQUEST['id']);
				
				$objComm->redirect('index.php?model='.$model);
				
				break;									
	
	default:
				$objURole = new userrole();
				$Records = $objURole->getAllUserRole();
				break;
}

?>