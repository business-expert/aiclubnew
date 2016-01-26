<?php


class iq_test
{
	function __construct() 
	{
		
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
			
			$where = "`id` = '".$PkID."'";
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
	