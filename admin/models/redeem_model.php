<?php


class redeem
{
	function __construct() 
	{
		
	}

	function getAllRedeem()
	{
		global $DB;
		
		$start	=	($start == '' || $start < 0) ? '0' : $start - 1 ; 
		$start	=	($start * RECORD_PER_PAGE);
		
		$srName 	= $_POST['sr_name'];
		$srMemberID	= $_POST['sr_member_id'];		
		
		if($srName != '')		$arrWhere[] = "(`first_name` like '%".$srName."%' OR `last_name` like '%".$srName."%')";
		if($srMemberID != '')	$arrWhere[] = "`member_id` = '".$srMemberID."'";		
		
		$SQL = "SELECT * FROM assessment_redeem";
		
		if(count($arrWhere) > 0)
			$Where = " WHERE ".implode(" AND ", $arrWhere); 
		
		if($Where != '')	
			$SQL .=  $Where;
		
		echo $SQL;
		$Records = $DB->fetchAll($SQL);
		
		return $Records;	
	}
	
	function getRedeem($id)
	{
		global $DB;
		
		$SQL = "SELECT * FROM assessment_redeem WHERE id='".$id."'";	
		$row = $DB->fetchOne($SQL);

		return $row;
	}
	
	function delRedeem($id)
	{
		global $DB;
		
		$SQL = "DELETE FROM assessment_redeem WHERE id='".$id."'";
		$DB->query($SQL);
		
		$_SESSION['redeem_success'] = "redeem_deleted";	
	}
	
	
	function setRedeem()
	{
		global $objComm, $DB;
		
		$PkID = $_REQUEST['pk_id'];
		
		$this->arrField = $objComm->setTableField();
		
		$this->arrField['gender'] = $_REQUEST['gender'][0];
		
		$this->setExtraApplicationField();
		
		if($PkID > 0)
		{
			$_SESSION['redeem_success'] = "redeem_updated";
			
			$where = "`id` = '".$PkID."'";
			return $DB->updateRecord('assessment_redeem', $this->arrField, $where , '');
		}
		else
		{
			$_SESSION['redeem_success'] = "redeem_added";		
		
			$DB->addNewRecord('assessment_redeem', $this->arrField, '');
		}
	}
	
	public function setExtraApplicationField($action = '')
	{
		$action = ($action == "") ? $_REQUEST['action'] : $action;
		
		if(strtoupper($action) == 'SAVE')
		{
			$this->arrField['member_id']	= $_SESSION['site']['ai_row']->id;
			$this->arrField['date_added']	= date("Y-m-d 00:00:00");
		}
	
		if(strtoupper($action) == 'UPDATE')
		{
			$this->arrField['date_updated']	= date("Y-m-d 00:00:00");
		}	
	}
}

?>
	