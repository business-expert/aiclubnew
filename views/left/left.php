<!-- left menu starts -->

<?php

$arrLink['Main'] 		= array(
										'redeem' 	 => array('Redeem Report', 'index.php?model=redeem', 'icon-file'),
										'iq_test' 	 => array('IQ Test', 'index.php?model=users', 'icon-pencil'),
										'voucher' 	 => array('Voucher', 'index.php?model=users', 'icon-tasks'),
										'free_trial' => array('Free Trial', 'index.php?model=users', 'icon-leaf')
							 		);

$arrFinalNav[]  = '<li class="nav-header hidden-tablet"></li>
      				<li><a class="ajax-link" href="index.php?model=dashboard"><i class="icon-home"></i>
						<span class="hidden-tablet"> '.$lang['Dashboard'].'</span></a></li>';
 

foreach($arrLink as $key => $link)
{	
	 $strNav = '<li class="nav-header hidden-tablet"></li>';
	 $arrNav = array();

	 foreach($link as $title => $arrDetail)
	 {
		 $arrNav[] = '<li>
						<a class="ajax-link" href="'.$arrDetail['1'].'">
							<i class="'.$arrDetail['2'].'"></i><span class="hidden-tablet"> '.$lang[$arrDetail['0']].'</span>
						</a>
					</li>';	 
	 }
	 
	 if(count($arrNav) > 0)
	 {
		$arrFinalNav[] = $strNav.implode(" ",$arrNav);
	 }
}

$strNavigation = '';

if($_SESSION['site']['ai_user'] != '')
	$strNavigation = implode(" " ,$arrFinalNav);
	
?>

<!--<div class="span2 main-menu-span">
  <div class="well nav-collapse sidebar-nav">
    <ul class="nav nav-tabs nav-stacked main-menu">
    	<?=$strNavigation?>
    </ul>
  </div>
</div>-->
<!-- left menu ends -->

<noscript>
<div class="alert alert-block span10">
  <h4 class="alert-heading">Warning!</h4>
  <p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a> enabled to use this site.</p>
</div>
</noscript>
