<?php

class common
{
	function __construct() 
	{
		
	}
	
	
	function membershipAmount()
	{
		$arrMembership = array('IQ' => 4300, 'MITS' => 2800, 'BP' => 299);	
		
		return $arrMembership;
	}
	
	function membershipItemName()
	{
		$arrMembership = array( 'IQ'   => 'AI Club Upgraded Preliminary Membership (IQ Test Edition)', 
								'MITS' => 'AI Club Upgraded Preliminary Membership (Multiple Intelligence Talent Assesment Edition', 
								'BP'   => 'AI Club Basic Preliminary Membership');	
		
		return $arrMembership;
	}
	
	function membershipImage()
	{
		$arrMembership = array('IQ' => "planning3.png", 'MITS' => "planning2.png", 'BP' => "planning1.png");	
		
		foreach($arrMembership as $key => $value)
		{
			$arrImage[$key]	 = "<img src='".IMAGES."/".$value."' style='width:120px;height:100px;'>";
		}
		
		return $arrImage;
	}
	
	
	function getMarrageStatus()
	{
		$arrMarrage = array(
							'Single' 	=> 'Single', 
							'Married' 	=> 'Married',
							'Widowed' 	=> 'Widowed'
				  		  );
		
		return $arrMarrage;
	}


	function getEducationLevel()
	{
		$arrEducation = array(
								'Graduate' 	=> 'Graduate', 
								'Post Graduate' => 'Post Graduate',
								'Other' 	=> 'Other'
				  		  );
		
		return $arrEducation;
	}
	
	
	function getRoleStatus()
	{
		$arrStatus = array(
							'Active' 	=> 'label-success', 
							'Inactive' 	=> 'label-warning',
							'Block' 	=> 'label-inverse'
				  		  );
		
		return $arrStatus;
	}
	
	function getNewsStatus()
	{
		$arrStatus = array(
							'Active' 	=> 'label-success', 
							'Inactive' 	=> 'label-warning',
							'Publish' 	=> 'label-inverse'
				  		  );
		
		return $arrStatus;
	}
	
	function getNewsAdminStatus()
	{
		$arrStatus = array(
							'Pending' 	=> 'label-warning', 
							'Approve' 	=> 'label-success',
							'Disapprove'=> 'label-inverse'
				  		  );
		
		return $arrStatus;
	}
	
	function getDefaultAccessModels()
	{
		$arrModel = array("dashboard","login");
		
		return $arrModel;
		
		
	}
	
	function getAllStatus()
	{
		$arrStatus = array(
							'Active' 	=> 'label-success', 
							'Suspend' 	=> 'label-warning',
							'Block' 	=> 'label-inverse',
							'Resume' 	=> 'label-warning',
							'Enquiry' 	=> 'label-important',
							'Pending' 	=> 'label-important',
							'Inactive'	=> 'label-important'
				  		  );
		
		return $arrStatus;
	}
	
	function getAllCategory()
	{
		$arrCategory = array(
							'Art' 		=> 'Art', 
							'Music' 	=> 'Music',
							'Language' 	=> 'Language',
							'Sports' 	=> 'Sports',
				  		  );
		
		return $arrCategory;
	}
	
	function GenderList()
	{
		$arrGender = array('M' => 'Male', 'F' => 'Female');
		
		return $arrGender;
	}
	
	function setTableField()
	{
		$arrInputData	=	$_REQUEST;	

		foreach($arrInputData as $key => $value)
		{
			if(substr($key,0,5) == 'data_')
			{
				$key =	substr($key,5);
				$arrField[$key] = $value;
			}	
		}
		
		return $arrField;
	}
	
	
	function redirect($URL)
	{
		$SitePath = SITE_PATH_ADMIN; 

		if (!headers_sent()) 
		{
			header("Location: ".$SitePath."/".$URL);
			exit();
		}
		else 
		{
	        echo '<script type="text/javascript">';
	        echo 'window.location.href="'.$SitePath."/".$URL.'";';
	        echo '</script>';
			die();
		 }
	}
	
	function redirect1($URL)
	{
		$SitePath = SITE_PATH ; 

		if (!headers_sent()) 
		{
			header("Location: ".$SitePath."/".$URL);
			exit();
		}
		else 
		{
	        echo '<script type="text/javascript">';
	        echo 'window.location.href="'.$SitePath."/".$URL.'";';
	        echo '</script>';
			die();
		 }
	}
	
