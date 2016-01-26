<?php


class redeem
{
	function __construct() 
	{
		
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
			$_SESSION['redeem_success'] = "redeem_added";
			
			$where = "`id` = '".$PkID."'";
			return $DB->updateRecord('assessment_redeem', $this->arrField, $where , '');
		}
		else
		{
			$_SESSION['redeem_success'] = "redeem_updated";		
		
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
	