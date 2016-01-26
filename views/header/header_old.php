<!DOCTYPE html>
<html lang="en">
<head>
	<title>AI Club</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">

	<!-- The styles -->
	<link id="bs-css" href="<?=CSS?>bootstrap-cerulean.css" rel="stylesheet">
	<style type="text/css">
	  body { padding-bottom: 40px; }
	  .sidebar-nav { padding: 9px 0; }
	</style>

	<link href="<?=CSS?>bootstrap-responsive.css" rel="stylesheet">
	<link href="<?=CSS?>charisma-app.css" rel="stylesheet">
	<link href="<?=CSS?>jquery-ui-1.8.21.custom.css" rel="stylesheet">
	<link href='<?=CSS?>fullcalendar.css' rel='stylesheet'>
	<link href='<?=CSS?>fullcalendar.print.css' rel='stylesheet'  media='print'>
	<link href='<?=CSS?>chosen.css' rel='stylesheet'>
	<link href='<?=CSS?>uniform.default.css' rel='stylesheet'>
	<link href='<?=CSS?>colorbox.css' rel='stylesheet'>
	<link href='<?=CSS?>jquery.cleditor.css' rel='stylesheet'>
	<link href='<?=CSS?>jquery.noty.css' rel='stylesheet'>
	<link href='<?=CSS?>noty_theme_default.css' rel='stylesheet'>
	<link href='<?=CSS?>elfinder.min.css' rel='stylesheet'>
	<link href='<?=CSS?>elfinder.theme.css' rel='stylesheet'>
	<link href='<?=CSS?>jquery.iphone.toggle.css' rel='stylesheet'>
	<link href='<?=CSS?>opa-icons.css' rel='stylesheet'>
	<link href='<?=CSS?>uploadify.css' rel='stylesheet'>

	<!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
	  <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

	<!-- The fav icon -->
	<link rel="shortcut icon" href="img/favicon.ico">
    
    <!-- external javascript
	================================================== -->
<!-- Placed at the end of the document so the pages load faster -->

<!-- jQuery -->
<script src="<?=JS?>jquery-1.7.2.min.js"></script>
<!-- jQuery UI -->
<script src="<?=JS?>jquery-ui-1.8.21.custom.min.js"></script>
<!-- transition / effect library -->
<script src="<?=JS?>bootstrap-transition.js"></script>
<!-- alert enhancer library -->
<script src="<?=JS?>bootstrap-alert.js"></script>
<!-- modal / dialog library -->
<script src="<?=JS?>bootstrap-modal.js"></script>
<!-- custom dropdown library -->
<script src="<?=JS?>bootstrap-dropdown.js"></script>
<!-- scrolspy library -->
<script src="<?=JS?>bootstrap-scrollspy.js"></script>
<!-- library for creating tabs -->
<script src="<?=JS?>bootstrap-tab.js"></script>
<!-- library for advanced tooltip -->
<script src="<?=JS?>bootstrap-tooltip.js"></script>
<!-- popover effect library -->
<script src="<?=JS?>bootstrap-popover.js"></script>
<!-- button enhancer library -->
<script src="<?=JS?>bootstrap-button.js"></script>
<!-- accordion library (optional, not used in demo) -->
<script src="<?=JS?>bootstrap-collapse.js"></script>
<!-- carousel slideshow library (optional, not used in demo) -->
<script src="<?=JS?>bootstrap-carousel.js"></script>
<!-- autocomplete library -->
<script src="<?=JS?>bootstrap-typeahead.js"></script>
<!-- tour library -->
<script src="<?=JS?>bootstrap-tour.js"></script>
<!-- library for cookie management -->
<script src="<?=JS?>jquery.cookie.js"></script>
<!-- calander plugin -->
<script src='<?=JS?>fullcalendar.min.js'></script>
<!-- data table plugin -->
<script src='<?=JS?>jquery.dataTables.min.js'></script>

<!-- chart libraries start -->
<script src="<?=JS?>excanvas.js"></script>
<script src="<?=JS?>jquery.flot.min.js"></script>
<script src="<?=JS?>jquery.flot.pie.min.js"></script>
<script src="<?=JS?>jquery.flot.stack.js"></script>
<script src="<?=JS?>jquery.flot.resize.min.js"></script>
<!-- chart libraries end -->

