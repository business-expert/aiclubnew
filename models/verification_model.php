<?php

class verification
{
	function __construct() 
	{
		global $DB, $objComm;
	}
	
	function verifyData()
	{
		global $DB, $objComm, $lang;
		
		$this->getMemberFromActivation();

		if($this->row->id > 0)
		{
			$BirthDate = date("Y-m-d",strtotime($_REQUEST['date_year']."-".$_REQUEST['date_month']."-".$_REQUEST['date_date']));
			
			$arrData['fname'] 			= $_REQUEST['data_fname'];
			$arrData['lname'] 			= $_REQUEST['data_lname'];
			$arrData['birth_date'] 		= $BirthDate;
			$arrData['contact_no'] 		= $_REQUEST['data_contact_no'];
			$arrData['email_address'] 	= $_REQUEST['data_email_address'];						
			
			foreach($arrData as $key => $value)
				$arrField[] = "`$key` = '".$value."'";
			
			$SQL 	 = "SELECT * FROM members WHERE ".implode(" AND ", $arrField); 
			$Records = $DB->fetchOne($SQL);

			if($Records->id > 0)
			{
				$this->verifiedAccount();
				$objComm->redirect1("verify.php?model=verification&action=password&code=".$_REQUEST['code']);	
			}
			else
			{
				$this->row->verification_attempt = $this->row->verification_attempt + 1;
				$_SESSION['verification_error']  =  $lang['incorrect_data']."<br>"
												   .$lang['attempt_'.$this->row->verification_attempt].' <br>'
												   .$lang['incorrect_attempt'];	
				$this->addAttamptTo();	
			}
		}
		
		
	}
	
	function verifiedAccount()
	{
		global $DB ,$objComm;

		$SQL = "UPDATE members 
					SET `verification_attempt`= 0 , `verified` = 'Y'
						WHERE id='".$this->row->id."'";
						
		$DB->query($SQL);	
	}
	
	function getMemberFromActivation()
	{
		global $DB, $objComm, $lang;
		
		$SQL = "SELECT * FROM members WHERE activation='".$_REQUEST['code']."'";
		$row = $DB->fetchOne($SQL);	

		if($row->id > 0)
		{
			if($row->verification_attempt >= 3)
			{
				$_SESSION['activation_error'] = $lang['account_suspend'];
				include_once(VIEWS. "/error/activation.php");
				exit();	
			}
			else
				$this->row = $row;
		}
		else
			$objComm->redirect1("verification.php?code=".$_REQUEST['code']);
	}
	
	function createPassword()
	{
		global $DB, $objComm, $lang;
				
		$this->getMemberFromActivation();
		//$this->checkUniqUsername();
		
		$SQL = "UPDATE members 
				   SET `activation`= '' , `verified` = 'D', 
				   		password='".md5($_REQUEST['data_password'])."', status = 'Active'
					  		WHERE id='".$this->row->id."'";
						
		$DB->query($SQL);
		
		$this->sendmail();
		
		$_SESSION['activation_error'] = $lang['account_created_check_email'];
		include_once(VIEWS. "/error/activation.php");
		exit();
	}
	
	public function sendmail()
	{
		$to 	 = $this->row->email_address;
		//$to 	 = 'rakesh.r.singh@hotmail.com';
		$subject = 'AI Club - Your Memeber account created successfully';
		
		$arrData['{FIRST_NAME}'] = $this->row->fname;
		$arrData['{EMAIL}']   = $this->row->email_address;
		$arrData['{PASSWORD}']   = $_REQUEST['data_password'];
		$arrData['{URL}'] 		 = SITE_PATH."/index.php";		
		
		$objEmail = new email();
		
		$EmailBody = $objEmail->emailTemplate('member_login',$arrData);	
		
		$objEmail->sendmail($to,$subject,$EmailBody);		
	}
	
	
	function addAttamptTo()
	{
		global $DB ,$objComm;

		if($this->row->verification_attempt <= 3)
		{
			$SQL = "UPDATE members 
						SET `verification_attempt`= `verification_attempt`+1 
							WHERE id='".$this->row->id."'";
						
			$DB->query($SQL);	
		}
		else
		{
			$SQL = "UPDATE members 
						SET status= 'Suspend' 
							WHERE id='".$this->row->id."'";
						
			$DB->query($SQL);	
		}

		$objComm->redirect1("verification.php?code=".$_REQUEST['code']);
	}
}
?>
