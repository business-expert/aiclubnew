<?php
$model  = $_REQUEST['model'];
$action = $_REQUEST['action'];

include_once(MODELS."/member_model.php");

switch(strtoupper($action))
{
	case 'SAVE':
				$objMember = new member();
				$objMember->setMembers();				
				break;
				
	case 'PAYMENT':
				
				if(isset($_REQUEST['btn_submit_x'])  && $_REQUEST['btn_submit_x'] != '')
				{
					$objMember 	= new member();
					$row = $objMember->payment();
				}
				else
				{
					$objMember 	= new member();
					$row = $objMember->getMembers($_SESSION['register']['member_id']);
				}
				
				break;
				
	case 'PAID':
				$objMember = new member();
				$objMember->finalPayment();
				break;			
				
	case 'REGISTER';
				if($_SESSION['site']['ai_user'] != '')
					$objComm->redirect1("index.php");	
					
				break;
	default:
				break;
}

?>