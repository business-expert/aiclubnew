<?php 
include_once(CONTROLLERS_ADMIN."/".$_REQUEST['model'].".php"); 

$msg = $objComm->getSessionMessage('news');

?>
<div>
   <ul class="breadcrumb">
        <li><a href="#"><?=$lang['Settings']?></a> <span class="divider">/</span></li>
        <li><a href="index.php?model=users"><?=$lang['News']?></a><span class="divider">/</span></li>        
        <li><a href="#"><?=$lang['Edit News']?></a></li>
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
        <input type="hidden" name="action" id="action" value="SAVE" />
        <input type="hidden" name="model" id="model" value="<?=$_REQUEST['model']?>" />
        <input type="hidden" name="pk_id" id="pk_id" value="<?=$_REQUEST['id']?>" />
          <fieldset>
            <div class="control-group">
              <label class="control-label" for="data_news_title"><?=$lang['News Title']?></label>
              <div class="controls">
                <input type="text" required value="<?=$row->news_title?>" id="data_news_title" name="data_news_title" class="input-xlarge focused" style="width:492px;">
              </div>
            </div>
			<div class="control-group">
              <label class="control-label" for="data_news_desc"><?=$lang['News Description']?></label>
              <div class="controls">
                <textarea id="data_news_desc" name="data_news_desc" class="cleditor"><?=$row->news_desc?></textarea>
              </div>
            </div>

            <div class="control-group">
              <label class="control-label" for="data_gender"><?=$lang['Created By']?></label>
              <div class="controls"><?=$objHTML->allMembersComboBox('data_created_by', $row->created_by, 'required')?></div>
            </div>
            
             <div class="control-group">
              <label class="control-label" for="data_gender"><?=$lang['Admin Status']?></label>
              <div class="controls"><?=$objHTML->AdminStausNewsBox('data_admin_status', $row->admin_status, 'required')?></div>
            </div>
            
            <div class="control-group">
              <label class="control-label" for="name"><?=$lang['Status']?></label>
              <div class="controls"><?=$objHTML->newsStatusCombo('data_status',$row->status,'required')?></div>
            </div>
            <div class="controls">
              <button type="submit" class="btn btn-primary"><?=$lang['Save Changes']?></button>
              <button type="reset" class="btn"><?=$lang['Cancel']?></button>
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