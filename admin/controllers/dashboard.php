<?php include_once(MODELS_ADMIN."/".$model."_model.php"); 

$objDash = new dashboard();

$totalMembers   = $objDash->getTotalMembers();
$totalAlliances = $objDash->getTotalAlliances();

?>


