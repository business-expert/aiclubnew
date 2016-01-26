<?php include_once(CONTROLLERS."/".$_REQUEST['model'].".php");  ?>

<tr>
  <td style="padding:20px"><table border="0" cellpadding="0" cellspacing="0">
      <tbody>
        <tr>
          <td style="width:35%"><table border="0" cellpadding="0" cellspacing="5" width="100%">
              <tbody>
                <tr>
                  <td><span style="background:#693A8B;padding:3px;color:#fff;"><b><?=$lang['Profile']?></b></span><br><br></td>
                  <td align="right"><a href="index.php?model=login&action=logout"><b><?=$lang['Logout']?></b></a></td>
                </tr>
                <tr>
                  <td style="width:60%"><?php  
					 	if(strtoupper($_REQUEST['action']) != '')
							 include_once(VIEWS."/profile/edit.php"); 
						else
							 include_once(VIEWS."/profile/profile.php"); 	 
					 ?></td>
                  <td  style="width:40%"><ul class="dashboard-list" style="border:none;">
                      <li style="border:none;">
                      	<a href='index.php?model=redeem'><img src="<?=IMAGES?>assessment.png"  height="30px" width="250px;"/></a></li>
                      <li style="border:none;">
                      	<a href="index.php?model=iq_test"><img src="<?=IMAGES?>iq_test.png"  height="30px" width="250px;"/></a></li>
                      <li style="border:none;"><a href="#"><img src="<?=IMAGES?>free_trial.png"  height="30px" width="250px;"/></a></li>
                      <li style="border:none;"><a href="#"><img src="<?=IMAGES?>voucher.png"  height="30px" width="250px;"/></a></li>
                    </ul></td>
                </tr>
                <tr>
                  <td><img src="<?=IMAGES?>/form2.png"><br>
                    本公司尊重個人資料之私隱，並全力執行及遵守個人資料(私隱)條例，<br>
                    有關個人資料條例可參閱 <a href="javascript:void(0)" onclick="window.open('rule.htm')">私隱條款及細則</a>。<br>
                    "如不願意在日後收取Athena Intellects Co. Ltd. 及 A.I. Club 的推廣資訊,<br>
                    可以電郵至 <a href="mailto:info@aiclub.com.hk" target="_top">info@aiclub.com.hk</a>" </td>
                   <td>
                   <table>
                   	<tr>
                    	<td><span style="background:#693A8B;padding:3px;color:#fff;"><b>News</b></span></td>
                    </tr>
                    <tr>
                    	<td><div><?=$NewsWidget?></div></td>
                    </tr>
                   </table>
                   </td> 
                </tr>
              </tbody>
            </table></td>
        </tr>
      </tbody>
    </table></td>
</tr>

<div id="myModal" class="modal hide">
    <div class="modal-header">
        <h3><?=$lang['News Details']?></h3>
    </div>
    <div class="modal-body">
		<p><h4 id='news_title'></h4></p>
		<p><h4 id='news_desc'></h4></p>
     </div>
    <div class="modal-footer">
        <a data-dismiss="modal" class="btn"><?=$lang['Close']?></a>
<button class="close" type="button"  onclick="javascript:hideModel();">×</button>        
    </div>
</div>


<script>

var fnameError 		= "<?=$lang['fname_error']?>";
var lnameError 		= "<?=$lang['lname_error']?>";
var contactError	= "<?=$lang['contact_error']?>";
var emailError  	= "<?=$lang['email_error']?>";
var emailValidError = "<?=$lang['email_valid_error']?>";
var emailEqualError = "<?=$lang['email_equal_error']?>";
var emailChange 	= "<?=$lang['email_change']?>";

$().ready(function() {
	$("#frmprofile").validate({
		rules: {
				data_fname: { required: true },
				data_lname: { required: true},
				data_contact_no: { required: true},
				data_email_address: { required: true, email:true}
			   },
		messages: {
				data_fname: { required: "<br>"+fnameError },
				data_lname: { required: "<br>"+lnameError},
				data_contact_no: { required: "<br>"+contactError},
				data_email_address: { required: "<br>"+emailError, email:"<br>"+emailValidError}
			}
	});
	
	function tick(){$('#ticker li:first').slideUp( function () { $(this).appendTo($('#ticker')).slideDown(); });}
	setInterval(function(){ tick () }, 5000);
});

function hideModel()
{
	$('#myModal').addClass('hide').removeClass('face');
}

function loadNews(newsid)
{
	$.ajax({
		type	: "GET",
		url		: "ajax.php",
		data    : "ajaxcall=true&mod=getNews&newsid="+newsid,
		success	: function(result)   {
					
					var json = ''+result+'',
				    obj = JSON.parse(json);

					$("#news_title").html(obj.title);
					$("#news_desc").html(obj.desc);		
					$('#myModal').addClass('fade').removeClass('hide');
				  }
	   });	
}

var popup = false;
var emailsend = false;

function showNotification(text)
{
	$("#dialog-description").html(text);
	$("#dialog").show();
}


function setChangeFlag()
{
	if(popup == false && $('#data_email_address').val() != $("#hid_email").val() && emailsend == false)
		popup = true;
}

function checkDuplicateEmail()
{
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
			   
		if(popup == true)
		{	
			showNotification(emailChange);	
			popup = false;	
			emailsend = true;
			$("#btn_submit").attr("disabled",true);
		}	   
	}
}


function hideDialog()
{
	$("#dialog").hide();
	$("#btn_submit").attr("disabled",false);
}

function reloadPage()
{
	location.reload(); 
}


</script>