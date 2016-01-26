<?php

class database
{
	private $host;
	private $user;
	private $pass;
	private $database;	
	 
	public function __construct($host, $user, $pass, $database)
	{
		$this->host		=	$host;
		$this->user		=	$user;
		$this->pass		=	$pass;
		$this->database	=	$database;	
	}


	public function dbConnect($MultiDataBase=false)
	{
		global $QErrLog;
		
		$ln = mysql_pconnect("$this->host", "$this->user", "$this->pass") or 
				die('Mysql Connect Error : '. mysql_error() . $QErrLog->writeLog(__LINE__,__FILE__, $query." :: ".mysql_error(), "Host Connect Error"));
		
		mysql_select_db($this->database, $ln) or 
				die('Mysql Database Error: '. mysql_error(). $QErrLog->writeLog(__LINE__,__FILE__, $query." :: ".mysql_error(), "Database Connect Error"));
	
		return $ln;
	}
	
	
	function query($query, $link)
	{
		global $QErrLog,$ln;
		
		if(!is_resource($ln))
		{
			$ln = $this->dbConnect();
		}

		$result = mysql_query($query,$ln) or die("Query :" . $query . " -- " . mysql_error($ln). $QErrLog->writeLog(__LINE__,__FILE__, $query." :: ".mysql_error($ln), "Query Error"));
		
		
		return $result;
	}
	

	function fetchOne($query, $link)
	{
		global $ln;
		$result = $this->query($query, $link);
		
		$record = mysql_fetch_object($result);
		if(is_resource($ln))
			mysql_close($ln);
		return $record;
	}


	function fetchAll($query, $link)
	{
		global $ln;
		$row = array();
		
		$result =  $this->query($query, $link);
		
		while($record = mysql_fetch_object($result))
		{
			$row[] = $record;	
		}
		if(is_resource($ln))
			mysql_close($ln);
		return $row;
	}
	
	
	function totRecord($query, $link)
	{
		global $ln;
		$row = array();
		
		$result =  $this->query($query, $link);
		
		$total	=	mysql_num_rows($result);
		if(is_resource($ln))
			mysql_close($ln);
		return $total;
	}
	
	
	function addNewRecord($tableName, $arrInsertData, $link)
	{
		global $ln;
		$value = array();
		
		foreach($arrInsertData as $key => $value)
			$arrInsertData[$key] = mysql_escape_string($value);
		
		$keys		=	implode("`,`",array_keys($arrInsertData));
		$values		=	implode("','",array_values($arrInsertData));
		$values		=	str_replace("'NULL'","NULL",$values);

		$insertSQL	=	"INSERT INTO $tableName (`".$keys."`) VALUES ('".$values."');";
		
		$this->query($insertSQL, $link);		
		
		$out = mysql_insert_id($ln);
		if(is_resource($ln))
			mysql_close($ln);
		return $out;
	}
	
	
	function updateRecord($tableName, $arrUpdateData, $where, $link)
	{
		global $ln;
		$arrField = array();
		
		foreach($arrUpdateData as $key => $value)
			$arrField[] = "`".$key."` = '".mysql_escape_string($value)."'";
		
		$fields		=	@implode(", ", $arrField);
		$fields		=	str_replace("'NULL'","NULL",$fields);
		
		$updateSQL	=	"UPDATE $tableName SET ".$fields." WHERE $where LIMIT 1";
		
		$out = $this->query($updateSQL, $link);
		if(is_resource($ln))
			mysql_close($ln);
		return $out;
	}

	function __destruct()
	{
		global $ln;
		
		if(is_resource($ln))
			mysql_close($ln);
	}

}

?>