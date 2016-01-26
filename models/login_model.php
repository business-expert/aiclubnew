<?php


class login
{
	function __construct() 
	{
		
	}
	
	function checkLogin()
	{
		global $objComm;
		
		$this->ValidateData();
		
		if($this->row->id > 0)
		{
			$this->setLoggedSession();
			$objComm->redirect1('index.php?model=dashboard');
		}
	}
	
	
	function ValidateData()
	{
		global $DB, $objComm;
		
		if($_REQUEST['login_type'] == "member")
			$SQL = "SELECT * FROM members WHERE email_address='".$_POST['username']."' AND password = '".md5($_POST['password'])."'";
		else
			$SQL = "SELECT * FROM alliance WHERE email='".$_POST['username']."'";// AND password = '".md5($_POST['password'])."'";
			
		$row = $DB->fetchOne($SQL);

		if($row->id > 0)
		{
			if(strtoupper($row->status) == 'ACTIVE')
				$this->row = $row;
			else
			{
				//$_SESSION['login_error'] = "You can not logged in system, Your account status is ".ucfirst($row->status);
				$_SESSION['login_error'] = "account_block";//.ucfirst($row->status);
				$objComm->redirect1("index.php");
			}
		}
		else
		{
			$_SESSION['login_error'] = "incorrect_username_password";
			
			$objComm->redirect1("index.php");
		}
	}
	
	function setLoggedSession()
	{
		//$UserRole   = $this->getAccessRole();
		//$AccessType = $this->getAccessType();		

		$_SESSION['site']['ai_user']   = $this->row->email_address;
		$_SESSION['site']['ai_row']   = $this->row;
		//$_SESSION['ai_ses_role']   = $UserRole;
		//$_SESSION['ai_ses_access'] = $AccessType;
	}
	
	function logout()
	{
		global $objComm;
		
		foreach($_SESSION['site'] as $key => $value)
		{
			$_SESSION['site'][$key] = '';
			unset($_SESSION['site'][$key]);
		}
		
		$_SESSION['login_success']	= 'logout_success';
		$objComm->redirect1('index.php?model=home');

		exit();		
	}
}

?>