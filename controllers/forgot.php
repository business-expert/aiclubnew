<?php
$model  = $_REQUEST['model'];
$action = $_REQUEST['action'];

include_once(MODELS."/forgot_model.php");

switch(strtoupper($action))
{
	case 'VERIFY':
				$objForgot = new forgot();
				$objForgot->VerifyDetails();
				break;
	
	case 'PASSWORD':
				if(isset($_REQUEST['btn_submit']) && $_REQUEST['btn_submit'] == 'pass_change')
				{
					$objForgot = new forgot();
					$objForgot->changePassword();
				}
				break;
							
	default:
				break;
}

?>