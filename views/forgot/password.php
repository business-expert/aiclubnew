<?php
	require_once(CONTROLLERS."/forgot.php");
	$msg = $objComm->getSessionMessage('forgot');
	
	$arrDateName = array('date_year','date_month','date_date');
	$arrDateID = array('date_year','date_month','date_date');
?>
<script src="<?=JS?>jquery.passstrength.min.js"></script>
<tr>
  <td colspan="2"><form class="form-horizontal" method="post" action="index.php" id="frmForget" name="frmForget">
      <input type="hidden" name="model" id="model" value='forgot'>
      <input type="hidden" name="action" id="action" value='password'>
      <input type="hidden" name="sid" id="sid" value='<?=$_REQUEST['sid']?>'>      
      <table border="0" cellpadding="0" cellspacing="5" width="70%" align="center" style="margin-top:10px;">
        <tbody>
          <tr>
            <td colspan="2"><?=$msg?></td>
          </tr>
          <tr>
            <td colspan="2" style="height:30px;"><span style="background:#693A8B;padding:3px;color:#fff;"><b><?=$lang['Change Password']?></b></span></td>
          </tr>
          <tr>
            <td><?=$lang['Date of Birth']?>:</td>
            <td><?=$objHTML->basicDateCombo($arrDateName, $arrDateID, $arrDateVal);?></td>
          </tr>
           <tr>
            <td><?=$lang['Password']?></td>
            <td><input type="password" required value="" id="data_password" name="data_password"  />&nbsp;&nbsp;&nbsp;</td>
          </tr>
          <tr>
          <tr>
            <td><?=$lang['Confirm Password']?></td>
            <td><input type="password" required value="" id="data_confirm_password" name="data_confirm_password" /></td>
          </tr>
          <tr><td colspan="2">&nbsp;</td></tr>
          <tr>
            <td></td>
            <td><button class="btn btn-primary" id="btn_submit" name="btn_submit" value='pass_change' type="submit"><?=$lang['submit']?></button></td>
        </tbody>
      </table>
    </form></td>
</tr>
<script>

var passwordError  		= "<?=$lang['password_error']?>";
var passwordMinError 	= "<?=$lang['password_minlength_error']?>";
var passwordEqualError	= "<?=$lang['password_equal_error']?>";

$().ready(function() {
	
	$('input[id=data_password]').passStrengthify();

	$("#frmForget").validate({
		rules: {
				data_password: {required: true,	minlength: 5 },
				data_confirm_password: { required: true, minlength: 5, equalTo: "#data_password" }				
			   },
		messages: {
			data_password: { required: passwordError, minlength: passwordMinError},
			confirm_password: { required: passwordError, minlength: passwordMinError, equalTo: passwordEqualError}						
			}
	});
});

</script>