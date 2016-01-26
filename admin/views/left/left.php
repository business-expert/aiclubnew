<!-- left menu starts -->
<?php

//$arrLink['Main'] 			= array('dashboard' => array('Dashboard', 'index.php?model=dashboard', 'icon-home'));
$arrLink['Members Section'] = array('members' 	=> array('Members', 'index.php?model=members', 'icon-user'),
									'redeem' 	=> array('Redeem Report', 'index.php?model=redeem', ' icon-gift'),
									'iq_test' 	=> array('IQ Test', 'index.php?model=iq_test', ' icon-eye-open'),
									'news' 		=> array('News', 'index.php?model=news', ' icon-list-alt'));
									
$arrLink['Alliance Section']= array('alliances' => array('Alliances', 'index.php?model=alliance', 'icon-user'));

$arrLink['Settings'] 		= array(  'users' 	  => array('User Type', 'index.php?model=users', 'icon-user'),
									  'usersrole' => array('Users Role', 'index.php?model=usersrole', 'icon-cog'));

$arrFinalNav[]  = '<li class="nav-header hidden-tablet">'.$lang['Main'].'</li>
      				<li><a class="ajax-link" href="index.php?model=dashboard"><i class="icon-home"></i>
						<span class="hidden-tablet"> '.$lang['Dashboard'].'</span></a></li>';
 
 foreach($arrLink as $key => $link)
{	
	 $strNav = '<li class="nav-header hidden-tablet">'.$lang[$key].'</li>';
	 $arrNav = array();

	 foreach($link as $title => $arrDetail)
	 {
		if($_SESSION['admin']['ai_role']->id == 1)
		{
			 $arrNav[] = '<li>
	 						<a class="ajax-link" href="'.$arrDetail['1'].'">
								<i class="'.$arrDetail['2'].'"></i><span class="hidden-tablet"> '.$lang[$arrDetail['0']].'</span>
							</a>
						</li>';	 
		}
		else
		{
			if(in_array($title, array_keys($_SESSION['admin']['ai_access'])))
			{
				 $arrNav[] = '<li>
								<a class="ajax-link" href="'.$arrDetail['1'].'">
									<i class="'.$arrDetail['2'].'"></i><span class="hidden-tablet"> '.$lang[$arrDetail['0']].'</span>
								</a>
							</li>';	 
			}
		}
	 }
	 
	 if(count($arrNav) > 0)
	 {
		$arrFinalNav[] = $strNav.implode(" ",$arrNav);
	 }
}

$strNavigation = '';

if($_SESSION['admin']['ai_user'] != '' && $_SESSION['admin']['ai_role']->id > 0)
	$strNavigation = implode(" " ,$arrFinalNav);
?>

<div class="span2 main-menu-span">
  <div class="well nav-collapse sidebar-nav">
    <ul class="nav nav-tabs nav-stacked main-menu">
    	<?=$strNavigation?>
     <!-- <li class="nav-header hidden-tablet">Main</li>
      <li><a class="ajax-link" href="index.php?model=dashboard"><i class="icon-home"></i><span class="hidden-tablet"> Dashboard</span></a></li>

      <li class="nav-header hidden-tablet">Members Section</li>
	  <li><a class="ajax-link" href="index.php?model=members"><i class="icon-user"></i><span class="hidden-tablet"> Members</span></a></li>
      <li class="nav-header hidden-tablet">Alliance Section</li>
	  <li><a class="ajax-link" href="index.php?model=alliance"><i class="icon-user"></i><span class="hidden-tablet"> Alliances</span></a></li>
      
       <li class="nav-header hidden-tablet">Settings</li>
	  <li><a class="ajax-link" href="index.php?model=users"><i class="icon-user"></i><span class="hidden-tablet"> User Type</span></a></li>       
	  <li><a class="ajax-link" href="index.php?model=usersrole"><i class="icon-cog"></i><span class="hidden-tablet"> Users Role</span></a></li>-->
      
     <!-- <li class="nav-header hidden-tablet">Others Section</li>
      <li><a class="ajax-link" href="#"><i class="icon-user"></i><span class="hidden-tablet"> Enrollment</span></a></li>
      <li><a class="ajax-link" href="#"><i class="icon-user"></i><span class="hidden-tablet"> Bonus Point</span></a></li>
      <li><a class="ajax-link" href="#"><i class="icon-user"></i><span class="hidden-tablet"> Voucher</span></a></li>
      <li><a class="ajax-link" href="#"><i class="icon-user"></i><span class="hidden-tablet"> Event</span></a></li>
      <li><a class="ajax-link" href="#"><i class="icon-user"></i><span class="hidden-tablet"> News</span></a></li>
      <li><a class="ajax-link" href="#"><i class="icon-user"></i><span class="hidden-tablet"> Annoucement</span></a></li>      
      <li><a class="ajax-link" href="ui.html"><i class="icon-eye-open"></i><span class="hidden-tablet"> UI Features</span></a></li>
      <li><a class="ajax-link" href="form.html"><i class="icon-edit"></i><span class="hidden-tablet"> Forms</span></a></li>
      <li><a class="ajax-link" href="chart.html"><i class="icon-list-alt"></i><span class="hidden-tablet"> Charts</span></a></li>
      <li><a class="ajax-link" href="typography.html"><i class="icon-font"></i><span class="hidden-tablet"> Typography</span></a></li>
      <li><a class="ajax-link" href="gallery.html"><i class="icon-picture"></i><span class="hidden-tablet"> Gallery</span></a></li>
      <li class="nav-header hidden-tablet">Sample Section</li>
      <li><a class="ajax-link" href="table.html"><i class="icon-align-justify"></i><span class="hidden-tablet"> Tables</span></a></li>
      <li><a class="ajax-link" href="calendar.html"><i class="icon-calendar"></i><span class="hidden-tablet"> Calendar</span></a></li>
      <li><a class="ajax-link" href="grid.html"><i class="icon-th"></i><span class="hidden-tablet"> Grid</span></a></li>
      <li><a class="ajax-link" href="file-manager.html"><i class="icon-folder-open"></i><span class="hidden-tablet"> File Manager</span></a></li>
      <li><a href="tour.html"><i class="icon-globe"></i><span class="hidden-tablet"> Tour</span></a></li>
      <li><a class="ajax-link" href="icon.html"><i class="icon-star"></i><span class="hidden-tablet"> Icons</span></a></li>
      <li><a href="error.html"><i class="icon-ban-circle"></i><span class="hidden-tablet"> Error Page</span></a></li>
      <li><a href="login.html"><i class="icon-lock"></i><span class="hidden-tablet"> Login Page</span></a></li>-->
    </ul>
    <!--<label id="for-is-ajax" class="hidden-tablet" for="is-ajax">
      <input id="is-ajax" type="checkbox">
      Ajax on menu</label>-->
  </div>
  <!--/.well --> 
</div>
<!--/span--> 
<!-- left menu ends -->

<noscript>
<div class="alert alert-block span10">
  <h4 class="alert-heading">Warning!</h4>
  <p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a> enabled to use this site.</p>
</div>
</noscript>
