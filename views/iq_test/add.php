<?php 
include_once(CONTROLLERS."/iq_test.php"); 

$arrGender = $objComm->GenderList();

$arrDateName = array('data_examinee_birthy','data_examinee_birthm','data_examinee_birthd');
$arrDateID   = array('data_examinee_birthy','data_examinee_birthm','data_examinee_birthd');

/*
	$arrTimeName =	array();
	$arrTimeID	 =	array();
*/

$msg = $objComm->getSessionMessage('IQTest');

?>

<tr>
  <td style="padding:20px"><form name="frmIQTest" id="frmIQTest" method="post" action="index.php">
      <input type="hidden" name="action" id="action" value="SAVE" />
      <input type="hidden" name="model" id="model" value="iq_test" />

        <?=$msg?>
        <table border="0" cellpadding="0" cellspacing="5" width="100%" align="center" style="margin-top:10px;">
          <tbody>
            <tr>
              <td style="width:35%"><table border="0" cellpadding="0" cellspacing="5" width="70%" align="center">
                  <tbody>
                    <tr>
                      <td colspan="2"><span style="background:#693A8B;padding:3px;color:#fff;"><b>
                        <?=$lang['IQ Test']?></b></span><br><br></td>
                    </tr>
                    <tr>
                      <td width="15%"><?=$lang['First Name']?>:</td>
                      <td width="85%"><input type="text" required value="<?=$row->examinee_firstn?>" id="data_examinee_firstn" name="data_examinee_firstn"></td>
                    </tr>
                    <tr>
                      <td><?=$lang['Last Name']?>:</td>
                      <td><input type="text" required value="<?=$row->examinee_lastn?>" id="data_examinee_lastn" name="data_examinee_lastn"></td>
                    </tr>
                    <tr>
                      <td><?=$lang['Birth Date']?>:</td>
                      <td><?=$objHTML->basicDateCombo($arrDateName, $arrDateID, $row->birth_date);?></td>
                    </tr>
                    <tr>
                      <td><?=$lang['Gender']?>:</td>
                      <td><input required type="radio" name="examinee_gender[]" id="examinee_gender_male" value="Male" ><?=$lang['Male']?> &nbsp;<input type="radio" name="examinee_gender[]" value="Female" id="examinee_gender_female"><?=$lang['Female']?> <label for="examinee_gender[]" class="error" style="display:none"><?=$lang['gender_error']?></label></td>
                    </tr>
                    <tr>
                      <td><?=$lang['Preferred Hand']?>:</td>
                      <td><input required type="radio" name="examinee_handedness[]" id="examinee_handedness_left" value="Left"><?=$lang['Left']?> &nbsp;<input type="radio" name="examinee_handedness[]" value="Right" id="examinee_handedness_right"><?=$lang['Right']?> <label for="examinee_handedness[]" class="error" style="display:none"><?=$lang['hand_error']?></label></td>
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
var handError  	= "<?=$lang['hand_error']?>";

$().ready(function() {
	$("#frmIQTest").validate({
		rules: {
				data_examinee_firstn: { required: true },
				data_examinee_lastn: { required: true},
				"examinee_gender": { required: true},
				"examinee_handedness": {required: true}
			   },
		messages: {
				data_examinee_firstn: { required: fnameError },
				data_examinee_lastn: { required: lnameError},
				"examinee_gender": { required: genderError},
				"examinee_handedness": { required: handError}
			}
	});
});
</script>
