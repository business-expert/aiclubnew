<?php 

include_once(CONTROLLERS_ADMIN."/".$_REQUEST['model'].".php"); 

$msg = $objComm->getSessionMessage('members');
$msg1 = $objComm->getSessionMessage('email');

$arrDateName = array('date_year','date_month','date_date');
$arrDateID   = array('date_year','date_month','date_date');
$arrDateVal  = $row->birth_day;

$arrIncome = explode("-",$row->income);

?>

<div>
  <ul class="breadcrumb">
    <li><a href="#">
      <?=$lang['Members']?>
      </a> <span class="divider">/</span></li>
    <li><a href="#">
      <?=$lang['Edit Member']?>
      </a></li>
  </ul>
</div>
<div class="row-fluid sortable">
  <div class="box span12">
    <div class="box-header well" data-original-title>
      <h2><i class="icon-user"></i>
        <?=$lang['Member']?>
      </h2>
      <div class="box-icon"></div>
    </div>
    <div class="box-content">
      <div class="box-content">
        <?=$msg?>
        <?=$msg1?>
        <form class="form-horizontal" method="post" action="index.php">
          <input type="hidden" name="action" id="action" value="UPDATE" />
          <input type="hidden" name="model" id="model" value="<?=$_REQUEST['model']?>" />
          <input type="hidden" name="pk_id" id="pk_id" value="<?=$_REQUEST['id']?>" />
          <input type="hidden" name="hid_email" id="hid_email" value="<?=$row->email_address?>" />          
          <fieldset>
            <div class="control-group">
              <label class="control-label" for="typeahead">
                <?=$lang['Membership Number']?>
              </label>
              <div class="controls">
                <input type="number" required value="<?=$row->membership_id?>" id="data_membership_id" name="data_membership_id" class="input-xsmall focused" data-validation-number-message="Membership number should be numeric">
              </div>
            </div>
            <div class="control-group">
              <label class="control-label" for="data_fname">
                <?=$lang['First Name']?>
              </label>
              <div class="controls">
                <input type="text" required value="<?=$row->fname?>" id="data_fname" name="data_fname" class="input-xsmall focused">
              </div>
            </div>
            <div class="control-group">
              <label class="control-label" for="data_lname">
                <?=$lang['Last Name']?>
              </label>
              <div class="controls">
                <input type="text" required value="<?=$row->lname?>" id="data_lname" name="data_lname" class="input-xsmall focused">
              </div>
            </div>
            <div class="control-group">
              <label class="control-label" for="name">
                <?=$lang['Gender']?>
              </label>
              <div class="controls">
                <?=$objHTML->genderBasicCombo('data_gender',$row->gender)?>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label" for="name">
                <?=$lang['Birth Date']?>
              </label>
              <div class="controls">
                <?=$objHTML->basicDateCombo($arrDateName, $arrDateID, $arrDateVal);?>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label" for="name">
                <?=$lang['Contact No']?>
              </label>
              <div class="controls">
                <input type="number" required value="<?=$row->contact_no?>" id="data_contact_no" name="data_contact_no" class="input-xsmall focused" data-validation-number-message="Contact no should be numeric">
              </div>
            </div>
            <div class="control-group">
              <label class="control-label" for="name">
                <?=$lang['Email']?>
              </label>
              <div class="controls">
                <div class="input-prepend"> <span class="add-on"><i class="icon-envelope"></i></span>
                  <input required type="email" value="<?=$row->email_address?>" id="data_email_address" name="data_email_address" class="input-xsmall focused" onchange="setChangeFlag();checkDuplicateEmail();"  data-validation-email-message="Please enter valid Email Address">&nbsp;&nbsp;&nbsp;<span class="label label-info"><?=$lang['email_verification_note']?></span>
                </div>
                <span id="ajax_email" style="color:red;"></span> </div>
            </div>
            <div class="control-group">
              <label class="control-label" for="name">
                <?=$lang['Address']?>
              </label>
              <div class="controls">
                <input type="text" required  value="<?=$row->address?>" id="data_address" name="data_address" class="input-xsmall focused">
              </div>
            </div>
            <div class="control-group">
              <label class="control-label" for="name">
                <?=$lang['Region']?>
              </label>
              <div class="controls">
                <?=$objHTML->getRegionSelectBox("data_region", $row->region, $extra='')?>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label" for="name">
                <?=$lang['District']?>
              </label>
              <div class="controls">
                <?=$objHTML->getDistrictSelectBox("data_district", $row->district, $extra='')?>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label" for="data_occupation">
                <?=$lang['occupation']?>
              </label>
              <div class="controls">
                <input type="text" value="<?=$row->occupation?>" id="data_occupation" name="data_occupation" class="input-xsmall focused">
              </div>
            </div>
            <div class="control-group">
              <label class="control-label" for="data_education_level">
                <?=$lang['education_level']?>
              </label>
              <div class="controls">
                <?=$objHTML->educationCombo('data_education_level',$row->education_level)?>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label" for="data_income">
                <?=$lang['income']?>
              </label>
              <div class="input-prepend input-append" style="margin-left:21px;"> <span class="add-on">
                <?=CURRENCY?>
                </span>
                <input type="number" value="<?=$arrIncome[0]?>" id="txt_income_from" name="txt_income_from" class="input-xsmall focused" style="width:80px;">
                &nbsp;to&nbsp; <span class="add-on">
                <?=CURRENCY?>
                </span>
                <input type="number" value="<?=$arrIncome[1]?>" id="txt_income_to" name="txt_income_to" class="input-xsmall focused" style="width:80px;">
              </div>
            </div>
            <div class="control-group">
              <label class="control-label" for="data_marriage_status">
                <?=$lang['marriage_status']?>
              </label>
              <div class="controls">
                <?=$objHTML->marrigeCombo('data_marriage_status',$row->marriage_status)?>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label" for="name">
                <?=$lang['Children Details']?>
              </label>
              <div class="controls">
                <table class="table table-striped table-bordered bootstrap-datatable datatable" style="width:80%" id="tab_children">
                  <tr>
                    <th><?=$lang['Name']?></th>
                    <th><?=$lang['Gender']?></th>
                    <th><?=$lang['Birth Date']?></th>
                    <th></th>
                  </tr>
                  <?php 
						$arrChildDateName = array('child_date_year[]','child_date_month[]','child_date_date[]');
						$arrChildDateID   = array('child_date_year_0','child_date_month_0','child_date_date_0');
					?>
                  <tr id="tr_0">
                    <td><input type="text" value="<?=$rowChilds[0]->name?>" id="child_name_0" name="child_name[]" class="input-xsmall focused"></td>
                    <td><select style='width:80px;' name="child_gender[]" id="child_gender_0" >
                        <option value=""> SELECT </option>
                        <option value="M" <?php if($rowChilds[0]->gender=='M') { echo "selected='selected'";} ?>>Male</option>
                        <option value="F" <?php if($rowChilds[0]->gender=='F') { echo "selected='selected'";} ?>>Female</option>
                      </select></td>
                    <td><?=$objHTML->basicDateCombo($arrChildDateName, $arrChildDateID, $rowChilds[0]->birth_date);?></td>
                    <td>&nbsp;&nbsp;</td>
                  </tr>
                  <?php 
						$arrChildDateName = array('child_date_year[]','child_date_month[]','child_date_date[]');
						$arrChildDateID   = array('child_date_year_999','child_date_month_999','child_date_date_999');
					?>
                  <tr id="tr_999" style="display:none;">
                    <td><input type="text" value="" id="child_name_999" name="child_name[]" class="input-xsmall focused"></td>
                    <td><select style='width:80px;' name="child_gender[]" id="child_gender_999">
                        <option value=""> SELECT </option>
                        <option value="M">Male</option>
                        <option value="F">Female</option>
                      </select></td>
                    <td><?=$objHTML->basicDateCombo($arrChildDateName, $arrChildDateID, '');?></td>
                    <td><span class="icon32 icon-red icon-close" title="Remove" onclick="removetabrow('#tr_999')"></span></td>
                  </tr>
                  <?php
					//echo "<pre>"; print_r($rowChilds);
                    for($i = 1; $i < count($rowChilds); $i++)
                    {
 
						$arrChildDateName = array('child_date_year[]','child_date_month[]','child_date_date[]');
						$arrChildDateID   = array('child_date_year_'.$i,'child_date_month_'.$i,'child_date_date_'.$i);
					
					?>
                  <tr id="tr_<?=$i?>">
                    <td><input type="text" value="<?=$rowChilds[$i]->name?>" id="child_name_<?=$i?>" name="child_name[]" class="input-xsmall focused"></td>
                    <td><select style='width:80px;' name="child_gender[]" id="child_gender_<?=$i?>">
                        <option value=""> SELECT </option>
                        <option value="M" <?php if($rowChilds[$i]->gender=='M') { echo "selected='selected'";} ?>>Male</option>
                        <option value="F" <?php if($rowChilds[$i]->gender=='F') { echo "selected='selected'";} ?>>Female</option>
                      </select></td>
                    <td><?=$objHTML->basicDateCombo($arrChildDateName, $arrChildDateID, $rowChilds[$i]->birth_date);?></td>
                    <td><span class="icon32 icon-red icon-close" title="Remove" onclick="removetabrow('#tr_<?=$i?>')"></span></td>
                  </tr>
                  <?php } ?>
                </table>
                <a id="addRow" href="javascript:addTableRow();" class="btn btn-small btn-info"><i class="icon-plus-sign"></i>
                <?=$lang['Add More Children']?>
                </a> </div>
            </div>
            <div class="control-group">
              <label class="control-label" for="name">
                <?=$lang['Account Status']?>
              </label>
              <div class="controls">
                <?=$objHTML->statusBasicCombo('data_status',$row->status)?>
              </div>
            </div>
            <div class="controls">
              <button type="submit" class="btn btn-primary">
              <?=$lang['Save Changes']?>
              </button>
              <button type="reset" class="btn">
              <?=$lang['Cancel']?>
              </button>
            </div>
          </fieldset>
        </form>
      </div>
    </div>
  </div>
