<?php


class users
{
	function __construct() 
	{
		
	}
	
	function getAllUsers()
	{
		global $DB;
		
		$start	=	($start == '' || $start < 0) ? '0' : $start - 1 ; 
		$start	=	($start * RECORD_PER_PAGE);
		
		$srUserID 		= $_POST['sr_userid'];
		$srAccessRole 	= $_POST['sr_role'];
		$srStatus 		= $_POST['sr_status'];

		if($srUserID != '')		 $arrWhere[] = "`userid` like '%".$srUserID."%'";
		if($srAccessRole != '')  $arrWhere[] = "`role` = '".$srAccessRole."'";
		if($srStatus != '')		 $arrWhere[] = "`status` = '".$srStatus."'";
		
		$SQL = "SELECT * FROM users";	
		
		if(count($arrWhere) > 0)
			$Where = " WHERE ".implode(" AND ", $arrWhere); 
		
		if($Where != '')	
			$SQL .=  $Where;
		
		$SQL .=  " ORDER BY created_datetime DESC";
	//	echo $SQL;
		$Records = $DB->fetchAll($SQL);
		
		return $Records;
	}
	
	
	
	function getUsers($id)
	{
		global $DB;
		
		$SQL = "SELECT * FROM users as A
					LEFT JOIN user_role as B ON B.id = A.role
						WHERE A.id='".$id."'";	
		$row = $DB->fetchOne($SQL);
		
		return $row;
	}
	
	
	function setUsers()
	{
		global $objComm, $DB, $lang;
		
		$PkID = $_REQUEST['pk_id'];
		
		$this->arrField = $objComm->setTableField();
		
		if($_REQUEST['data_password'] == '***********')
			unset($this->arrField['password']);
		else	
			$this->arrField['password'] = md5($this->arrField['password']);
			
		$this->setExtraApplicationField();

		if($PkID > 0)
		{
			$_SESSION['users_success'] = 'user_updated';
			
			$where = "`id` = '".$PkID."'";
			return $DB->updateRecord('users', $this->arrField, $where , '');
		}
		else
		{
			$_SESSION['users_success'] = 'user_added';
		
			$DB->addNewRecord('users', $this->arrField, '');
		}
	}
	
	public function setExtraApplicationField($action = '')
	{
		$action = ($action == "") ? $_REQUEST['action'] : $action;
		
		if(strtoupper($action) == 'SAVE')
		{
			$this->arrField['created_datetime']	= date("Y-m-d 00:00:00");
		}
	
		if(strtoupper($action) == 'UPDATE')
		{
			#$this->arrField['updated_datetime']	= date("Y-m-d 00:00:00");
		}	

	}
	
	
	function delUsers($id)
	{
		global $DB, $lang;
		
		$_SESSION['users_success'] = 'user_deleted';
		
		$SQL = "DELETE FROM users WHERE id='".$id."' LIMIT 1";
		$DB->query($SQL);	
	}
	
	
}

?>