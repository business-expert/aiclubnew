<?php 
include_once(CONTROLLERS."/".$_REQUEST['model'].".php"); 

$msg = $objComm->getSessionMessage('verification');
?>
<script src="<?=JS?>jquery.passstrength.min.js"></script>

<tr>
  <td colspan="2">  <form class="form-horizontal" id="frmpass" name="frmpass" method="post" action="verify.php">
        <input type="hidden" name="action" id="action" value="CREATE" />
        <input type="hidden" name="model" id="model" value="<?=$_REQUEST['model']?>" />
        <input type="hidden" name="code" id="code" value="<?=$_REQUEST['code']?>" />
      <table border="0" cellpadding="0" cellspacing="5" width="70%" align="center" style="margin-top:10px;">
        <tbody>
          <tr>
            <td colspan="2"><?=$msg?></td>
          </tr>
          <tr>
            <td colspan="2" style="height:30px;"><span style="background:#693A8B;padding:3px;color:#fff;"><b>
             <?=$lang['Create Member Password']?></b></span></td>
          </tr>
          <tr>
            <td style="width:25%"><?=$lang['Name']?></td>
            <td style="width:75%"> <?=$objVery->row->fname." ".$objVery->row->lname?></td>
          </tr>
          <tr>
            <td><?=$lang['Email']?></td>
            <td><?=$objVery->row->email_address?></td>
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
        <td></td>
          <td><div class="form-actions">
             <button type="submit" class="btn btn-primary"><?=$lang['Create Password']?></button></div></td>
        </tr>
          </tbody>
        
      </table>
    </form></td>
</tr>


<script language="javascript">

$(document).ready(function() {

	$('input[id=data_password]').passStrengthify();

	$("#frmpass").validate({
		rules: {
				data_password: {required: true,	minlength: 5 },
				data_confirm_password: { required: true, minlength: 5, equalTo: "#data_password" }				
			   },
		messages: {
			data_password: { required: "Please provide a password", minlength: "Your password must be at least 5 characters long"},
			confirm_password: { required: "Please provide a password", minlength: "Your password must be at least 5 characters long",
								equalTo: "Please enter the same password as above"}						
			}
	});
});

</script>