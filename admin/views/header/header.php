<div class="navbar">
		<div class="navbar-inner">
			<div class="container-fluid">
				<a class="btn btn-navbar" data-toggle="collapse" data-target=".top-nav.nav-collapse,.sidebar-nav.nav-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</a>
				<a class="brand" href="index.php"> <img alt="AI Club" src="media/img/logo.png" /></a>
				
				<!-- theme selector starts -->
				<!--<div class="btn-group pull-right theme-container" >
					<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
						<i class="icon-tint"></i><span class="hidden-phone"> Change Theme / Skin</span>
						<span class="caret"></span>
					</a>
					<ul class="dropdown-menu" id="themes">
						<li><a data-value="classic" href="#"><i class="icon-blank"></i> Classic</a></li>
						<li><a data-value="cerulean" href="#"><i class="icon-blank"></i> Cerulean</a></li>
						<li><a data-value="cyborg" href="#"><i class="icon-blank"></i> Cyborg</a></li>
						<li><a data-value="redy" href="#"><i class="icon-blank"></i> Redy</a></li>
						<li><a data-value="journal" href="#"><i class="icon-blank"></i> Journal</a></li>
						<li><a data-value="simplex" href="#"><i class="icon-blank"></i> Simplex</a></li>
						<li><a data-value="slate" href="#"><i class="icon-blank"></i> Slate</a></li>
						<li><a data-value="spacelab" href="#"><i class="icon-blank"></i> Spacelab</a></li>
						<li><a data-value="united" href="#"><i class="icon-blank"></i> United</a></li>
					</ul>
				</div>-->
				<!-- theme selector ends -->
				
				<!-- user dropdown starts -->
				<div class="btn-group pull-right" >
					<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
						<i class="icon-user"></i><span class="hidden-phone"> <?=$_SESSION['admin']['ai_user']. "  ( ".ucfirst($_SESSION['admin']['ai_role']->user_type)." ) ";?></span>
						<span class="caret"></span>
					</a>
					<ul class="dropdown-menu">
						<li><a href="#">Profile</a></li>
						<li class="divider"></li>
						<li><a href="index.php?model=login&action=logout">Logout</a></li>
					</ul>
				</div>
				<!-- user dropdown ends -->
				
				<!--<div class="top-nav nav-collapse">
					<ul class="nav">
						<li><a href="index.php">Visit Site</a></li>
						<li>
							<form class="navbar-search pull-left">
								<input placeholder="Search" class="search-query span2" name="query" type="text">
							</form>
						</li>
					</ul>
				</div>--><!--/.nav-collapse -->
                 <?php
							
					$model  = $_REQUEST['model'];
					$action = $_REQUEST['action'];
					$pkid   = $_REQUEST['id'];
					$URL    = "index.php?model=".$model."&action=".$action."&id=".$pkid."&lang=";

					$eng = ($langs == 'english') ?  'icon-ok' : '';
					$chn = ($langs == 'chines') ?  'icon-ok' : '';					
				?>
                            
                <div class="btn-group pull-right" >
					<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
						<i class="icon-book"></i><span class="hidden-phone"> Language</span>
						<span class="caret"></span>
					</a>
                    
					  <ul id="lang" class="dropdown-menu">
                            <li><a href="<?=$URL."english"?>" data-value="english"><i class="icon-blank <?=$eng?>"></i> English</a></li>
                            <li><a href="<?=$URL."chines"?>" data-value="chines"><i class="icon-blank <?=$chn?>"></i> Chines</a></li>
                        </ul>
				</div>
                
                <div class="top-nav nav-collapse">
					<ul class="nav">
						<li><a href="index.php">Visit Site</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
  
  <div class="container-fluid">
		<div class="row-fluid">
			<!-- left menu starts -->
			<?php include_once(VIEWS_ADMIN."/left/left.php"); ?>
			<!-- left menu ends -->
			<div id="content" class="span10">
			<!-- content starts -->
			  
            