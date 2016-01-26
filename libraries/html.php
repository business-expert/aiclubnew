<?php


class html extends common
{
	function __construct() 
	{
		
	}
	
	function statusBasicCombo($id,$selVal)
	{
		global $lang; 
		
		$arrStatus = $this->getAllStatus();

		$select = "<select id='".$id."' name='".$id."' required>";	
		$arrOption[] = "<option value=''> -- ".$lang['SELECT']." -- </option>";

		foreach($arrStatus as $key => $value)
		{
			$selected = (strtoupper($selVal) == strtoupper($key)) ? "selected='selected'" : "" ;		
			$arrOption[] = "<option value='".$key."' ".$selected.">".$lang[$key]."</option>";	
		}
		
		return $select.implode(" ", $arrOption)."</select>";
		
	}
	
	
	function genderBasicCombo($id,$selVal, $extra='')
	{
		global $lang; 
		
		$arrGender = array("Male" => "M", "Female" => "F");

		$select = "<select required style='width:100px;' id='".$id."' name='".$id."' data-validation-required-message='Please select gender' $extra>";	
		$arrOption[] = "<option value=''> ".$lang['SELECT']." </option>";

		foreach($arrGender as $key => $value)
		{
			$selected = (strtoupper($selVal) == strtoupper($value)) ? "selected='selected'" : "" ;		
			$arrOption[] = "<option value='".$value."' ".$selected.">".$lang[$key]."</option>";	
		}
		
		return $select.implode(" ", $arrOption)."</select>";
		
	}
	
	function categoryBasicCombo($id,$selVal)
	{
		global $lang; 
		
		$arrStatus = $this->getAllCategory();

		$select = "<select id='".$id."' name='".$id."'>";	
		$arrOption[] = "<option value=''> -- ".$lang['SELECT']." -- </option>";

		foreach($arrStatus as $key => $value)
		{
			$selected = (strtoupper($selVal) == strtoupper($key)) ? "selected='selected'" : "" ;		
			$arrOption[] = "<option value='".$key."' ".$selected.">".$lang[$key]."</option>";	
		}
		
		return $select.implode(" ", $arrOption)."</select>";
		
	}
	
	function searchAgeCombo($id,$selVal)
	{
		$arrComparison = array("<=", ">=");

		$select = "<select  style='width:50px;' id='".$id."' name='".$id."'>";	

		foreach($arrComparison as $key => $value)
		{
			$selected = (strtoupper($selVal) == strtoupper($value)) ? "selected='selected'" : "" ;		
			$arrOption[] = "<option value='".$value."' ".$selected.">".$value."</option>";	
		}
		
		return $select.implode(" ", $arrOption)."</select>";
	}
	
	
	function basicDateCombo($arrName, $arrID, $arrVal, $extra='')
	{
		global $lang;
		
		if($arrID == '')
			$arrID = $arrName;
			
		if(!is_array($arrVal))
			$arrVal = explode("-",$arrVal);
			
		$selYear = "<select  style='width:70px;' id='".$arrID[0]."' name='".$arrName[0]."' $extra>";
		
		for($i = date('Y'); $i > 1940; $i--)
		{
			$selected = ($arrVal[0] == $i) ? "selected='selected'" : "" ;		
			$arrYearOption[] = "<option value='".$i."' ".$selected.">".$i."</option>";	
		}	
		
		$Year = $selYear.implode(" ", $arrYearOption)."</select>";
		
		#-------------------------------------------------------------------------------------------#
		
		$arrMonth = array( 1 => "January", 2 => "February", 3 => "March", 4 => "April",  5 => "May", 
						   6 => "June", 7 => "July", 8 => "August", 9 => "September", 10 => "October", 11 => "November",12 =>  "December");

		$selMonth = "<select  style='width:100px;' id='".$arrID[1]."' name='".$arrName[1]."' $extra>";
		
		foreach($arrMonth as $key => $value)
		{
			$selected = ((int)$arrVal[1] == $key) ? "selected='selected'" : "" ;		
			$arrMonthOption[] = "<option value='".$key."' ".$selected.">".$lang[$value]."</option>";	
		}	
		
		
		$Month = $selMonth.implode(" ", $arrMonthOption)."</select>";
		
		#-------------------------------------------------------------------------------------------#
		
		$selDate = "<select  style='width:50px;' id='".$arrID[2]."' name='".$arrName[2]."' $extra>";
		
		for($i = 1; $i <= 31; $i++)
		{
			$selected = ($arrVal[2] == $i) ? "selected='selected'" : "" ;		
			$arrDateOption[] = "<option value='".$i."' ".$selected.">".$i."</option>";	
		}	
		
		$Date = $selDate.implode(" ", $arrDateOption)."</select>";
		
		return $Year."&nbsp;&nbsp;".$Month."&nbsp;&nbsp;".$Date;
	}
	
	
	
