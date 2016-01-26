<?php include_once(MODELS."/".$model."_model.php"); 

$objComm->checkSiteSession();

$objDash = new dashboard();

$totalMembers   = $objDash->getTotalMembers();
$totalAlliances = $objDash->getTotalAlliances();
$NewsWidget = $objDash->displayNewsWidget();


?>


