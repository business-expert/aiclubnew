<?php 

include_once(CONTROLLERS."/member.php"); 

$msg = $objComm->getSessionMessage('member');

$arrDateName = array('date_year','date_month','date_date');
$arrDateID = array('date_year','date_month','date_date');
$arrDateVal = $row->birth_date;

?>

 <tr>
        <td style="padding:20px"><form  name="myform" id="myform" class="form-horizontal" method="post" action="index.php">
  <input type="hidden" name="action" id="action" value="save" />
  <input type="hidden" name="model" id="model" value="<?=$_REQUEST['model']?>" />
            <table border="0" cellpadding="0" cellspacing="0">
              <tbody>
                <tr>
                  <td style="width:35%"><table border="0" cellpadding="0" cellspacing="5" width="100%">
                      <tbody>
                        <tr>
                          <td colspan="2"><span style="background:#693A8B;padding:3px;color:#fff;"><b><?=$lang['Member Profile']?></b></span><br>
                            <br></td>
                        </tr>
                        <tr>
                          <td>*<?=$lang['First Name']?>:</td>
                          <td><input id="data_fname" name="data_fname" required type="text"></td>
                        </tr>
                        <tr>
                          <td>*<?=$lang['Last Name']?>:</td>
                          <td><input id="data_lname" name="data_lname" required type="text"></td>
                        </tr>
                        
                        <tr>
                          <td>*<?=$lang['Date of Birth']?>:</td>
                          <td> <?=$objHTML->basicDateCombo($arrDateName, $arrDateID, $arrDateVal);?></td>
                        </tr>
                        <tr>
                          <td>*<?=$lang['Gender']?>:</td>
                          <td> <?=$objHTML->genderBasicCombo('data_gender',$row->gender)?></td>
                        </tr>
                        <tr>
                          <td>*<?=$lang['Contact No']?>:</td>
                          <td><input required id="data_contact_no" name="data_contact_no" type="number"></td>
                        </tr>
                        <tr>
                          <td>*<?=$lang['Email']?>:</td>
                          <td><input required id="data_email_address" name="data_email_address" type="text" onchange="checkDuplicateEmail();"><span id="ajax_email" style="color:red;"></span></td>
                        </tr>
                        <tr>
                          <td>*<?=$lang['Re-enter Email']?>:</td>
                          <td><input required id="confirm_email_address" name="confirm_email_address" type="email" data-validation-matches-match="data_email_address" data-validation-matches-message="Must match email address entered above" ></td>
                        </tr>
                        <tr>
                          <td>*<?=$lang['Location']?>:</td>
                          <td> <?=$lang['Region']?>:
                            <select id="data_region" name="data_region" required>
                              <option selected="selected" value="">- 請選擇 -</option>
                              <option value="i">香港島</option>
                              <option value="k">九龍</option>
                              <option value="n">新界/離島</option>
                              <option value="o">其他</option>
                            </select></td>
                        </tr>
                        <tr>
                          <td>&nbsp;</td>
                          <td> <?=$lang['District']?>:
                            <select id="data_district" name="data_district" required>
                              <option selected="selected" value="">- 請選擇 -</option>
                              <option value="Aberdeen/Ap Lei Chau|i">香港仔/鴨脷洲</option>
                              <option value="Causeway Bay|i">銅鑼灣</option>
                              <option value="Central/Sheung Wan|i">中環/上環</option>
                              <option value="Chai Wan|i">柴灣</option>
                              <option value="Happy Valley/Wong Nai Chung|i">跑馬地/黃泥涌</option>
                              <option value="Island South|i">南區</option>
                              <option value="Kennedy Town/Sai Ying Pun|i">堅尼地城/西營盤</option>
                              <option value="Mid-Levels|i">半山</option>
                              <option value="North Point|i">北角</option>
                              <option value="Pokfulam|i">薄扶林</option>
                              <option value="Quarry Bay|i">鰂魚涌</option>
                              <option value="Sai Wan Ho|i">西灣河</option>
                              <option value="Shaukeiwan|i">筲箕灣</option>
                              <option value="Tai Hang/JardineLookout|i">大坑/渣甸山</option>
                              <option value="The Peak|i">山頂</option>
                              <option value="Wanchai|i">灣仔</option>
                              <option value="Wong Chuk Hang|i">黃竹坑</option>
                              <option value="Cheung Sha Wan/Laichikok|k">長沙灣/荔枝角</option>
                              <option value="Diamond Hill|k">鑽石山</option>
                              <option value="Hung Hom|k">紅磡</option>
                              <option value="Kowloon Bay|k">九龍灣</option>
                              <option value="Kowloon City|k">九龍城</option>
                              <option value="Kowloon Tong|k">九龍塘</option>
                              <option value="Kwun Tong/Sau Mau Ping|k">觀塘/秀茂坪</option>
                              <option value="Lam Tin|k">藍田</option>
                              <option value="Mongkok/Ho Man Tin|k">旺角/何文田</option>
                              <option value="Ngau Chi Wan/Choi Hung|k">牛池灣/彩虹</option>
                              <option value="Ngau Tau Kok|k">牛頭角</option>
                              <option value="San Po Kong/Tsz Wan Shan|k">新蒲崗/慈雲山</option>
                              <option value="Shamshuipo|k">深水埗</option>
                              <option value="Shek Kip Mei/Yau Yat Chuen|k">石硤尾/又一村</option>
                              <option value="Tai Kok Tsui|k">大角咀</option>
                              <option value="Tokwawan|k">土瓜灣</option>
                              <option value="Tsimshatsui|k">尖沙咀</option>
                              <option value="Wong Tai Sin/Wan Tau Hom|k">黃大仙/橫頭磡</option>
                              <option value="Yau Tong/Cha Kwo Ling|k">油塘/茶果嶺</option>
                              <option value="Yaumatei|k">油麻地</option>
                              <option value="Fanling|n">粉嶺</option>
                              <option value="Kwai Chung|n">葵涌</option>
                              <option value="Lai King|n">荔景</option>
                              <option value="Lantau/Outlying Islands|n">大嶼山/離島</option>
                              <option value="Ma On Shan|n">馬鞍山</option>
                              <option value="Sai Kung/Clearwater Bay|n">西貢/清水灣</option>
                              <option value="Sham Tseng/Tsing Lung Tau|n">深井/青龍頭</option>
                              <option value="Shatin|n">沙田</option>
                              <option value="Sheung Shui|n">上水</option>
                              <option value="Tai Po|n">大埔</option>
                              <option value="Tseung Kwan O|n">將軍澳</option>
                              <option value="Tsing Yi|n">青衣</option>
                              <option value="Tsuen Wan|n">荃灣</option>
                              <option value="Tuen Mun|n">屯門</option>
                              <option value="Yuen Long/Tin Shui Wai|n">元朗/天水圍</option>
                              <option value="o|o">其他</option>
                            </select></td>
                        </tr>
                        <tr>
                          <td>*<?=$lang['Address']?>:</td>
                          <td><input id="data_address" name="data_address" type="text" required></td>
                        </tr>
                        <tr>
                          <td><?=$lang['Occupation']?>:</td>
                          <td><input id="data_occupation" name="data_occupation" type="text" ></td>
                        </tr>
                        <tr>
                          <td><?=$lang['Education Level']?>:</td>
                          <td> <?=$objHTML->educationCombo('data_education_level',$row->education_level)?></td>
                        </tr>
                        <tr>
                          <td><?=$lang['Income']?>:</td>
                          <td><?=CURRENCY?> <input id="data_income" name="data_income" type="text"></td>
                        </tr>
                        <tr>
                          <td><?=$lang['Marital Status']?>:</td>
                          <td><?=$objHTML->marrigeCombo('data_marriage_status',$row->marriage_status)?></td>
                        </tr>
                      </tbody>
                    </table></td>
                  <td style="width:35%"><table border="0" cellpadding="0" cellspacing="5" width="100%">
                      <tbody>
                        <tr>
                          <td colspan="2"><span style="background:#693A8B;padding:3px;color:#fff;"><b><?=$lang['Information on a child']?></b></span><br>
                            <br></td>
                        </tr>
                        <tr>
                          <td><?=$lang['Child\'s surname']?>:</td>
                          <td><input id="child_fname_0" name="child_fname[]" type="text"></td>
                        </tr>
                        <tr>
                          <td><?=$lang['Children Name']?>:</td>
                          <td><input id="child_lname_0" name="child_lname[]" type="text"></td>
                        </tr>
                        <tr>
                          <td><?=$lang['Age']?>:</td>
                          <td><input id="profile_age" name="profile_age" type="text"></td>
                        </tr>
                        <tr>
                          <td><?=$lang['Date of Birth']?>:</td>
                          <td><?php 
								$arrChildDateName = array('child_date_year[]','child_date_month[]','child_date_date[]');
								$arrChildDateID   = array('child_date_year_0','child_date_month_0','child_date_date_0');
							
								echo $objHTML->basicDateCombo($arrChildDateName, $arrChildDateID, '');
							?>
                        </td>
                        </tr>
                        <tr>
                          <td><?=$lang['Gender']?>:</td>
                          <td><select style='width:80px;' name="child_gender[]" id="child_gender_0" >
                                <option value=""> <?=$lang['SELECT']?> </option>
                                <option value="M"><?=$lang['Male']?></option>
                                <option value="F"><?=$lang['Female']?></option>
                              </select></td>
                        </tr>
                        <tr>
                          <td colspan="2"><br>
                            <br>
                            <span style="background:#693A8B;padding:3px;color:#fff;"><b><?=$lang['Information on two children']?></b></span><br>
                            <br></td>
                        </tr>
                        <tr>
                          <td><?=$lang['Child\'s surname']?>:</td>
                          <td><input id="child_fname_1" name="child_fname[]" type="text"></td>
                        </tr>
                        <tr>
                          <td><?=$lang['Children Name']?>:</td>
                          <td><input id="child_lname_1" name="child_lname[]" type="text"></td>
                        </tr>
                        <tr>
                          <td><?=$lang['Age']?>:</td>
                          <td><input id="profile2_age" name="profile2_age" type="text"></td>
                        </tr>
                        <tr>
                          <td><?=$lang['Date of Birth']?>:</td>
                          <td><?php 
								$arrChildDateName = array('child_date_year[]','child_date_month[]','child_date_date[]');
								$arrChildDateID   = array('child_date_year_1','child_date_month_1','child_date_date_1');
							
								echo $objHTML->basicDateCombo($arrChildDateName, $arrChildDateID, '');
							?></td>
                        </tr>
                        <tr>
                          <td><?=$lang['Gender']?>:</td>
                          <td><select style='width:80px;' name="child_gender[]" id="child_gender_1" >
                                <option value=""> <?=$lang['SELECT']?> </option>
                                <option value="M"><?=$lang['Male']?></option>
                                <option value="F"><?=$lang['Female']?></option>
                              </select></td>
                        </tr>
                        <tr>
                          <td colspan="2">
                        <img src="<?=IMAGES?>/btn-reset.png" onclick="formreset()" style="cursor:pointer"> 
                        <input type="image" src="<?=IMAGES?>/btn-submit.png"  name="btn_submit" id="btn_submit" value="Submit" style="width:120px;height:28px;" /></td>
                        </tr>
                      </tbody>
                    </table></td>
                  <td rowspan="2" style="width:30%"><table border="0" cellpadding="0" cellspacing="5" width="100%">
                      <tbody>
                        <tr>
                          <td><span style="background:#693A8B;padding:3px;color:#fff;"><b>購買資料</b></span><br>
                            <br></td>
                        </tr>
                        <tr>
                          <td><label style="color:#999">
                              <input id="membership_bp" name="membership[]" value="BP" style="width:10px" type="checkbox">
                              A.I. Club基本迎新會籍  </label>
                            <br>
                            <img src="<?=IMAGES?>/planning1.png" width="100%"></td>
                        </tr>
                         <tr>
                         <td><label style="color:#999">
                              <input id="membership_mits" name="membership[]" value="MITS" style="width:10px" type="checkbox">
                              A.I. Club升級迎新會籍(多元智能檢測版) </label>
                            <br>
                            <img src="<?=IMAGES?>/planning2.png" width="100%"></td>
                        </tr>

                        <tr>
                          <td><label style="color:#999">
                              <input id="membership_IQ" name="membership[]" value="IQ" style="width:10px" type="checkbox">
                              A.I. Club升級迎新服 籍(IQ檢測版) </label>
                            <br>
                            <img src="<?=IMAGES?>/planning3.png" width="100%"></td>
                        </tr>
                        
                      </tbody>
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

