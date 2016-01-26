<?php
	//echo "<pre>"; print_r($_SESSION);
	require_once(CONTROLLERS."/login.php");
	$msg = $objComm->getSessionMessage('login');
?>
<style>

.form td { padding: 0}
</style>
<tr>
  <td colspan="2" align="center">
    <form class="form-horizontal" method="post" action="index.php" id="frmlogin" name="frmlogin">
      <input type="hidden" name="model" id="model" value='login'>
      <input type="hidden" name="action" id="action" value='login'>
      <div class="form" style="width:35%;margin:12px 0 0 0;">
      <table border="0" cellpadding="0" cellspacing="5" width="70%" align="center">
        <tbody>
        	<tr>
              <td colspan="2"><?=$msg?></td>
            </tr>
         <!-- <tr>
            <td colspan="2" style="height:30px;"><span style="background:#693A8B;padding:3px;color:#fff;"><b><?=$lang['']?>Login</b></span></td>
          </tr>-->
          <tr>
            <td colspan="2"><div style="margin:0px 0px 5px 0;"><?=$lang['Type of Member']?></div>
            <select name="login_type" id="login_type" required style="width:100px;">
               <option value="">--SELECT--</option>
               <option value="member">Member</option>
               <option value="alliance">Alliance</option>
             </select></td>
          </tr>
          <tr>
            <td colspan="2"><div style="margin:0px 0px 5px 0;"><?=$lang['Email']?></div><input type="text" required value="" id="username" name="username" style="width:200px;"></td>
          </tr>
          <tr>
            <td colspan="2"><div style="margin:0px 0px 5px 0;"><?=$lang['Password']?></div><input type="password" required value="" id="password" name="password" style="width:200px;">&nbsp;<button class="" type="submit"><?=$lang['Login']?></button><label for="password" class="error" style="display:none;"></label></td>
          </tr>
          <tr>
            <td></td>
            <td></td>
          </tr>
        </tbody>
      </table>
      </div>
      <a href='index.php?model=forgot'><button class="button" style="width:37%;margin:10px 0 0 0;" type="submit"><?=$lang['Forget Password']?></button></a>
    </form></td>
</tr>


<script>

var passError 		= "<br><?=$lang['password_error']?>";
var passMinError 	= "<br><?=$lang['password_minlength_error']?>";
var emailError  	= "<br><?=$lang['email_error']?>";
var emailValidError = "<br><?=$lang['email_valid_error']?>";

$().ready(function() {
	$("#frmlogin").validate({
		rules: {
				username: {	required: true,	email: true },
				password: {	required: true,	minlength: 5 }
			   },
		messages: {
			username: { required: emailError,   email: emailValidError},
			password: {	required: passError, minlength: passMinError}
			}
	});
});

</script>