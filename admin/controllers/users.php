<?php 

$model  = $_REQUEST['model'];
$action = $_REQUEST['action'];

include_once(MODELS_ADMIN."/".$model."_model.php");

switch(strtoupper($action))
{
	case 'ADD':
	
				break;
				
	case 'SAVE':
				$objUsr = new users();
				$objUsr->setUsers($_REQUEST);
				
				$objComm->redirect('index.php?model='.$model);
				break;			
				
	case 'VIEW':
	case 'EDIT':
				$objUsr = new users();
				$row = $objUsr->getUsers($_REQUEST['id']);
				break;	
				
	case 'UPDATE':
	
				$objUsr = new users();
				$objUsr->setUsers($_REQUEST);

				$objComm->redirect('index.php?model='.$model.'&action=edit&id='.$_REQUEST['pk_id']);
				
				break;	
				
	case 'DELETE':
	
				$objUsr = new users();
				$objUsr->delUsers($_REQUEST['id']);
				
				$objComm->redirect('index.php?model='.$model);
				
				break;									
	
	default:

				$objUsr = new users();
				$Records = $objUsr->getAllUsers();
				break;
}

?>