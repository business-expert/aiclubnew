<?php
include_once(dirname(__FILE__).'/bootstrap.php');

$model  = strtolower($_REQUEST['model']);
$action = strtolower($_REQUEST['action']);

$sessionUser = $_SESSION['site']['ai_user'];

if(($model == '' || $model == 'login') && $sessionUser != '')
{
	include_once(VIEWS ."/header/header.php");
	include_once(VIEWS. '/dashboard/dashboard.php');
	include_once(VIEWS ."/footer/footer.php");
}	
else
{
	if($model != '')
	{
		#echo "2";
		if(file_exists(VIEWS. "/".$model."/".$model.'.php'))
		{
			#echo "3";	
			include_once(VIEWS ."/header/header.php");
		
			if($action != '')
			{
				#echo "4";
				if(include_once(VIEWS. "/".$model."/".$action.'.php'))
				{
					#echo "5";
					include_once(VIEWS. "/".$model."/".$action.'.php');
				}
				else
				{
					#echo "6";						
					include_once(VIEWS. "/".$model."/".$model.'.php');
				}
			}
			else
			{
				#echo "7";
				include_once(VIEWS. "/".$model."/".$model.'.php');
			}
			
			include_once(VIEWS ."/footer/footer.php");
		}
		else
		{
			#echo "8";
			include_once(VIEWS. "/error/error.php");	
		}
	}
	else
	{
		#echo "10";
		include_once(VIEWS ."/header/header.php");
		include_once(VIEWS. '/home/home.php');
		include_once(VIEWS ."/footer/footer.php");
	}
}



?>