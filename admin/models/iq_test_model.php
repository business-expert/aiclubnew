<?php


class iq_test
{
	function __construct() 
	{
		
	}

	function getAllIQTest()
	{
		global $DB;
		
		$start	=	($start == '' || $start < 0) ? '0' : $start - 1 ; 
		$start	=	($start * RECORD_PER_PAGE);
		
		$srName 	= $_POST['sr_name'];
		$srMemberID	= $_POST['sr_member_id'];		
		
		if($srName != '')		$arrWhere[] = "(`examinee_firstn` like '%".$srName."%' OR `examinee_lastn` like '%".$srName."%')";
		if($srMemberID != '')	$arrWhere[] = "`member_id` = '".$srMemberID."'";		
		
		$SQL = "SELECT * FROM IQ_Assessment";
		
		if(count($arrWhere) > 0)
			$Where = " WHERE ".implode(" AND ", $arrWhere); 
		
		if($Where != '')	
			$SQL .=  $Where;
		
		echo $SQL;
		$Records = $DB->fetchAll($SQL);
		
		return $Records;	
	}
	
	function getIQTest($id)
	{
		global $DB;
		
		$SQL = "SELECT * FROM IQ_Assessment WHERE examinee_id='".$id."'";	
		$row = $DB->fetchOne($SQL);

		return $row;
	}
	
	function delIQTest($id)
	{
		global $DB;
		
		$SQL = "DELETE FROM IQ_Assessment WHERE examinee_id='".$id."'";
		$DB->query($SQL);
		
		$_SESSION['IQTest_success'] = "iq_test_deleted";	
	}
	
	
	function setIQTest()
	{
		global $objComm, $DB;
		
		$PkID = $_REQUEST['pk_id'];
		
		$this->arrField = $objComm->setTableField();
		
		$this->arrField['examinee_gender'] = $_REQUEST['examinee_gender'][0];
		$this->arrField['examinee_handedness'] = $_REQUEST['examinee_handedness'][0];		
		
		$this->setExtraApplicationField();
		
		if($PkID > 0)
		{
			$_SESSION['IQTest_success'] = "iq_test_updated";
			
			$where = "`examinee_id` = '".$PkID."'";
			return $DB->updateRecord('IQ_Assessment', $this->arrField, $where , '');
		}
		else
		{
			$_SESSION['IQTest_success'] = "iq_test_added";		
		
			$DB->addNewRecord('IQ_Assessment', $this->arrField, '');
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
	