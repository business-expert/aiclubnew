<?php 

include_once(CONTROLLERS_ADMIN."/".$_REQUEST['model'].".php"); 

$msg = $objComm->getSessionMessage('IQTest');

$arrDateName = array('data_examinee_birthy','data_examinee_birthm','data_examinee_birthd');
$arrDateID   = array('data_examinee_birthy','data_examinee_birthm','data_examinee_birthd');

$BirthDate = $row->examinee_birthy."-".$row->examinee_birthm."-".$row->examinee_birthd;

?>

<div>
    <ul class="breadcrumb">
        <li><a href="#"><?=$lang['Members']?></a> <span class="divider">/</span></li>
        <li><a href="#"><?=$lang['All IQ Test']?></a><span class="divider">/</span></li>
        <li><a href="#"><?=$lang['Edit IQ Test']?></a></li>
   </ul>
</div>
<div class="row-fluid sortable">
  <div class="box span12">
    <div class="box-header well" data-original-title>
      <h2><i class="icon-user"></i> <?=$lang['IQ Test']?></h2>
      <div class="box-icon"></div>
    </div>
    <div class="box-content">
      <div class="box-content">
	    <?=$msg?>
        <form class="form-horizontal" method="post" action="index.php">
        <input type="hidden" name="action" id="action" value="UPDATE" />
        <input type="hidden" name="model" id="model" value="<?=$_REQUEST['model']?>" />
        <input type="hidden" name="pk_id" id="pk_id" value="<?=$_REQUEST['id']?>" />
          <fieldset>
            <div class="control-group">
              <label class="control-label" for="typeahead"><?=$lang['First Name']?></label>
              <div class="controls"> 
               <input type="text" required value="<?=$row->examinee_firstn?>" id="data_examinee_firstn" name="data_examinee_firstn" class="input-xsmall focused" ></div>
            </div>
             
            <div class="control-group">
              <label class="control-label" for="data_fname"><?=$lang['Last Name']?></label>
              <div class="controls">
                <input type="text" required value="<?=$row->examinee_lastn?>" id="data_examinee_lastn" name="data_examinee_lastn" class="input-xsmall focused">
              </div>
            </div>

            <div class="control-group">
              <label class="control-label" for="name"><?=$lang['Birth Date']?></label>
              <div class="controls"><?=$objHTML->basicDateCombo($arrDateName, $arrDateID, $BirthDate);?></div>
            </div>
          
            <div class="control-group">
              <label class="control-label" for="name"><?=$lang['Gender']?></label>
              <div class="controls">
	            <?=$objHTML->radioBox('examinee_gender', 'examinee_gender_M', 'M', 'Male', $row->examinee_gender)?>
	            <?=$objHTML->radioBox('examinee_gender', 'examinee_gender_F', 'F', 'Female', $row->examinee_gender)?>                
              </div>
            </div>
            
             <div class="control-group">
              <label class="control-label" for="name"><?=$lang['Preferred Hand']?></label>
              <div class="controls">
	            <?=$objHTML->radioBox('examinee_handedness', 'examinee_handedness_R', 'R', 'Right', $row->examinee_handedness)?>
	            <?=$objHTML->radioBox('examinee_handedness', 'examinee_handedness_L', 'L', 'Left', $row->examinee_handedness)?>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label" for="name"><?=$lang['Member']?></label>
              <div class="controls">
	             <?=$objHTML->allMembersComboBox('data_member_id', $row->member_id, '')?>
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
var handError  	= "<?=$lang['hand_error']?>";

$().ready(function() {
	$("#frmIQTest").validate({
		rules: {
				data_examinee_firstn: { required: true },
				data_examinee_lastn: { required: true},
				"examinee_gender[]": { required: true},
				"examinee_handedness[]": {required: true}
			   },
		messages: {
				data_examinee_firstn: { required: fnameError },
				data_examinee_lastn: { required: lnameError},
				"examinee_gender[]": { required: genderError},
				"examinee_handedness[]": { required: handError}
			}
	});
});
</script>