<!-- select or dropdown enhancer -->
<script src="<?=JS?>jquery.chosen.min.js"></script>
<!-- checkbox, radio, and file input styler -->
<script src="<?=JS?>jquery.uniform.min.js"></script>
<!-- plugin for gallery image view -->
<script src="<?=JS?>jquery.colorbox.min.js"></script>
<!-- rich text editor library -->
<script src="<?=JS?>jquery.cleditor.min.js"></script>
<!-- notification plugin -->
<script src="<?=JS?>jquery.noty.js"></script>
<!-- file manager library -->
<script src="<?=JS?>jquery.elfinder.min.js"></script>
<!-- star rating plugin -->
<script src="<?=JS?>jquery.raty.min.js"></script>
<!-- for iOS style toggle switch -->
<script src="<?=JS?>jquery.iphone.toggle.js"></script>
<!-- autogrowing textarea plugin -->
<script src="<?=JS?>jquery.autogrow-textarea.js"></script>
<!-- multiple file upload plugin -->
<script src="<?=JS?>jquery.uploadify-3.1.min.js"></script>
<!-- history.js for cross-browser state change on ajax -->
<script src="<?=JS?>jquery.history.js"></script>
<!-- application script for validation -->
<script src="<?=JS?>jquery.bootstrap.validation.js"></script>
<!-- application script for Charisma demo -->
<script src="<?=JS?>charisma.js"></script>
		
</head>
<body>

<div class="navbar">
		<div class="navbar-inner">
			<div class="container-fluid">
				<a class="btn btn-navbar" data-toggle="collapse" data-target=".top-nav.nav-collapse,.sidebar-nav.nav-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</a>
				<a class="brand" href="index.php"> <img alt="AI Club" src="media/img/logo.png" /></a>
				<!-- user dropdown starts -->
                
                <?php 
					if($_SESSION['site']['ai_user'] != '' && $_REQUEST['model'] != 'verification' && $_REQUEST['code'] == '') 
					{ ?>
				<div class="btn-group pull-right" >
					<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
						<i class="icon-user"></i><span class="hidden-phone"> <?=$_SESSION['site']['ai_user'];?></span>
						<span class="caret"></span>
					</a>
					<ul class="dropdown-menu">
						<!--<li><a href="index.php?model=profile"><?=$lang['Profile']?></a></li>
						<li class="divider"></li>-->
						<li><a href="index.php?model=login&action=logout"><?=$lang['Logout']?></a></li>
					</ul>
				</div>
                
                <?php } ?>
                
                 <?php
							
					$arrQuery = explode("&",$_SERVER['QUERY_STRING']);
					
					foreach($arrQuery as $val)
					{
						$arrQ = explode("=",$val);
						
						if($arrQ[0] != 'lang')
							$arrFinal[$arrQ[0]] = $arrQ[1];
					}
					
					$URL = (count($arrFinal) > 0) ? "index.php?".http_build_query($arrFinal)."&lang=" : "index.php?lang=";

					$eng = ($langs == 'english') ?  'icon-ok' : '';
					$chn = ($langs == 'chines')  ?  'icon-ok' : '';					
				?>
                            
                <div class="btn-group pull-right" >
					<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
						<i class="icon-book"></i><span class="hidden-phone"> Language</span><span class="caret"></span>
					</a>
                    
                    <ul id="lang" class="dropdown-menu">
                      <li><a href="<?=$URL."english"?>" data-value="english"><i class="icon-blank <?=$eng?>"></i> English</a></li>
                      <li><a href="<?=$URL."chines"?>" data-value="chines"><i class="icon-blank <?=$chn?>"></i> Chines</a></li>
                    </ul>
				</div>
                
                <div class="top-nav nav-collapse">
				</div>
			</div>
		</div>
	</div>
    
<?php 

if($_SESSION['site']['ai_user'] != '' && $_REQUEST['model'] != 'verification' && $_REQUEST['code'] == '')
{ 

?>
<div class="container-fluid">
		<div class="row-fluid">
			<!-- left menu starts -->
			<?php include_once(VIEWS."/left/left.php"); ?>
			<!-- left menu ends -->
			<div id="content" class="span10">
			<!-- content starts -->
<?php } ?>