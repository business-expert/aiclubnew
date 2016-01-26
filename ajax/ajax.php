<?php

if($_REQUEST['ajaxcall'] == true)
{

	$mod = $_REQUEST['mod'];
	
	if($mod != ''){
		if(function_exists($mod)){
			echo $mod(); die();
		}
	}
}	


function checkUniqEmail()
{
	global $DB, $objComm, $lang;

	$id = $_REQUEST['id'];
	
	if($id > 0)
		$arrWhere[] = "`id` NOT IN ('".$id."')";
		
	$arrWhere[] = "`email_address`='".$_REQUEST['email']."'";
		
	$SQL = "SELECT * FROM members ";
	
	if(count($arrWhere) > 0)
		$Where = " WHERE ".implode(" AND ", $arrWhere); 
		
	if($Where != '')	
		$SQL .=  $Where;	
		
	$row = $DB->fetchOne($SQL);		

	$response = ($row->id > 0) ? $lang['email_exists'] : '';
	
	return $response;	
}


function getNews()
{
	global $DB, $objComm, $lang;

	$SQL = "SELECT * FROM news WHERE id='".$_REQUEST['newsid']."'";
	$row = $DB->fetchOne($SQL);		

	return json_encode(array('title' => $row->news_title, 'desc' => $row->news_desc));
}

?>