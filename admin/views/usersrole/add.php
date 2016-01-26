<?php 
include_once(CONTROLLERS_ADMIN."/".$_REQUEST['model'].".php"); 

$msg = $objComm->getSessionMessage('users');

?>
<script src="<?=JS?>jquery.passstrength.min.js"></script>
<div>
    <ul class="breadcrumb">
        <li><a href="#"><?=$lang['Settings']?></a> <span class="divider">/</span></li>
        <li><a href="index.php?model=usersrole"><?=$lang['User Role']?></a><span class="divider">/</span></li>        
        <li><a href="#"><?=$lang['Add User Role']?></a></li>
   </ul>
</div>
<div class="row-fluid sortable">
  <div class="box span12">
    <div class="box-header well" data-original-title>
      <h2><i class="icon-user"></i> <?=$lang['User Role']?></h2>
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
              <label class="control-label" for="data_userid"><?=$lang['UserID']?></label>
              <div class="controls">
                <input type="text" required value="<?=$row->userid?>" id="data_userid" name="data_userid" class="input-xsmall focused">
              </div>
            </div>
			<div class="control-group">
              <label class="control-label" for="data_password"><?=$lang['Password']?></label>
              <div class="controls">
                <input type="password" required value="<?=$row->password?>" id="data_password" name="data_password" class="input-xsmall focused">&nbsp;&nbsp;&nbsp;&nbsp;
              </div>
            </div>

            <div class="control-group">
              <label class="control-label" for="data_gender"><?=$lang['Role']?></label>
              <div class="controls"><?=$objHTML->getUserRoleCombo('data_role',$row->role)?></div>
            </div>
            
            <div class="control-group">
              <label class="control-label" for="name"><?=$lang['User Status']?></label>
              <div class="controls"><?=$objHTML->roleStatusBasicCombo('data_status',$row->status)?></div>
            </div>
            <div class="form-actions">
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
	$('input[type=password]').passStrengthify();
	
	$('#passwd6').passStrengthify({
      minimum: 5,
      labels: {
        tooShort: 'Too short custom text',
        passwordStrength: 'Password strength custom text'
    }});
	
});


</script>