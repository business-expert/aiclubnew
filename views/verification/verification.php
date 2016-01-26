<?php 

include_once(CONTROLLERS."/".$_REQUEST['model'].".php"); 
$msg = $objComm->getSessionMessage('verification');

$arrDateName = array('date_year','date_month','date_date');
$arrDateID = array('date_year','date_month','date_date');
$arrDateVal = '';

?>

<tr>
  <td colspan="2"><form class="form-horizontal" id="frmVerify" name="frmVerify" method="post" action="verify.php">
      <input type="hidden" name="action" id="action" value="VERIFIED" />
      <input type="hidden" name="code" id="code" value="<?=$_REQUEST['code']?>" />
      <input type="hidden" name="model" id="model" value="<?=$_REQUEST['model']?>" />
      <table border="0" cellpadding="0" cellspacing="5" width="70%" align="center" style="margin-top:10px;">
        <tbody>
          <tr>
            <td colspan="2"><?=$msg?></td>
          </tr>
          <tr>
            <td colspan="2" style="height:30px;"><span style="background:#693A8B;padding:3px;color:#fff;"><b>
              <?=$lang['Verification Details']?>
              </b></span></td>
          </tr>
          <tr>
            <td style="width:30%"><?=$lang['First Name']?></td>
            <td style="width:70%"><input type="text" required value="<?=$row->fname?>" id="data_fname" name="data_fname" /></td>
          </tr>
          <tr>
            <td><?=$lang['Last Name']?></td>
            <td><input type="text" required value="<?=$row->lname?>" id="data_lname" name="data_lname" /></td>
          </tr>
          <tr>
            <td><?=$lang['Birth Date']?></td>
            <td><?=$objHTML->basicDateCombo($arrDateName, $arrDateID, $arrDateVal);?></td>
          </tr>
          <tr>
          <tr>
            <td><?=$lang['Contact No']?></td>
            <td><input type="number" required value="<?=$row->contact_no?>" id="data_contact_no" name="data_contact_no" /></td>
          </tr>
          <tr>
            <td><?=$lang['Email']?></td>
            <td><input type="email" required  value="<?=$row->email_address?>" id="data_email_address" name="data_email_address" /></td>
          </tr>
        <td></td>
          <td><div class="form-actions">
              <button type="submit" class="btn btn-primary"><?=$lang['Verify Details']?></button>
              <button type="reset" class="btn"><?=$lang['Cancel']?></button></div></td>
        </tr>
          </tbody>
        
      </table>
    </form></td>
</tr>

<script>

$().ready(function() {
	$("#frmVerify").validate({
		rules: {
				data_fname: { required: true },
				data_lname: { required: true },
				data_contact_no: { required: true}	,
				data_email_address: { required: true, email: true}																			
			   },
		messages: {
				data_fname: { required: "Please enter first name" },
				data_lname: { required: "Please enter last name" },
				data_contact_no: { required: "Please enter contact no"}	,
				data_email_address: { required: "Please enter email", email: "Please enter valid email"}
			}
	});
});

</script> 