</div>

<span class="btn btn-primary noty" data-noty-options='' style="display:none;"></span>
<script>

var emailChange 	= "<?=$lang['email_change']?>";

function showNotification(text)
{
	var NotificationText = '{"text":"'+text+'","layout":"topRight","type":"error","animateOpen": {"opacity": "show"}}';
	$(".noty").attr("data-noty-options",NotificationText);
	$(".noty").trigger("click");	
}

function removetabrow(elm)
{
	$(elm).remove();	
}

function addTableRow()
{
	nextRow = $('#tab_children tr[id^="tr_"]').length;
	nextRow++;
	
	var RowData = $("#tr_999").html();
	var newRowData = RowData.replace(/_999/g,'_'+nextRow);

	$("#tab_children > tbody").append("<tr id='tr_"+nextRow+"'>"+newRowData+"</tr>");
	
	$("#child_name_"+nextRow).val('');
	$("#child_gender_"+nextRow).val('');
}

var popup = false;
var emailsend = false;

function setChangeFlag()
{
	if(popup == false && $('#data_email_address').val() != $("#hid_email").val() && emailsend == false)
		popup = true;
}

function checkDuplicateEmail()
{
	if(popup == true)
	{
		showNotification(emailChange);	
		popup = false;	
		emailsend = true;
	}

	if($('#data_email_address').val().length > 10)
	{
		$.ajax({
				type	: "GET",
				url		: "ajax.php",
				data    : "ajaxcall=true&mod=checkUniqEmail&email="+$("#data_email_address").val()+"&id="+$("#pk_id").val(),
				success	: function(result)   {
							if(result != '')
								$("#ajax_email").html("<br>"+result);
							else
								$("#ajax_email").html("");
						  }
			   });	
	}
}



</script> 
