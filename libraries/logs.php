<?php


class logs
{
	private $logFile;
	
	function __construct($fileName)
	{
		$this->logfile = LOG_PATH.$fileName;
		
		$this->validateLogPath();
	}
	
	function validateLogPath()
	{
		if(is_dir(LOG_PATH) == false)		
			@mkdir(LOG_PATH);
		
		@chmod(LOG_PATH,0777);
	}
	
	function writeLog($line, $file, $msg, $type='')
	{
		$fp = fopen($this->logfile,'a');
		
		$msg = str_replace(array("\n", "\r"), '', $msg);
		
		$msg  = preg_replace('!\s+!', ' ', $msg);

		fwrite($fp, date("Y-m-d H:i:s")." || ".basename($file)." || ".$line." || ".$type." -- ".$msg." \r\n");
		
		fclose($fp);		
	}	
}

?>