	function basicTimeCombo($arrName, $arrID, $arrVal, $extra='')
	{
		global $lang;
		
		if($arrID == '')
			$arrID = $arrName;
			
		if(!is_array($arrVal))
			$arrVal = explode("-",$arrVal);
			
		$selHour = "<select  style='width:70px;' id='".$arrID[0]."' name='".$arrName[0]."' $extra>";
		
		for($i = 0; $i < 24; $i++)
		{
			$selected = ($arrVal[0] == $i) ? "selected='selected'" : "" ;		
			$arrHourOption[] = "<option value='".$i."' ".$selected.">".$i."</option>";	
		}	
		
		$Hour = $selHour.implode(" ", $arrHourOption)."</select>";
		
		#-------------------------------------------------------------------------------------------#
		
		$selMinute = "<select  style='width:50px;' id='".$arrID[1]."' name='".$arrName[1]."' $extra>";
		
		for($i = 0; $i <= 59; $i++)
		{
			$selected = ($arrVal[1] == $i) ? "selected='selected'" : "" ;		
			$arrMinuteOption[] = "<option value='".$i."' ".$selected.">".$i."</option>";	
		}	
		
		$Minute = $selMinute.implode(" ", $arrMinuteOption)."</select>";
		
		return $Hour."&nbsp;&nbsp;".$Minute;
	}
	
	function getUserRoleCombo($id,$selval)
	{
		global $lang;
		
		$arrRow = $this->getAllUserRole();
		
		$select      = "<select id='".$id."' name='".$id."'>";	
		$arrOption[] = "<option value=''> ".$lang['SELECT']." </option>";

		foreach($arrRow as $row)
		{
			$selected = ($selval == $row->id) ? "selected='selected'" : "" ;		
			$arrOption[] = "<option value='".$row->id."' ".$selected.">".ucfirst($row->user_type)."</option>";	
		}
		
		return $select.implode(" ", $arrOption)."</select>";
	}
	
	function roleStatusBasicCombo($id,$selVal)
	{
		global $lang;
		
		$arrStatus = $this->getRoleStatus();

		$select = "<select id='".$id."' name='".$id."'>";	
		$arrOption[] = "<option value=''> --  ".$lang['SELECT']." -- </option>";

		foreach($arrStatus as $key => $value)
		{
			$selected = (strtoupper($selVal) == strtoupper($key)) ? "selected='selected'" : "" ;		
			$arrOption[] = "<option value='".strtolower($key)."' ".$selected.">".$lang[$key]."</option>";	
		}
		
		return $select.implode(" ", $arrOption)."</select>";
		
	}
	
	
	function newsStatusCombo($id, $selVal, $extra='')
	{
		global $lang;
		
		$arrStatus = $this->getNewsStatus();

		$select = "<select id='".$id."' name='".$id."' $extra>";	
		$arrOption[] = "<option value=''> --  ".$lang['SELECT']." -- </option>";

		foreach($arrStatus as $key => $value)
		{
			$selected = (strtoupper($selVal) == strtoupper($key)) ? "selected='selected'" : "" ;		
			$arrOption[] = "<option value='".strtolower($key)."' ".$selected.">".$lang[$key]."</option>";	
		}
		
		return $select.implode(" ", $arrOption)."</select>";
	}
	
	
	function marrigeCombo($id,$selVal)
	{
		global $lang;
		
		$arrStatus = $this->getMarrageStatus();

		$select = "<select id='".$id."' name='".$id."'>";	
		$arrOption[] = "<option value=''> -- ".$lang['SELECT']." -- </option>";

		foreach($arrStatus as $key => $value)
		{
			$selected = (strtoupper($selVal) == strtoupper($key)) ? "selected='selected'" : "" ;		
			$arrOption[] = "<option value='".$key."' ".$selected.">".$lang[$key]."</option>";	
		}
		
		return $select.implode(" ", $arrOption)."</select>";
	}
	
	function educationCombo($id,$selVal)
	{
		global $lang;
		
		$arrStatus = $this->getEducationLevel();

		$select = "<select id='".$id."' name='".$id."'>";	
		$arrOption[] = "<option value=''> -- ".$lang['SELECT']." -- </option>";

		foreach($arrStatus as $key => $value)
		{
			$selected = (strtoupper($selVal) == strtoupper($key)) ? "selected='selected'" : "" ;		
			$arrOption[] = "<option value='".$key."' ".$selected.">".$lang[$key]."</option>";	
		}
		
		return $select.implode(" ", $arrOption)."</select>";
	}
	
