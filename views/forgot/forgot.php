<?php
	require_once(CONTROLLERS."/forgot.php");
	$msg = $objComm->getSessionMessage('forgot');
	
	$arrDateName = array('date_year','date_month','date_date');
	$arrDateID = array('date_year','date_month','date_date');
?>

<tr>
  <td colspan="2"><form class="form-horizontal" method="post" action="index.php" id="frmForget" name="frmForget">
      <input type="hidden" name="model" id="model" value='forgot'>
      <input type="hidden" name="action" id="action" value='verify'>
      <table border="0" cellpadding="0" cellspacing="5" width="70%" align="center" style="margin-top:10px;">
        <tbody>
          <tr>
            <td colspan="2"><?=$msg?></td>
          </tr>
          <tr>
            <td colspan="2" style="height:30px;"><span style="background:#693A8B;padding:3px;color:#fff;"><b><?=$lang['Forget Password']?></b></span></td>
          </tr>
          <tr>
            <td><?=$lang['Email']?>:</td>
            <td><input required id="data_email_address" name="data_email_address" type="text" style="width:250px;" >
              <span id="ajax_email" style="color:red;"></span></td>
          </tr>
          <tr>
            <td><?=$lang['Date of Birth']?>:</td>
            <td><?=$objHTML->basicDateCombo($arrDateName, $arrDateID, $arrDateVal);?></td>
          </tr>
          <tr><td colspan="2">&nbsp;</td></tr>
          <tr>
            <td></td>
            <td><button class="btn btn-primary" type="submit"><?=$lang['submit']?></button></td>
          </tr> <tr><td colspan="2">*<?=$lang['send_password_change_link']?></td></tr>
        </tbody>
      </table>
    </form></td>
</tr>
<script>

var emailError  	= "<?=$lang['email_error']?>";
var emailValidError = "<?=$lang['email_valid_error']?>";

$().ready(function() {
	$("#frmForget").validate({
		rules: 	  { data_email_address: { required: true,  minlength: 5 }},
		messages: {	data_email_address: { required: emailError, email: emailValidError}}
	});
});

</script>