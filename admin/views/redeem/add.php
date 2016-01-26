<?php 

include_once(CONTROLLERS_ADMIN."/".$_REQUEST['model'].".php"); 

$msg = $objComm->getSessionMessage('redeem');

$arrDateName = array('data_birth_year','data_birth_month','data_birth_day');
$arrTimeName = array('data_birth_hour','data_birth_min');

$BirthTime = $BirthDate = '';

?>

<div>
    <ul class="breadcrumb">
        <li><a href="#"><?=$lang['Members']?></a> <span class="divider">/</span></li>
        <li><a href="#"><?=$lang['All Redeem']?></a><span class="divider">/</span></li>
        <li><a href="#"><?=$lang['Add Redeem']?></a></li>
   </ul>
</div>
<div class="row-fluid sortable">
  <div class="box span12">
    <div class="box-header well" data-original-title>
      <h2><i class="icon-user"></i> <?=$lang['Redeem']?></h2>
      <div class="box-icon"></div>
    </div>
    <div class="box-content">
      <div class="box-content">
	    <?=$msg?>
        <form class="form-horizontal" method="post" action="index.php" id="frmRedeem" name="frmRedeem">
        <input type="hidden" name="action" id="action" value="SAVE" />
        <input type="hidden" name="model" id="model" value="<?=$_REQUEST['model']?>" />
        <input type="hidden" name="pk_id" id="pk_id" value="<?=$_REQUEST['id']?>" />
          <fieldset>
            <div class="control-group">
              <label class="control-label" for="typeahead"><?=$lang['First Name']?></label>
              <div class="controls"> 
               <input type="text" required value="" id="data_first_name" name="data_first_name" class="input-xsmall focused" ></div>
            </div>
             
            <div class="control-group">
              <label class="control-label" for="data_fname"><?=$lang['Last Name']?></label>
              <div class="controls">
                <input type="text" required value="" id="data_last_name" name="data_last_name" class="input-xsmall focused">
              </div>
            </div>

            <div class="control-group">
              <label class="control-label" for="name"><?=$lang['Birth Date Time']?></label>
              <div class="controls"><?=$objHTML->basicDateCombo($arrDateName, $arrDateName, $BirthDate,'required').' Time: '.$objHTML->basicTimeCombo($arrTimeName, $arrTimeName, $BirthTime, 'required');?></div>
            </div>
          
            <div class="control-group">
              <label class="control-label" for="name"><?=$lang['Gender']?></label>
              <div class="controls">
	            <?=$objHTML->radioBox('gender', 'gender_M', 'M', 'Male', 'M')?>
	            <?=$objHTML->radioBox('gender', 'gender_F', 'F', 'Female', '')?>                
              </div>
            </div>
            
            <div class="control-group">
              <label class="control-label" for="name"><?=$lang['Member']?></label>
              <div class="controls">
	             <?=$objHTML->allMembersComboBox('data_member_id', $row->member_id, 'required')?>
              </div>
            </div>
             <div class="control-group">
              <div class="controls">
              <button type="submit" class="btn btn-primary"><?=$lang['Save Changes']?></button>
              <button type="reset" class="btn"><?=$lang['Cancel']?></button>
            </div></div>
          </fieldset>
        </form>
      </div>
    </div>
  </div>
</div>
<script>

var fnameError 	= "<?=$lang['fname_error']?>";
var lnameError 	= "<?=$lang['lname_error']?>";
var genderError	= "<?=$lang['gender_error']?>";

$().ready(function() {
	$("#frmRedeem").validate({
		rules: {
				data_firstn: { required: true },
				data_lastn: { required: true},
				"gender": { required: true}
			   },
		messages: {
				data_firstn: { required: fnameError },
				data_lastn: { required: lnameError},
				"gender": { required: genderError}
			}
	});
});
</script>