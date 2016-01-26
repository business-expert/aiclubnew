<?php


class alliance
{
	function __construct() 
	{
		
	}
	
	function getAllAlliance()
	{
		global $DB;
		
		$srName 	= $_POST['sr_name'];
		$srBusinessName	= $_POST['sr_business_name'];
		$srAddress 	= $_POST['sr_address'];
		$srPhone 	= $_POST['sr_phone_no'];
		$srEmail 	= $_POST['sr_email'];
		$srCategory = $_POST['sr_category'];
		$srStatus 	= $_POST['sr_status'];
		
		if($srName != '')		$arrWhere[] = "`name` like '%".$srName."%'";
		if($srBusinessName != '') $arrWhere[] = "`business_name` like '%".$srBusinessName."%'";
		if($srAddress != '')	$arrWhere[] = " `location` like '%".$srAddress."%'";
		if($srPhone != '')		$arrWhere[] = "`contact_no` like '%".$srPhone."%'";
		if($srEmail != '')		$arrWhere[] = "`email_address` like '%".$srEmail."%'";
		if($srCategory != '')	$arrWhere[] = "`category` like '%".$srCategory."%'";
		if($srStatus != '')		$arrWhere[] = "`status` like '%".$srStatus."%'";
		
		$SQL = "SELECT * FROM alliance";	
		
		if(count($arrWhere) > 0)
			$Where = " WHERE ".implode(" AND ", $arrWhere); 
		
		if($Where != '')	
			$SQL .=  $Where;
		
		//echo $SQL;	
		$Records = $DB->fetchAll($SQL);
		
		return $Records;
	}
	
	
	
	function getAlliance($id)
	{
		global $DB;
		
		$SQL = "SELECT * FROM alliance WHERE id='".$id."'";	
		$row = $DB->fetchOne($SQL);
		
		return $row;
	}
	
	
	function setAlliances()
	{
		global $objComm, $DB;
		
		$PkID = $_REQUEST['pk_id'];
		
		$this->arrField = $objComm->setTableField();
		$this->setExtraApplicationField();

		if($PkID > 0)
		{
			$this->setAllianceLocation($PkID);
			
			$_SESSION['alliance_success'] = "Alliance updated Successfully";
			
			$where = "`id` = '".$PkID."'";
			//$this->updateAllianceShipID($PkID);
			return $DB->updateRecord('alliance', $this->arrField, $where , '');
		}
		else
		{
			$_SESSION['alliance_success'] = "Alliance added Successfully";	
			
			$PKID =  $DB->addNewRecord('alliance', $this->arrField, '');
			
			$this->updateAllianceShipID($PkID);
			$this->setAllianceLocation($PKID);
		}
	}
	
	function updateAllianceShipID($PkID)
	{
		global $BD;
		
		$arrUpdateField['alliance_id'] = $PkID.rand(1000,9999);
		$where = "`id` = '".$PkID."'";
		return $DB->updateRecord('alliance', $arrUpdateField, $where , '');
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
	
	
	function delAlliance($id)
	{
		global $DB;
		
		$_SESSION['alliance_success'] = "Alliance Deleted Successfully";
		
		$SQL = "DELETE FROM alliance WHERE id='".$id."' LIMIT 1";
		$DB->query($SQL);	
	}
	
	function setAllianceLocation($PkID)
	{
		global $objComm,$DB;
		
		foreach($_REQUEST as $key => $value)
		{
			if(is_array($value))
			{
				if(substr($key,0,9) == 'location_')
				{
					$arrPost[substr($key,9)] = $value;
				}
			}
		}
		
		//echo "<pre>"; print_r($_REQUEST);
		
		$this->delAllianceLocation($PkID);
		
		#---------- SET CATEGORY ----------#

		foreach($_REQUEST as $key => $value)
		{
			if(is_array($value) && substr($key,0,strlen('location_category_')) == "location_category_")
			{
					$num = substr($key,-1);					
					$arrPost['category'][] = $value;
			}
		}
		
		//echo "<pre>"; print_r($arrPost); die(__FILE__."--".__LINE__);
		
		foreach($arrPost['address'] as $key => $value)
		{
			$address   	= $arrPost['address'][$key];
			$city 		= $arrPost['city'][$key];
			$state   	= $arrPost['state'][$key];
			$country   	= $arrPost['country'][$key];
			$zipcode   	= $arrPost['zipcode'][$key];
			$incharge   = $arrPost['incharge'][$key];
			$category   = $arrPost['category'][$key];
			
			if($address != '')
			{
				$arrInsert['alliance_id'] 	= $PkID;				
				$arrInsert['address'] 		= $address;
				$arrInsert['city'] 			= $city;
				$arrInsert['state'] 		= $state;
				$arrInsert['country'] 		= $country;
				$arrInsert['zipcode'] 		= $zipcode;
				$arrInsert['incharge_person'] = $incharge;
				$arrInsert['category'] 		= implode(",",$category);
			}
			
			if(count($arrInsert) > 0)
			{
				$DB->addNewRecord('alliance_location', $arrInsert, '');				
				$arrInsert = array();
			}
		}
	}
	
	function delAllianceLocation($allianceID)
	{
		global $DB;
		
		$SQL = "DELETE FROM alliance_location WHERE alliance_id='".$allianceID."'";
		$DB->query($SQL);	
	}
	
	function getAllianceLocationDetails($allianceID)
	{
		global $DB;
		
		$SQL = "SELECT * FROM alliance_location WHERE alliance_id='".$allianceID."'";	
		$row = $DB->fetchAll($SQL);
		
		return $row;
		
	}
	
}

?>