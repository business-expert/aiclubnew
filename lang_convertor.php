<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
error_reporting(1);
ini_set('error_reporting', E_ALL^E_NOTICE^E_WARNING);
#include_once(dirname(__FILE__).'/bootstrap.php');

$lang = array();
include(dirname(__FILE__)."/language/english/index.php");
$arrEngLang = $lang;

$lang = array();
include(dirname(__FILE__)."/language/chines/index.php");
$arrChinLang = $lang;

$str = '';

foreach($arrEngLang as $key => $value)
{
	if(trim($arrChinLang[$key]) == '')
	{
		$value = getResponse($value);
		
		if(strlen($value) < 100)
			$arrTranslated[] =  '$lang["'.$key.'"] = "'.$value.'"';
	}
	else
	{
		$arrTranslated[] =  '$lang["'.$key.'"] = "'.$arrChinLang[$key].'"';
	}
}



$fp = fopen($_SERVER['DOCUMENT_ROOT'].'/aiclub/language/chines/index1.txt');

if($fp)
{
	foreach($arrTranslated as $value){
		fwrite($fp,$value."\n")	;
	}
}
	

fclose($fp);

echo "<pre>"; print_r($arrTranslated);


function getResponse($text)
{
	echo "<br>".$url = "http://mymemory.translated.net/api/get?q=".urlencode($text)."&langpair=en|zh-CN";
	sleep(1);
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_HEADER, TRUE);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	$data = curl_exec($ch);
	curl_close($ch); 

  	$arrData = explode('charset=utf-8',$data);
	$arrFinal = json_decode(trim($arrData[1])); 
	
	return 	$arrFinal->responseData->translatedText;
}

?>