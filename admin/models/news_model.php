<?php


class news
{
	function __construct() 
	{
		$this->_table = 'news';
		$this->_pkID  = 'id';		
	}
	
	function getAllNews()
	{
		global $DB;
		
		$start	=	($start == '' || $start < 0) ? '0' : $start - 1 ; 
		$start	=	($start * RECORD_PER_PAGE);
		
		$srNewsTitle 	= $_POST['sr_news_title'];

		if($srNewsTitle != '')		 $arrWhere[] = "`news_title` like '%".$srNewsTitle."%'";
		
		$SQL = "SELECT * FROM ".$this->_table;	
		
		if(count($arrWhere) > 0)
			$Where = " WHERE ".implode(" AND ", $arrWhere); 
		
		if($Where != '')	
			$SQL .=  $Where;
		
		$SQL .=  " ORDER BY created_datetime DESC";
		//echo $SQL;
		$Records = $DB->fetchAll($SQL);
		
		return $Records;
	}
	
	
	
	function getNews($id)
	{
		global $DB;
		
		$SQL = "SELECT * FROM ".$this->_table." WHERE ".$this->_pkID."='".$id."'";	
		$row = $DB->fetchOne($SQL);
		
		return $row;
	}
	
	
	function setNews()
	{
		global $objComm, $DB, $lang;
		
		$PkID = $_REQUEST['pk_id'];
		
		$this->arrField = $objComm->setTableField();
		
		$this->setExtraApplicationField();

		if($PkID > 0)
		{
			$_SESSION['news_success'] = $lang['news_updated'];
			
			$where = $this->_pkID." = '".$PkID."'";
			return $DB->updateRecord($this->_table, $this->arrField, $where , '');
		}
		else
		{
			$_SESSION['news_success'] = $lang['news_added'];		
		
			$DB->addNewRecord($this->_table, $this->arrField, '');
		}
		
		if($this->arrField['admin_status'] == 'Approve' && $this->arrField['status'] == 'Active')
		{
			$this->sendmail();
		}
	}
	
	public function setExtraApplicationField($action = '')
	{
		$action = ($action == "") ? $_REQUEST['action'] : $action;
		
		if(strtoupper($action) == 'SAVE')
		{
			$this->arrField['created_datetime']	= date("Y-m-d H:i:s");
			//$this->arrField['created_by']		= $_SESSION['admin']['ai_user'];
		}
	
		if(strtoupper($action) == 'UPDATE')
		{
			$this->arrField['updated_datetime']	= date("Y-m-d H:i:s");
			//$this->arrField['updated_by']	 	= $_SESSION['admin']['ai_user'];			
		}	
	}
	
	
	function delNews($id)
	{
		global $DB, $lang;
		
		$_SESSION['news_success'] = $lang['news_deleted'];
		
		$SQL = "DELETE FROM ".$this->_table." 
					WHERE `".$this->_pkID."`='".$id."' LIMIT 1";
					
		$DB->query($SQL);	
	}
	
	public function sendmail()
	{
		global $objComm;
		
		$arrRow = $objComm->getAllMembers();
		
		foreach($arrRow as $key => $row)
		{
			$to 	 = $row->email_address;
			$subject = 'AI CLub - News added/updated ';
	
			$arrData['{NEWS_TITLE}'] = $this->arrField['fname'];
			$arrData['{NEWS_DESC}']  = $this->arrField['fname'];
			$arrData['{FIRST_NAME}'] = $row->fname;
	
			$objEmail = new email();
	
			$EmailBody = $objEmail->emailTemplate('news',$arrData);	
			$objEmail->sendmail($to,$subject,$EmailBody);
		}
	}
}

?>