	function creditCardExpiryCombo($selMonth, $selYear, $extra='')
	{
		global $lang;
			
		$selMonth = "<select style='width:60px;' id='exp_month' name='exp_month' $extra>";
		
		for($i = 1; $i <= 12; $i++)
		{
			$selected = ($selMonth == $i) ? "selected='selected'" : "" ;		
			$arrMonthOption[] = "<option value='".$i."' ".$selected.">".$i."</option>";	
		}	
		
		$Month = $selMonth.implode(" ", $arrMonthOption)."</select>";
		
		#-----------------------------------------------------------------------#
		
		$selYear = "<select style='width:80px;' id='exp_year' name='exp_year' $extra>";
		
		for($i = date("Y"); $i <= date("Y") + 10; $i++)
		{
			$selected = ($selYear == $i) ? "selected='selected'" : "" ;		
			$arrYearOption[] = "<option value='".$i."' ".$selected.">".$i."</option>";	
		}	
		
		$Year = $selYear.implode(" ", $arrYearOption)."</select>";
		
		return $Month."&nbsp;&nbsp;".$Year;
	}
	
	function creditCardTypeCombo($selTyle, $extra='')
	{
		global $lang;
		
		$arrCardType = array('Visa','MasterCard','Discover','American Express');			
		
		$selCard = "<select style='width:120px;' id='card_type' name='card_type' $extra>";
		
		foreach($arrCardType as $key => $card)
		{
			$selected = (strtolower($selTyle) == strtolower($card)) ? "selected='selected'" : "" ;		
			$arrCardOption[] = "<option value='".$card."' ".$selected.">".$card."</option>";	
		}	
		
		$Card = $selCard.implode(" ", $arrCardOption)."</select>";
		
		return $Card;
	}
	
	function getRegionSelectBox($id, $selval, $extra='')
	{
		global $lang, $objComm;
		
		$arrRegion = $objComm->getAllRegion();
		
		$selRegion = "<select id='".$id."' name='".$id."' $extra>";
		
		foreach($arrRegion as $key => $region)
		{
			$selected = (strtolower($selval) == strtolower($key)) ? "selected='selected'" : "" ;		
			$arrRegionOption[] = "<option value='".$key."' ".$selected.">".$region."</option>";	
		}	
		
		$Region = $selRegion.implode(" ", $arrRegionOption)."</select>";
		
		return $Region;			
	}
	
	function getDistrictSelectBox($id, $selval, $extra='')
	{
		global $lang, $objComm;
		
		$arrDistrict = $objComm->getAllDistrict();
		
		$selDistrict = "<select id='".$id."' name='".$id."' $extra>";
		
		foreach($arrDistrict as $key => $District)
		{
			$selected = (strtolower($selval) == strtolower($key)) ? "selected='selected'" : "" ;		
			$arrDistrictOption[] = "<option value='".$key."' ".$selected.">".$District."</option>";	
		}	
		
		$District = $selDistrict.implode(" ", $arrDistrictOption)."</select>";
		
		return $District;			
	}
	
	function radioBox($name, $id, $value, $text, $selValue, $extra)
	{
		$checked = (strtoupper($value) == strtoupper($selValue)) ? "checked='checked'" : "";
		
		$radio = '
		<label class="radio">
			<div class="radio" id="uniform-'.$name.'">
				<span class="">
					<input type="radio" '.$checked.' value="'.$value.'" id="'.$id.'" name="'.$name.'" style="opacity: 0;" '.$extra.'>
				</span>
			</div>'.$text.'</label>';
	  
	  return $radio;
	}
	
	
	function allMembersComboBox($id, $selval, $extra='')
	{
		global $objComm, $lang;
		
		$arrData = $objComm->getAllMembers();
		
		$strCombo = "<select id='".$id."' name='".$id."' $extra>";
		$arrOption[] = "<option value=''> -- ".$lang['SELECT']." -- </option>";
		
		foreach($arrData as $key => $row)
		{
			$selected = ($selval == $row->id) ? "selected='selected'" : "" ;		
			$arrOption[] = "<option value='".$row->id."' ".$selected.">".$row->fname."</option>";	
		}	
		
		$Combo = $strCombo.implode(" ", $arrOption)."</select>";
		
		return $Combo;			
	}
	
	
	function AdminStausNewsBox($id, $selval, $extra='')
	{
		global $objComm, $lang;
		
		$arrData = $objComm->getNewsAdminStatus();
		
		$strCombo    = "<select id='".$id."' name='".$id."' $extra>";
		$arrOption[] = "<option value=''> -- ".$lang['SELECT']." -- </option>";
		
		foreach($arrData as $key => $row)
		{
			$selected = ($selval == $key) ? "selected='selected'" : "" ;		
			$arrOption[] = "<option value='".$key."' ".$selected.">".$key."</option>";	
		}	
		
		$Combo = $strCombo.implode(" ", $arrOption)."</select>";
		
		return $Combo;			
	}
	
	
	
}	
?>