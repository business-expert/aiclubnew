<?php
include_once(dirname(__FILE__).'/bootstrap.php');

$SQL = "SELECT * FROM members WHERE activation='".$_REQUEST['code']."'";
$row = $DB->fetchOne($SQL);

if($row->id > 0)
{
	if($row->verification_attempt >= 3 )
	{
		$_SESSION['activation_error'] = $lang['account_suspend'];
		include_once(VIEWS. "/error/activation.php");
	}
	else if($row->verified == 'Y')
	{
		$objComm->redirect1("verify.php?model=verification&action=password&code=".$_REQUEST['code']);
	}
	else
		$objComm->redirect1("verify.php?model=verification&code=".$_REQUEST['code']);
}
else
{
	$_SESSION['activation_error'] = $lang['activation_link_expire'];
	include_once(VIEWS. "/error/activation.php");
}
?>