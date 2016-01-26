<?php include_once(CONTROLLERS_ADMIN."/".$_REQUEST['model'].".php");  ?>
	
	<div>
        <ul class="breadcrumb">
            <li><a href="#">Home</a> <span class="divider">/</span></li>
            <li><a href="#">Dashboard</a></li>
       </ul>
    </div>
    <div class="sortable row-fluid">
        <a data-rel="tooltip" class="well span3 top-block" href="index.php?model=members">
            <span class="icon32 icon-red icon-user"></span>
            <div><?=$lang['Total Members']?></div>
            <div><?=$totalMembers?></div>
            <!--<span class="notification">1</span>-->
        </a>

        <a data-rel="tooltip" class="well span3 top-block" href="index.php?model=alliance">
            <span class="icon32 icon-color icon-user"></span>
            <div><?=$lang['Total Alliances']?></div>
            <div><?=$totalAlliances?></div>
            <!--<span class="notification green">1</span>-->
        </a>
    </div>
    
			
					
			<!--<div class="row-fluid sortable">
				<div class="box span4">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-user"></i> Member Activity</h2>
						<div class="box-icon">
							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
							<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<div class="box-content">
							<ul class="dashboard-list">
								<li>
									<a href="#">
										<img class="dashboard-avatar" alt="ABC" src="http://www.gravatar.com/avatar/46056f772bde7c536e2086004e300a04.png?s=50"></a>
										<strong>Name:</strong> <a href="#">ABC
									</a><br>
									<strong>Since:</strong> 17/05/2012<br>
									<strong>Status:</strong> <span class="label label-success">Approved</span>                                  
								</li>
								<li>
									<a href="#">
										<img class="dashboard-avatar" alt="PQR" src="http://www.gravatar.com/avatar/46056f772bde7c536e2086004e300a04.png?s=50"></a>
										<strong>Name:</strong> <a href="#">PQR
									</a><br>
									<strong>Since:</strong> 17/05/2012<br>
									<strong>Status:</strong> <span class="label label-warning">Pending</span>                                 
								</li>
								<li>
									<a href="#">
										<img class="dashboard-avatar" alt="XYZ" src="http://www.gravatar.com/avatar/46056f772bde7c536e2086004e300a04.png?s=50"></a>
										<strong>Name:</strong> <a href="#">XYZ
									</a><br>
									<strong>Since:</strong> 25/05/2012<br>
									<strong>Status:</strong> <span class="label label-important">Pending</span>                                  
								</li>
								<li>
									<a href="#">
										<img class="dashboard-avatar" alt="DEF" src="http://www.gravatar.com/avatar/46056f772bde7c536e2086004e300a04.png?s=50"></a>
										<strong>Name:</strong> <a href="#">DEF
									</a><br>
									<strong>Since:</strong> 17/05/2012<br>
									<strong>Status:</strong> <span class="label label-info">Pending</span>                                  
								</li>
							</ul>
						</div>
					</div>
				</div>
                
                <div class="box span4">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-user"></i> Alliance Activity</h2>
						<div class="box-icon">
							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
							<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<div class="box-content">
							<ul class="dashboard-list">
								<li>
									<a href="#">
										<img class="dashboard-avatar" alt="ABC" src="http://www.gravatar.com/avatar/46056f772bde7c536e2086004e300a04.png?s=50"></a>
										<strong>Name:</strong> <a href="#">ABC
									</a><br>
									<strong>Since:</strong> 17/05/2012<br>
									<strong>Status:</strong> <span class="label label-success">Approved</span>                                  
								</li>
								<li>
									<a href="#">
										<img class="dashboard-avatar" alt="PQR" src="http://www.gravatar.com/avatar/46056f772bde7c536e2086004e300a04.png?s=50"></a>
										<strong>Name:</strong> <a href="#">PQR
									</a><br>
									<strong>Since:</strong> 17/05/2012<br>
									<strong>Status:</strong> <span class="label label-warning">Pending</span>                                 
								</li>
								<li>
									<a href="#">
										<img class="dashboard-avatar" alt="XYZ" src="http://www.gravatar.com/avatar/46056f772bde7c536e2086004e300a04.png?s=50"></a>
										<strong>Name:</strong> <a href="#">XYZ
									</a><br>
									<strong>Since:</strong> 25/05/2012<br>
									<strong>Status:</strong> <span class="label label-important">Pending</span>                                  
								</li>
								<li>
									<a href="#">
										<img class="dashboard-avatar" alt="DEF" src="http://www.gravatar.com/avatar/46056f772bde7c536e2086004e300a04.png?s=50"></a>
										<strong>Name:</strong> <a href="#">DEF
									</a><br>
									<strong>Since:</strong> 17/05/2012<br>
									<strong>Status:</strong> <span class="label label-info">Pending</span>                                  
								</li>
							</ul>
						</div>
					</div>
				</div>

			</div>-->
            
            <!--/row-->

			<!--/row-->
					<!-- content ends -->
			</div><!--/#content.span10-->
				</div><!--/fluid-row-->
				
		<hr>

		<div class="modal hide fade" id="myModal">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">×</button>
				<h3>Settings</h3>
			</div>
			<div class="modal-body">
				<p>Here settings can be configured...</p>
			</div>
			<div class="modal-footer">
				<a href="#" class="btn" data-dismiss="modal">Close</a>
				<a href="#" class="btn btn-primary">Save changes</a>
			</div>
		</div>
