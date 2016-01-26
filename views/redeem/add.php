<?php 
include_once(CONTROLLERS."/redeem.php"); 

$arrDateName = 	array('data_birth_year','data_birth_month','data_birth_day');
$arrDateID   = 	array('data_birth_year','data_birth_month','data_birth_day');

$arrTimeName =	array('data_birth_hour','data_birth_min');
$arrTimeID	 =	array('data_birth_hour','data_birth_min');

$msg = $objComm->getSessionMessage('redeem');

?>

<tr>
  <td style="padding:20px"><form name="frmRedeem" id="frmRedeem" method="post" action="index.php">
      <input type="hidden" name="action" id="action" value="SAVE" />
      <input type="hidden" name="model" id="model" value="redeem" />

        <?=$msg?>
        <table border="0" cellpadding="0" cellspacing="5" width="100%" align="center" style="margin-top:10px;">
          <tbody>
            <tr>
              <td style="width:35%"><table border="0" cellpadding="0" cellspacing="5" width="70%" align="center">
                  <tbody>
                    <tr>
                      <td colspan="2"><span style="background:#693A8B;padding:3px;color:#fff;"><b>
                        <?=$lang['Assessment Redeemtion']?></b></span><br><br></td>
                    </tr>
                    <tr>
                      <td width="15%"><?=$lang['First Name']?>:</td>
                      <td width="85%"><input type="text" required value="<?=$row->first_name?>" id="data_first_name" name="data_first_name"></td>
                    </tr>
                    <tr>
                      <td><?=$lang['Last Name']?>:</td>
                      <td><input type="text" required value="<?=$row->last_name?>" id="data_last_name" name="data_last_name"></td>
                    </tr>
                    <tr>
                      <td><?=$lang['Birth Date']?>:</td>
                      <td><?=$objHTML->basicDateCombo($arrDateName, $arrDateID, $row->birth_date);?>&nbsp;&nbsp;<?=$lang['Time']?> : <?=$objHTML->basicTimeCombo($arrTimeName, $arrTimeID, '');?></td>
                    </tr>
                    <tr>
                      <td><?=$lang['Gender']?>:</td>
                      <td><input type="radio" name="gender[]" id="gender_male" value="Male" ><?=$lang['Male']?> &nbsp;<input type="radio" name="gender[]" value="Female" id="gender_female"><?=$lang['Female']?><label for="gender[]" class="error" style="display:none;"><?=$lang['gender_error']?></label> </td>
                    </tr>
                    <tr>
                      <td></td>
                      <td><input class="submit" type="submit" value="<?=$lang['Save']?>"/></td>
                    </tr>
                </table></td>
            </tr>
          </tbody>
        </table>
    </form></td>
</tr>


<script>

var fnameError 	= "<?=$lang['fname_error']?>";
var lnameError 	= "<?=$lang['lname_error']?>";
var genderError	= "<?=$lang['gender_error']?>";

$().ready(function() {
	$("#frmRedeem").validate({
		rules: {
				data_first_name: { required: true },
				data_last_name: { required: true},
				"gender[]": { required: true}
			   },
		messages: {
				data_first_name: { required: fnameError },
				data_last_name: { required: lnameError},
				"gender[]": { required: genderError}
			}
	});
});
</script>
