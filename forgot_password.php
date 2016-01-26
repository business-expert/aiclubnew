<?php
include_once(dirname(__FILE__).'/bootstrap.php');

$SQL = "SELECT * FROM members 
			WHERE activation='".$_REQUEST['sid']."' AND forgot_pass='Y'";
$row = $DB->fetchOne($SQL);

if($row->id > 0)
{
	$objComm->redirect1("verify.php?model=forgot&action=password&sid=".$_REQUEST['sid']);
}
else
{
	$_SESSION['activation_error'] = $lang['activation_link_expire'];
	include_once(VIEWS. "/error/activation.php");
}
?>