	function getSessionMessage($name)
	{
		$arrMsg = array(	'error' 	=> $name."_error",
							'success' 	=> $name."_success",
							'info' 		=> $name."_info",
							'block' 	=> $name."_block ");
							
		foreach($arrMsg as $key => $value)
		{
			if($_SESSION[$value] != '')
			{
				$messageType = $key;
				break;	
			}
		}

		$msg = $this->getSession($value);
		return $this->getMessage($messageType, $name, $msg);
	}
	
	
	function setSession($session_name,$value)
	{
		$_SESSION[$session_name] = $value;
	}
	

	function getSession($session_name)
	{
		$value = $_SESSION[$session_name];
		
		return $value;
	}
	
	function getMessage($errtype='info', $name, $msg)
	{
		global $lang;
		
		$message = '';
		$arrMsg = array(	'error' 	=> 'alert-error',
							'success' 	=> 'alert-success',
							'info' 		=> 'alert-info',
							'block'		=> 'alert-block');
		
		if($msg != '')
		{
			if($lang[$msg] == '')
				$lang[$msg] = $msg;
				
			$message = '<div class="alert '.$arrMsg[$errtype].'">'.$lang[$msg].'</div>';
		}

		$_SESSION[$name."_".$errtype] = '';
		unset($_SESSION[$name."_".$errtype]);
		
		return $message;
	}
	
	function getYearFromCombo($arrData, $Prefix = 'date_', $suffix = '')
	{
		$Year = $arrData[$Prefix.'year'.$suffix];
		$Month = $arrData[$Prefix.'month'.$suffix];
		$Date = $arrData[$Prefix.'date'.$suffix];
		
		return $Year."-".$Month."-".$Date;
	}
	
	
	function getAllUserRole()
	{
		global $DB;
		
		$SQL = "SELECT * FROM user_role";	
		$row = $DB->fetchAll($SQL);
		
		return $row;
	}
	
	function getUserRole($id)
	{
		global $DB;
		
		$SQL = "SELECT * FROM user_role where id='$id'";	
		$row = $DB->fetchOne($SQL);
		
		return $row;
	}
	
	function getModuleProperty($id)
	{
		global $DB;
		
		$SQL = "SELECT * FROM module_access_property WHERE id='".$id."'";	
		$row = $DB->fetchOne($SQL);
		
		$arrRow = array($row->access_1, $row->access_2, $row->access_3, $row->access_4, $row->access_5,$row->access_6);
		
		return $arrRow;
	}
	
	function getModulePropertyDetails($modulename)
	{
		global $DB;
		
		$modulename = ucfirst(strtolower($modulename));
		
		$SQL = "SELECT * FROM module_access_property WHERE module_name='".$modulename."'";
		$row = $DB->fetchOne($SQL);
		
		return $row;
	}
	
	function checkAccessModule($model, $action)
	{
		$arrDefaultModel = $this->getDefaultAccessModels();
		
		$action = ($action == '') ? 'list' : strtolower($action) ;
		
		$_SESSION['ai_access'] = 'N';	

		if($_SESSION['admin']['ai_role']->id > 0)
		{
			$arrModule = $_SESSION['admin']['ai_access'][strtolower($model)];
			
			if(!in_array($model,$arrDefaultModel))
			{
				if(in_array($action, $arrModule))
					$_SESSION['ai_access'] = 'Y';	
				else
					$_SESSION['ai_access'] = 'N';	
			}
			else
				$_SESSION['ai_access'] = 'Y';	
		}
		
		if($model == '')
			$_SESSION['ai_access'] = 'Y';	
		
		# for admin user
		if($_SESSION['admin']['ai_role']->id == 1)
			$_SESSION['ai_access'] = 'Y';	

	}
	
	function redirectFromUnauthorizePage()
	{

		if($_SESSION['ai_access'] == 'N' && $_SESSION['admin']['ai_role']->id > 0)
		{
			 include_once(VIEWS. "/error/denied.php");
		}
	}
	
	function generateRandomString($length = 10) 
	{
    	$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $randomString = '';
		
	    for ($i = 0; $i < $length; $i++) 
		{
        	$randomString .= $characters[rand(0, strlen($characters) - 1)];
	    }
    	
		return $randomString;
	}	
	
