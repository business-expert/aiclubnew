<?php


class userrole
{
	function __construct() 
	{
		
	}
	
	function getAllUserRole()
	{
		global $DB;
		
		$start	=	($start == '' || $start < 0) ? '0' : $start - 1 ; 
		$start	=	($start * RECORD_PER_PAGE);
		
		$srName 		= $_POST['sr_name'];
		$srAccessRoll 	= $_POST['sr_role'];
		$srStatus 		= $_POST['sr_status'];
		
		if($srUserID != '')		 $arrWhere[] = "`userid` like '%".$srName."%'";
		if($srAccessRole != '')  $arrWhere[] = "`role` like '%".$srPhone."%'";
		if($srStatus != '')		 $arrWhere[] = "`status` like '%".$srStatus."%'";
		
		$SQL = "SELECT A.id, A.user_type,C.module_name,B.module_access FROM user_role as A
					LEFT JOIN access_role as B ON B.user_role = A.id
					LEFT JOIN module_access_property as C ON C.id = B.module";	
		
		if(count($arrWhere) > 0)
			$Where = " WHERE ".implode(" AND ", $arrWhere); 
		
		if($Where != '')	
			$SQL .=  $Where;
		
		$SQL .= " GROUP BY A.user_type";
		
		//echo $SQL;
		$Records = $DB->fetchAll($SQL);
		
		return $Records;
	}
	
	
	function getUser($id)
	{
		global $DB;
		
		$SQL = "SELECT * FROM user_role WHERE id='".$id."'";	
		$row = $DB->fetchOne($SQL);
		
		return $row;			
	}
	
	function getModulePermission($id)
	{
		global $DB, $objComm;
		
		$arrModulePermission = $this->getAllModulePermission();
		
		foreach($arrModulePermission as $key => $permission)
		{
			$SQL = "SELECT A.id AS module_id, A.module_name, 
					 CONCAT_WS(',',A.access_1,A.access_2,A.access_3,A.access_4,A.access_5,A.access_6) as mod_permission, 
					 B.module_access,C.id as user_role_id
						FROM module_access_property AS A
							LEFT JOIN access_role as B ON B.module = A.id
							LEFT JOIN user_role as C ON C.id = B.user_role
								WHERE C.id = '".$id."' AND A.id='".$permission->id."'";
				
			$arrRow = $DB->fetchOne($SQL);

			if($arrRow->module_id > 0)
				$arrRecord[] = $arrRow;
			else
			{
				$arrRecord[] = (object)	array(	'module_id'   	=> $permission->id, 
									 			'module_name' 	=> $permission->module_name, 
												'mod_permission'=> implode(",",$objComm->getModuleProperty($permission->id)),
												'module_access' => '', 
												'user_role_id'  => $id
											 );
			}
		}
		
		return $arrRecord;	
	}
	
	function getAllModulePermission()
	{
		global $DB;
		
		$SQL = "SELECT * FROM module_access_property";
		$row = $DB->fetchAll($SQL);
		
		return $row;			
	}
	
	
	function getAccessRole($id, $moduleid)
	{
		global $DB;
		
		$SQL = "SELECT * FROM access_role WHERE user_role='".$id."' AND module='".$moduleid."'";
		$row = $DB->fetchOne($SQL);
		
		return $row;			
	}
	
	function setUserRole()
	{
		global $objComm, $DB, $lang;
		
		$PkID = $_REQUEST['pk_id'];
		
		if($PkID > 0)
		{
			foreach($_REQUEST['module_permission'] as $key => $value)
			{
				$moduleName 	= $_REQUEST['module_permission'][$key];
				$rowModule 		= $objComm->getModulePropertyDetails($moduleName);
				$moduleAccess 	= strtolower(implode(",",$_REQUEST['perm_'.$moduleName]));
				
				$arrUpdate['user_role'] 	= $PkID;
				$arrUpdate['module'] 		= $rowModule->id;
				$arrUpdate['module_access'] = $moduleAccess;
				
				$row = $this->getAccessRole($PkID, $rowModule->id);
				
				if($row->id > 0) #update	
				{
					$where = "`id` = '".$row->id."'";
					$DB->updateRecord('access_role', $arrUpdate, $where , '');
				}
				else #insert	
				{
					$DB->addNewRecord('access_role', $arrUpdate, '');
				}
				
				$_SESSION['usersrole_success'] = ($_REQUEST['action'] == 'UPDATE' ) 
												? 'userrole_updated' 
												: 'userrole_added';
			}
		}
	}
	
	function delUserRole($id)
	{
		global $DB, $lang;
		
		$_SESSION['usersrole_success'] = 'userrole_deleted';
		
		$SQL = "DELETE FROM access_role WHERE user_role = '".$id."'";
		$DB->query($SQL);	
	}
}

?>