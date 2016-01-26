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
			$objComm->redirect('index.php?model=dashboard');
		}
	}
	
	
	function ValidateData()
	{
		global $DB, $lang;
		
		$SQL = "SELECT * FROM users WHERE userid='".$_POST['username']."' AND password = '".md5($_POST['password'])."'";	
		$row = $DB->fetchOne($SQL);

		if($row->id > 0)
		{
			if(strtoupper($row->status) == 'ACTIVE')
				$this->row = $row;
			else
				$_SESSION['login_error'] = $lang['login_error_status']." ".ucfirst($row->status);
		}
		else
		{
			$_SESSION['login_error'] = 'login_error';
		}
	}
	
	function setLoggedSession()
	{
		$UserRole   = $this->getAccessRole();
		$AccessType = $this->getAccessType();		

		$_SESSION['admin']['ai_user'] = $this->row->userid;
		$_SESSION['admin']['ai_role'] = $UserRole;
		$_SESSION['admin']['ai_access'] = $AccessType;
	}
	
	function logout()
	{
		global $objComm;
		
		foreach($_SESSION['admin'] as $key => $value)
		{
			$_SESSION['admin'][$key] = '';
			unset($_SESSION['admin'][$key]);
		}
		
		$_SESSION['login_success']	= 'loogged_out';

		$objComm->redirect('index.php?model=login');

		exit();		
	}
	
	function getAccessRole()
	{	
		global $objComm;
		
		$UserRole = $objComm->getUserRole($this->row->role);
		
		return $UserRole;
		
	}
	
	function getAccessType()
	{	
		global $DB;
		
		$SQL = "SELECT A.user_role,B.module_name,A.module_access FROM access_role as A
				   LEFT JOIN module_access_property as B ON B.id = A.module
					  WHERE A.user_role = '".$this->row->role."'";
						
		$UserAccessRole = $DB->fetchAll($SQL);
		
		foreach($UserAccessRole as $row)
		{
			$arrAccessModule[strtolower($row->module_name)] = explode(",",$row->module_access);
		}
		
		return $arrAccessModule;		
	}
	
}

?>