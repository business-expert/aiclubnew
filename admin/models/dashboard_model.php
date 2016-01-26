<?php


class dashboard
{
	function __construct() 
	{
		
	}
	
	function getTotalMembers()
	{
		global $DB;

		$SQL = "SELECT count(*) as total FROM members";
		
		$Records = $DB->fetchOne($SQL);
		
		return $Records->total;
	}
	
	function getTotalAlliances()
	{
		global $DB;

		$SQL = "SELECT count(*) as total FROM alliance";
		
		$Records = $DB->fetchOne($SQL);
		
		return $Records->total;
		
	}
	
}
?>