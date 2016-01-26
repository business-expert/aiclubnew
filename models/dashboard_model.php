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
	
	function getAllNews()
	{
		global $DB;

		$SQL = "SELECT * FROM news 
					WHERE admin_status='Approve' AND status='Active' 
						ORDER BY created_datetime DESC";
		
		$Records = $DB->fetchAll($SQL);
		
		return $Records;	
	}
	
	function displayNewsWidget()
	{
		$arrNews = $this->getAllNews();

		$strUL = '<ul id="ticker">';
		
		foreach($arrNews as $key => $row)
		{
			$arrLI[] = 	'<li>
							<div class="title"><a href="javascript:loadNews('.$row->id.');">'.$row->news_title.'</a></div>
							<div class="desc">'.substr($row->news_desc,0,150).'</div>
							<div class="date">-- '.date("Y-m-d",strtotime($row->created_datetime)).'</div>
					     </li>
						 ';
		}
		
		return $strUL.implode("",$arrLI)."</ul>";
	}
	
}
?>