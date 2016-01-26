<?php 
include_once(CONTROLLERS."/profile.php"); 

$arrGender = $objComm->GenderList();
$arrStatus = $objComm->getAllStatus();
$arrMarrage = $objComm->getMarrageStatus();
$arrEducation = $objComm->getEducationLevel();

$arrDateName = array('date_year','date_month','date_date');
$arrDateID   = array('date_year','date_month','date_date');

$msg = $objComm->getSessionMessage('profile');

?>
<?=$msg?>
<!--<div class="alert alert-error" id='noty' style="display:none;"></div>-->

<div id="dialog" style="display:none;">
	<div id="dialog-bg">
       	<div id="dialog-title"><?=$lang['are_you_sure']?></div>
           <div id="dialog-description"></div>
           <div id="dialog-buttons">
           <a href="javascript:hideDialog();" class="large green button">Yes</a>
           <a href="javascript:reloadPage();" class="large red button">No</a>
		</div>
	</div>	
</div>

<form class="form-horizontal" name="frmprofile" id="frmprofile" method="post" action="index.php">
  <input type="hidden" name="action" id="action" value="UPDATE" />
  <input type="hidden" name="model" id="model" value="dashboard" />
  <input type="hidden" name="pk_id" id="pk_id" value="<?=$row->id?>" /> 
  <input type="hidden" name="hid_email" id="hid_email" value="<?=$row->email_address?>" />        
  <fieldset>
  <table border="0" cellpadding="3" cellspacing="3"  style="width:100%">
    <tr>
      <td><?=$lang['First Name']?>:</td>
      <td><input type="text" required value="<?=$row->fname?>" id="data_fname" name="data_fname"></td>
    </tr>
    <tr>
      <td><?=$lang['Last Name']?>:</td>
      <td><input type="text" required value="<?=$row->lname?>" id="data_lname" name="data_lname"></td>
    </tr>

    <tr>
      <td><?=$lang['Birth Date']?>:</td>
      <td><?=$objHTML->basicDateCombo($arrDateName, $arrDateID, $row->birth_date);?></td>
    </tr>
    <tr>
      <td><?=$lang['Address']?>:</td>
      <td><input type="text" required  value="<?=$row->address?>" id="data_address" name="data_address" /></td>
    </tr>
    <tr>
      <td><?=$lang['Region']?>:</td>
      <td><?=$objHTML->getRegionSelectBox("data_region", $row->region, $extra='')?></td>
    </tr>
    <tr>
      <td><?=$lang['District']?>:</td>
      <td><?=$objHTML->getDistrictSelectBox("data_district", $row->district, $extra='')?></td>
    </tr>
    <tr>
      <td><?=$lang['Gender']?>:</td>
      <td> <?=$objHTML->genderBasicCombo('data_gender',$row->gender)?></td>
    </tr>
    <tr>
      <td><?=$lang['Contact No']?>:</td>
      <td> <input type="number" required value="<?=$row->contact_no?>" id="data_contact_no" name="data_contact_no" class="input-xlarge focused" data-validation-number-message="Contact no should be numeric"></td>
    </tr>
    <tr>
      <td><?=$lang['Email']?>:</td>
      <td><input required style="width:242px;" type="email" value="<?=$row->email_address?>" id="data_email_address" name="data_email_address" onchange="setChangeFlag();checkDuplicateEmail();"><span id="ajax_email" style="color:red;"></span></td>
    </tr>
    <tr>
      <td></td>
      <td>
      <button class="button" style="width:37%;padding:4px;" id='btn_submit' type="submit"><?=$lang['Save Changes']?></button></td>
    </tr>
  </table>
  </fieldset>
</form>