	function getAllRegion()
	{
		 $arrRegion = array( "i" => "香港島",
							 "k" => "九龍",
							 "n" => "新界/離島",
							 "o" => "其他");
							 
		return $arrRegion;					 
	}
	
	
	function getAllDistrict()
	{
		$arrDistrict = array(	"Aberdeen/Ap Lei Chau|i" => "香港仔/鴨脷洲",
								"Causeway Bay|i" => "銅鑼灣",
								"Central/Sheung Wan|i" => "中環/上環",
								"Chai Wan|i" => "柴灣",
								"Happy Valley/Wong Nai Chung|i" => "跑馬地/黃泥涌",
								"Island South|i" => "南區",
								"Kennedy Town/Sai Ying Pun|i" => "堅尼地城/西營盤",
								"Mid-Levels|i" => "半山",
								"North Point|i" => "北角",
								"Pokfulam|i" => "薄扶林",
								"Quarry Bay|i" => "鰂魚涌",
								"Sai Wan Ho|i" => "西灣河",
								"Shaukeiwan|i" => "筲箕灣",
								"Tai Hang/JardineLookout|i" => "大坑/渣甸山",
								"The Peak|i" => "山頂",
								"Wanchai|i" => "灣仔",
								"Wong Chuk Hang|i" => "黃竹坑",
								"Cheung Sha Wan/Laichikok|k" => "長沙灣/荔枝角",
								"Diamond Hill|k" => "鑽石山",
								"Hung Hom|k" => "紅磡",
								"Kowloon Bay|k" => "九龍灣",
								"Kowloon City|k" => "九龍城",
								"Kowloon Tong|k" => "九龍塘",
								"Kwun Tong/Sau Mau Ping|k" => "觀塘/秀茂坪",
								"Lam Tin|k" => "藍田",
								"Mongkok/Ho Man Tin|k" => "旺角/何文田",
								"Ngau Chi Wan/Choi Hung|k" => "牛池灣/彩虹",
								"Ngau Tau Kok|k" => "牛頭角",
								"San Po Kong/Tsz Wan Shan|k" => "新蒲崗/慈雲山",
								"Shamshuipo|k" => "深水埗",
								"Shek Kip Mei/Yau Yat Chuen|k" => "石硤尾/又一村",
								"Tai Kok Tsui|k" => "大角咀",
								"Tokwawan|k" => "土瓜灣",
								"Tsimshatsui|k" => "尖沙咀",
								"Wong Tai Sin/Wan Tau Hom|k" => "黃大仙/橫頭磡",
								"Yau Tong/Cha Kwo Ling|k" => "油塘/茶果嶺",
								"Yaumatei|k" => "油麻地",
								"Fanling|n" => "粉嶺",
								"Kwai Chung|n" => "葵涌",
								"Lai King|n" => "荔景",
								"Lantau/Outlying Islands|n" => "大嶼山/離島",
								"Ma On Shan|n" => "馬鞍山",
								"Sai Kung/Clearwater Bay|n" => "西貢/清水灣",
								"Sham Tseng/Tsing Lung Tau|n" => "深井/青龍頭",
								"Shatin|n" => "沙田",
								"Sheung Shui|n" => "上水",
								"Tai Po|n" => "大埔",
								"Tseung Kwan O|n" => "將軍澳",
								"Tsing Yi|n" => "青衣",
								"Tsuen Wan|n" => "荃灣",
								"Tuen Mun|n" => "屯門",
								"Yuen Long/Tin Shui Wai|n" => "元朗/天水圍",
								"o|o" => "其他");
								
		return $arrDistrict;								
	}
	
	
	function checkSiteSession()
	{
		if($_SESSION['site']['ai_user'] == '')
		{
			$this->redirect1("index.php");	
		}
	}
	
	function getMemberBasedOnID($id, $field='')
	{
		global $DB;
		
		$SQL = "SELECT * FROM members where id='$id'";	
		$row = $DB->fetchOne($SQL);
		
		if($field == '')
			return $row;
		else	
			return $row->$field;
	}
	
	function getAllMembers()
	{
		global $DB;
		
		$SQL = "SELECT * FROM members WHERE status='Active'";	
		$row = $DB->fetchAll($SQL);
		
		return $row;
	}
}

?>