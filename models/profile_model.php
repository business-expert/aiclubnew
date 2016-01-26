<?php


class profile
{
	function __construct() 
	{
		
	}
	
	function getMembers($id)
	{
		global $DB;
		
		$SQL = "SELECT * FROM members WHERE id='".$id."'";	
		$row = $DB->fetchOne($SQL);
		
		return $row;
	}
	
	
	function getMemberChildDetails($id)
	{
		global $DB;
		
		$SQL = "SELECT * FROM members_children WHERE member_id='".$id."'";	
		$row = $DB->fetchAll($SQL);
		
		return $row;
	}
	
	function setMembers()
	{
		global $objComm, $DB;
		
		$PkID = $_REQUEST['pk_id'];
		
		$birthday = $objComm->getYearFromCombo($_REQUEST, 'date_');

		$this->arrField = $objComm->setTableField();
		$this->arrField['birth_date'] = $birthday;
		
		$this->setExtraApplicationField();

		if($PkID > 0)
		{
			$_SESSION['profile_success'] = "profile_updated";
			
			$oldEmail = $_REQUEST['hid_email'];
			$newEmail = $this->arrField['email_address'];
			
			if($oldEmail != $newEmail)
				$this->sendEmailChangeMail($oldEmail);
				
			$where = "`id` = '".$PkID."'";
			return $DB->updateRecord('members', $this->arrField, $where , '');
		}
		else
		{
			$_SESSION['profile_success'] = "profile_added";		
		
			$DB->addNewRecord('members', $this->arrField, '');
		}
	}
	
	public function setExtraApplicationField($action = '')
	{
		$action = ($action == "") ? $_REQUEST['action'] : $action;
		
		if(strtoupper($action) == 'SAVE')
		{
			$this->arrField['created_by']		= $_SESSION['admin']['ai_user'];
			$this->arrField['created_datetime']	= date("Y-m-d 00:00:00");
		}
	
		if(strtoupper($action) == 'UPDATE')
		{
			$this->arrField['updated_by']		= $_SESSION['admin']['ai_user'];
			$this->arrField['updated_datetime']	= date("Y-m-d 00:00:00");
		}	
	}
	
	public function sendEmailChangeMail($newEmail)
	{
		$to 	 = $newEmail;
		$subject = 'AI Club - Email Changed';
		
		$arrData['{FIRST_NAME}'] = $this->arrField['fname'];
		$arrData['{EMAIL}'] = $newEmail;
		
		$objEmail = new email();
		
		$EmailBody = $objEmail->emailTemplate('member_email_changed',$arrData);	
		
		$objEmail->sendmail($to,$subject,$EmailBody);	
		
		$this->sendEmailChangeMailAdmin($newEmail);
	}
	
	
	public function sendEmailChangeMailAdmin($newEmail)
	{
		$to 	 = ADMIN_EMAIL;
		$subject = 'AI Club - Email Changed';
		
		$arrData['{EMAIL}'] = $newEmail;
		
		$objEmail = new email();
		
		$EmailBody = $objEmail->emailTemplate('member_email_changed_admin',$arrData);	
		
		$objEmail->sendmail($to,$subject,$EmailBody);		
	}
		


}

?>
	