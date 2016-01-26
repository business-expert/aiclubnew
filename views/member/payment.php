<?php 
	include_once(CONTROLLERS."/member.php"); 
	$msg = $objComm->getSessionMessage('member');
	
	$arrMembershipName = $objComm->membershipItemName();
	$arrMembershipAmount = $objComm->membershipAmount();
	$arrRegion = $objComm->getAllRegion();
	$arrDistrict = $objComm->getAllDistrict();

	$arrMemType = explode(",",$row->membership_type);
	
	foreach($arrMemType as $value){
		$strMember .= "<br>".CURRENCY." $".number_format($arrMembershipAmount[$value],2). "&nbsp;&nbsp;-&nbsp;&nbsp;".$arrMembershipName[$value];
	}
?>

<tr>
  <td style="padding:20px"><form class="form-horizontal" name="myform" id="myform" method="post" action="index.php">
      <input type="hidden" name="action" id="action" value="payment" />
      <input type="hidden" name="model" id="model" value="member" />
      <?=$msg?>
       <table border="0" cellpadding="0" cellspacing="5" width="100%" align="center" style="margin-top:10px;">
        <tbody>
          <tr>
            <td style="width:35%"><table border="0" cellpadding="0" cellspacing="5" width="80%" align="center">
                <tbody>
                  <tr>
                    <td colspan="2"><span style="background:#693A8B;padding:3px;color:#fff;"><b><?=$lang['Payment Summary']?></b></span><br>
                      <br></td>
                  </tr>
                   <tr>
                    <td><?=$lang['Name']?>:</td>
                    <td><?=$row->fname." ".$row->lname?></td>
                  </tr>
                   <tr>
                    <td><?=$lang['Birth Date']?>:</td>
                    <td><?=$row->birth_date?></td>
                  </tr>
                  <tr>
                    <td><?=$lang['Contact No']?>:</td>
                    <td><?=$row->contact_no?></td>
                  </tr>
                  <tr>
                    <td><?=$lang['Email']?>:</td>
                    <td><?=$row->email_address?></td>
                  </tr>
					<tr>
                    <td><?=$lang['Address']?>:</td>
                    <td><?=$row->address.", ".$arrRegion[$row->region].", ".$arrDistrict[$row->district]?></td>
                  </tr>
                  <tr>
                    <td><?=$lang['Membership Type']?>:</td>
                    <td><?=$strMember?></td>
                  </tr>                  
                   <tr>
                    <td><?=$lang['Payment Amount']?>:</td>
                    <td><strong><?=CURRENCY?> </strong>
                      <?='$'.number_format($row->amount_paid,2);?></td>
                  </tr>
                  <tr>
                    <td></td>
                    <td><input type="image" name="btn_submit" id="btn_submit" style="width:30%;" src="<?=IMAGES?>payment.png" value="<?=$lang['Payment']?>" /></td>
                  </tr>
              </table></td>
          </tr>
          <tr>
            <td colspan="2"><img src="<?=IMAGES?>/form2.png"><br>
              本公司尊重個人資料之私隱，並全力執行及遵守個人資料(私隱)條例，<br>
              有關個人資料條例可參閱 <a href="javascript:void(0)" onclick="window.open('rule.htm')">私隱條款及細則</a>。<br>
              "如不願意在日後收取Athena Intellects Co. Ltd. 及 A.I. Club 的推廣資訊,<br>
              可以電郵至 <a href="mailto:info@aiclub.com.hk" target="_top">info@aiclub.com.hk</a>" </td>
          </tr>
        </tbody>
      </table>
    </form></td>
</tr>
<script>
 /*
function formsubmit()
{
	if(!confirm("是否提交?"))
		return;
	else
	{
		document.myform.submit();;
	}
}*/


var CardTypeError 	= "<?=$lang['card_type_error']?>";
var CardError 		= "<?=$lang['card_error']?>";
var NumberError  	= "<?=$lang['number_error']?>";
var Cvv2Error 		= "<?=$lang['cvv2_error']?>";
var MonthError 		= "<?=$lang['month_error']?>";
var YearError 		= "<?=$lang['year_error']?>";

$().ready(function() {
	$("#myform").validate({
		rules: {
				card_type: { required: true },
				card_number: { required: true, number:true },
				cvv2: { required: true, number:true },
				exp_month: { required: true},
				exp_year: { required: true}
			   },
		messages: {
				card_type: { required: CardTypeError},
				card_number: { required: CardError, number: NumberError},
				cvv2: { required: Cvv2Error, number:NumberError },
				exp_month: { required: MonthError},
				exp_year: { required: YearError}
			}
	});
});


</script>