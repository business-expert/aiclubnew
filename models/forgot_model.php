<?php


class forgot
{
	function __construct() 
	{
		
	}
	
	function VerifyDetails()
	{
		global $DB, $objComm, $lang;
		
		$birthday = $objComm->getYearFromCombo($_REQUEST, 'date_');
		
		$SQL = "SELECT * FROM members 
					WHERE email_address='".$_REQUEST['data_email_address']."' AND birth_date='".$birthday."'";
					
		$row = $DB->fetchOne($SQL);
		
		if($row->id > 0)
		{
			$this->createActivationURL($row);
			$_SESSION['forgot_success'] = $lang['password_email_sent'];
		}
		else
		{
			$_SESSION['forgot_error'] = $lang['forget_correct_details'];;	
		}
		
		return $row;
	}
	
	public function createActivationURL($row)
	{
		global $objComm, $DB;
		
		$RandomString = $objComm->generateRandomString(20);
		
		$arrData['activation'] = $RandomString;
		$arrData['forgot_pass'] = 'Y';
		
		$where = "`id` = '".$row->id."'";
		$DB->updateRecord('members', $arrData, $where , '');

		#------------ EMAIL FOR VERIFICATION ------------#
		$this->sendVerificationEmail($row, $RandomString);
	}
	
	
	
	public function sendVerificationEmail($row, $RandomString)
	{
		global $objComm,$DB;
		
		$to 	 = $row->email_address;
		$subject = 'AI Club - Forgotten password request‏';
		
		$arrData['{FIRST_NAME}'] = $row->fname;
		$arrData['{EMAIL}']   	 = $row->email_address;
		$arrData['{URL}'] 		 = SITE_PATH."/forgot_password.php?sid=".$RandomString;		
		
		$objEmail  = new email();
		$EmailBody = $objEmail->emailTemplate('member_forget_pass',$arrData);	
		$objEmail->sendmail($to,$subject,$EmailBody);		
	}
	
	
	function changePassword()
	{
		global $objComm,$DB,$lang;
		
		$SQL = "SELECT * FROM members 
				  WHERE activation='".$_REQUEST['sid']."' AND forgot_pass='Y'";
		
		$row = $DB->fetchOne($SQL);

		$birthday = $objComm->getYearFromCombo($_REQUEST, 'date_');

		if(date("Y-m-d",strtotime($row->birth_date)) == date("Y-m-d",strtotime($birthday)))
		{
			$Update = "UPDATE members 
					     SET password = '".md5($_REQUEST['data_password'])."' , activation='' , forgot_pass='N'
						   WHERE id = '".$row->id."'";
			
			$DB->query($Update);
			
			$this->sendPasswordChangedEmail($row);	// for member
			$this->sendPasswordChangedEmail1($row);  //for admin
			
			$_SESSION['login_success'] = $lang['password_changed'];	
			
			$objComm->redirect1('index.php');
		}
		else
		{
			$_SESSION['forgot_error'] = $lang['correct_birth_date'];			
		}
	}
	
	public function sendPasswordChangedEmail($row)
	{
		global $objComm,$DB;
		
		$to 	 = $row->email_address;
		$subject = 'AI Club - Password Change‏‏d';
		
		$arrData['{FIRST_NAME}'] = $row->fname;
		$arrData['{EMAIL}']   	 = $row->email_address;
		
		$objEmail  = new email();
		$EmailBody = $objEmail->emailTemplate('member_password_changed',$arrData);	
		$objEmail->sendmail($to,$subject,$EmailBody);		
	}
	
	public function sendPasswordChangedEmail1($row)
	{
		global $objComm,$DB;
		
		$to 	 = ADMIN_EMAIL;
		$subject = 'AI Club - Password Change‏‏d';
		
		$arrData['{NAME}'] 		 = $row->fname;
		$arrData['{EMAIL}']   	 = $row->email_address;
		$arrData['{BIRTHDATE}']  = $row->birth_date;		
		
		$objEmail  = new email();
		$EmailBody = $objEmail->emailTemplate('new_password_changed',$arrData);	
		$objEmail->sendmail($to,$subject,$EmailBody);		
	}
}
?>
	