<?php

if(isset($_REQUEST['lang']))
{
	$langs = $_REQUEST['lang'];
	$_SESSION['ai_session_lang'] = $langs;
	setcookie('ai_session_lang', $langs, time() + (3600 * 24 * 30));
}
else if(isSet($_SESSION['ai_session_lang']))
{
	$langs = $_SESSION['ai_session_lang'];
}
else if(isSet($_COOKIE['ai_session_lang']))
{
	$langs = $_COOKIE['ai_session_lang'];
}
else
{
	$langs = 'english';
}

//$langs = 'chines';
$langs = 'english';

include_once($_SERVER['DOCUMENT_ROOT'].'/aiclub/language/'.$langs.'/index.php');

?>