function formsubmit()
{
	if(!confirm("是否提交?"))
		return;
	else
	{
		if($("input:checkbox[name='membership[]']:checked").size() == 0)
		{
			alert("请选择会员类型");
			return ;
		}
		else
			document.myform.submit();;
	}
}

function formreset()
{
	if(!confirm("是否提交?"))
		return;
	else
		location.reload(true);
}

var fnameError 		= "<?=$lang['fname_error']?>";
var lnameError 		= "<?=$lang['lname_error']?>";
var genderError 	= "<?=$lang['gender_error']?>";
var contactError	= "<?=$lang['contact_error']?>";
var emailError  	= "<?=$lang['email_error']?>";
var emailValidError = "<?=$lang['email_valid_error']?>";
var emailEqualError = "<?=$lang['email_equal_error']?>";
var regionError 	= "<?=$lang['region_error']?>";
var districtError   = "<?=$lang['district_error']?>";
var addressError    = "<?=$lang['address_error']?>";
var membershipError = "<?=$lang['membership_error']?>";

$().ready(function() {
	$("#myform").validate({
		rules: {
				data_fname: { required: true },
				data_lname: { required: true},
				data_gender: { required: true},
				data_contact_no: { required: true},
				data_email_address: { required: true, email:true},
				confirm_email_address: { required: true, email:true, equalTo:"#data_email_address"},
				data_region: { required: true},
				data_district: { required: true},
				data_address: { required: true},
				"membership[]":{required: true, minlength:1}
			   },
		messages: {
				data_fname: { required: "<br>"+fnameError },
				data_lname: { required: "<br>"+lnameError},
				data_gender:{ required: "<br>"+genderError},
				data_contact_no: { required: "<br>"+contactError},
				data_email_address: { required: "<br>"+emailError, email:"<br>"+emailValidError},
				confirm_email_address: { required: "<br>"+emailError, email: "<br>"+emailValidError, equalTo: "<br>"+emailEqualError},
				data_region:{ required: "<br>"+regionError},
				data_district: { required: "<br>"+districtError},
				data_address: { required: "<br>"+addressError},
				"membership[]":{required: "<br>"+membershipError+"<br>", minlength:"<br>"+membershipError+"<br>"}
			}
	});
});

function checkDuplicateEmail()
{
	// Normal ajax request in your application
	if($('#data_email_address').val().length > 10)
	{
		$.ajax({
				type	: "GET",
				url		: "ajax.php",
				beforeSend: function () 
							{
							 // $("#span_cycle").html("<div class='ajax_loaing'><img src='webroot/img/loading.gif' /></div>");
							},
				data    : "ajaxcall=true&mod=checkUniqEmail&email="+$("#data_email_address").val(),
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