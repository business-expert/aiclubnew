<?php 
include_once(CONTROLLERS_ADMIN."/".$_REQUEST['model'].".php"); 

$msg = $objComm->getSessionMessage('users');
$arrStatus = $objComm->getRoleStatus();
 
?>
<script src="<?=JS?>jquery.passstrength.min.js"></script>
<div>
   <ul class="breadcrumb">
        <li><a href="#"><?=$lang['Settings']?></a> <span class="divider">/</span></li>
        <li><a href="index.php?model=users"><?=$lang['User Type']?></a><span class="divider">/</span></li>        
        <li><a href="#"><?=$lang['View User']?></a></li>
   </ul>
</div>
<div class="row-fluid sortable">
  <div class="box span12">
    <div class="box-header well" data-original-title>
      <h2><i class="icon-user"></i> <?=$lang['User']?></h2>
      <div class="box-icon"></div>
    </div>
    <div class="box-content">
      <div class="box-content">
	      <?=$msg?>
        <form class="form-horizontal" method="post" action="index.php">
          <fieldset>
            <div class="control-group">
              <label class="control-label" for="data_userid"><?=$lang['UserID']?></label>
              <div class="controls"> <span class="input-xlarge uneditable-input"><?=$row->userid?></span> </div>
            </div>
			<div class="control-group">
              <label class="control-label" for="data_password"><?=$lang['Password']?></label>
              <div class="controls">
              <span class="input-xlarge uneditable-input">****************</span>
              </div>
            </div>

            <div class="control-group">
              <label class="control-label" for="data_gender"><?=$lang['Role']?></label>
              <div class="controls">
			  <span class="input-xlarge uneditable-input"><?=ucfirst($row->user_type)?></span></div>
            </div>
            
            <div class="control-group">
              <label class="control-label" for="name"><?=$lang['User Status']?></label>
              <div class="controls"><span class="label <?=$arrStatus[$row->status]?>"><?=ucfirst($row->status)?></span></div>
            </div>
             <div class="form-actions"> <a href="index.php?model=<?=$_REQUEST['model']?>">
              <button type="button" class="btn btn-primary"><?=$lang['Back']?></button>
              </a> <a href="index.php?model=<?=$_REQUEST['model']?>&action=edit&id=<?=$_REQUEST['id']?>">
              <button type="button" class="btn btn-success"><?=$lang['Edit']?></button>
              </a> <a href="index.php?model=<?=$_REQUEST['model']?>">
              <button type="button" class="btn"><?=$lang['Cancel']?></button>
              </a> </div>
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