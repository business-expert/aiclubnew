<?php 
include_once(CONTROLLERS_ADMIN."/".$_REQUEST['model'].".php"); 

$msg = $objComm->getSessionMessage('news');

?>
<div>
   <ul class="breadcrumb">
        <li><a href="#"><?=$lang['Settings']?></a> <span class="divider">/</span></li>
        <li><a href="index.php?model=users"><?=$lang['News']?></a><span class="divider">/</span></li>        
        <li><a href="#"><?=$lang['View News']?></a></li>
   </ul>
</div>
<div class="row-fluid sortable">
  <div class="box span12">
    <div class="box-header well" data-original-title>
      <h2><i class="icon-user"></i> <?=$lang['News']?></h2>
      <div class="box-icon"></div>
    </div>
    <div class="box-content">
      <div class="box-content">
	    <?=$msg?>
        <form class="form-horizontal" method="post" action="index.php">
          <fieldset>
            <div class="control-group">
              <label class="control-label" for="data_news_title"><?=$lang['News Title']?></label>
              <div class="controls">
              <span class="input-xlarge uneditable-input"><?=$row->news_title?></span></div>
              </div>

			<div class="control-group">
              <label class="control-label" for="data_news_desc"><?=$lang['News Description']?></label>
                 <div class="controls">
                 	<div class="row-fluid">
                    	<div class="span9"><?=$row->news_desc?></div>
                    </div>
                 </div>
            </div>

            <div class="control-group">
              <label class="control-label" for="data_gender"><?=$lang['Created By']?></label>
              <div class="controls"><?=$objHTML->allMembersComboBox('data_created_by', $row->created_by, 'disabled')?></div>
            </div>
            
             <div class="control-group">
              <label class="control-label" for="data_gender"><?=$lang['Admin Status']?></label>
              <div class="controls"><?=$objHTML->AdminStausNewsBox('data_admin_status', $row->admin_status, 'disabled')?></div>
            </div>
            
            <div class="control-group">
              <label class="control-label" for="name"><?=$lang['Status']?></label>
              <div class="controls"><?=$objHTML->newsStatusCombo('data_status',$row->status,'disabled')?></div>
            </div>
            <div class="controls">
              <a href="index.php?model=<?=$_REQUEST['model']?>">
              <button type="button" class="btn btn-primary"><?=$lang['Back']?></button>
              </a> <a href="index.php?model=<?=$_REQUEST['model']?>&action=edit&id=<?=$_REQUEST['id']?>">
              <button type="button" class="btn btn-success"><?=$lang['Edit']?></button>
              </a> <a href="index.php?model=<?=$_REQUEST['model']?>">
              <button type="button" class="btn"><?=$lang['Cancel']?></button>
              </a>
            </div>
          </fieldset>
        </form>
      </div>
    </div>
  </div>
  <!--/span--> 
  
</div>

<script language="javascript">

$(document).ready(function() {
	
	
});


</script>