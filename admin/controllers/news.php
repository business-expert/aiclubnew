<?php 

$model  = $_REQUEST['model'];
$action = $_REQUEST['action'];

include_once(MODELS_ADMIN."/".$model."_model.php");

switch(strtoupper($action))
{
	case 'ADD':
				break;
				
	case 'SAVE':
				$objNews = new news();
				$objNews->setNews($_REQUEST);
				
				$objComm->redirect('index.php?model='.$model);
				break;
				
	case 'VIEW':
	case 'EDIT':
				$objNews = new news();
				$row = $objNews->getNews($_REQUEST['id']);

				break;	
				
	case 'UPDATE':
	
				$objNews = new news();
				$objNews->setNews($_REQUEST);
				
				$objComm->redirect('index.php?model='.$model.'&action=edit&id='.$_REQUEST['pk_id']);
				
				break;	
				
	case 'DELETE':
	
				$objNews = new news();
				$objNews->delNews($_REQUEST['id']);
				
				$objComm->redirect('index.php?model='.$model);
				
				break;									
	
	default:
				$objNews = new news();
				$Records = $objNews->getAllNews();
				break;
}

?>