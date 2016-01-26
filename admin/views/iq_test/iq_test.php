<?php 

include_once(CONTROLLERS_ADMIN."/".$_REQUEST['model'].".php"); 

$msg = $objComm->getSessionMessage('IQTest');

$arrDateName = array('data_examinee_birthy','data_examinee_birthm','data_examinee_birthd');
$arrDateID   = array('data_examinee_birthy','data_examinee_birthm','data_examinee_birthd');

?>

<div>
    <ul class="breadcrumb">
        <li><a href="#"><?=$lang['Members']?></a> <span class="divider">/</span></li>
        <li><a href="#"><?=$lang['All IQ Test']?></a></li>
   </ul>
</div>
  <?=$msg?><?=$msg1?>
<div class="row-fluid sortable">
  <div class="box span12">
    <div class="box-header well" data-original-title>
      <h2><i class="icon-user"></i> <?=$lang['IQ Test']?></h2>
      <div class="box-icon"></div>
    </div>
    <div class="box-content">
    <div class="page-header" style="padding-bottom:5px;margin:8px 0;"><h3><?=$lang['Search']?></h3></div>
    <form name="frm_search" id="frm_search" method="post" action="index.php?model=<?=$_REQUEST['model']?>">
    	<input type="hidden" name="action" id="action" value="" />
		<table  style="border:none;" cellpadding="4" cellspacing="2">
            <tr>
                <td align="right"  valign="top"><?=$lang['Name']?> : <input type="search" name="sr_name" id="sr_name" value="<?=$_REQUEST['sr_name']?>"  /></td>
                 <td align="right"  valign="top"><?=$lang['Member']?> : <?=$objHTML->allMembersComboBox('sr_member_id', $_REQUEST['sr_member_id'], '')?></td>
                <td align="right" valign="top">
                	<button style="" class="btn btn-small btn-success"><?=$lang['Search']?></button>
	                <button style="" class="btn btn-small btn-info" onclick="ResetSearch();"><?=$lang['Reset']?></button>
                </td>                
            </tr>
        </table>
        </form>
        <div class="page-header" style="padding-bottom:0px;margin:-10px 0;"></div>
      
      <div class="control-group" style="text-align:right;margin:20px 0 0 0;">
        <div class="controls"> 
           <a class="btn btn-success" href="index.php?model=iq_test&action=add"><i class="icon-plus icon-white"></i> <?=$lang['Add IQ Test']?> </a> 
        </div>
      </div>
      
      <table class="table table-bordered table-striped table-condensed datatable1">
        <thead>
          <tr>
            <th><?=$lang['First Name']?></th>
            <th><?=$lang['Last Name']?></th>
            <th><?=$lang['Birth Date']?></th>
            <th><?=$lang['Gender']?></th>
            <th><?=$lang['Handedness']?></th>
            <th><?=$lang['Member']?></th>
            <th><?=$lang['Date Created']?></th>            
            <th nowrap><?=$lang['Action']?></th>            
          </tr>
        </thead>
        <tbody>
        
        <?php 
			
			foreach($Records as $row)
			{
				//echo "<pre>"; print_r($row); die(__FILE__."--".__LINE__);
				$view   = "index.php?model=".$_REQUEST['model']."&action=view&id=".$row->examinee_id;
				$edit   = "index.php?model=".$_REQUEST['model']."&action=edit&id=".$row->examinee_id;
				$delete = "index.php?model=".$_REQUEST['model']."&action=delete&id=".$row->examinee_id;
				
				echo '<tr>'
					 .'<td>'.$row->examinee_firstn.'</td>'
					 .'<td class="center">'.$row->examinee_lastn.'</td>'
					 .'<td class="center">'.$row->examinee_birthy.'-'.$row->examinee_birthm.'-'.$row->examinee_birthd.'</td>'
					 .'<td class="center">'.$row->examinee_gender.'</td>'
					 .'<td class="center">'.$row->examinee_handedness.' </td>'
					 .'<td class="center">'.$objComm->getMemberBasedOnID($row->member_id,'fname').' </td>'
					 .'<td class="center">'.$row->date_added.' </td>'
					 .'<td class="center" nowrap>
					 	<a class="btn btn-success" href="'.$view.'"> <i class="icon-zoom-in icon-white"></i></a> 
						<a class="btn btn-info" href="'.$edit.'"> <i class="icon-edit icon-white"></i></a> 
						<a class="btn btn-danger" href="'.$delete.'"> <i class="icon-trash icon-white"></i></a></td>'
					 .'</tr>';
			}
			
         ?>
        
        </tbody>
      </table>
    </div>
  </div>
  <!--/span--> 
  
</div>

<script>

//"sDom":'<"bottom"<"clear">>rt<"bottom"iflp<"clear">>'
//"sDom": "<'top'<'row-fluid'<'span6'><'span6'f>r>t<'row-fluid'<'span12'i><'span12 center'p>>",	

$( document ).ready(function() {
	$('.datatable1').dataTable({
		"sDom": "<'row-fluid'<'span6'><'span6'f>r>t<'row-fluid'<'span12'i><'span12 center'p>>",
		"sPaginationType": "bootstrap",
		"oLanguage": {"sLengthMenu": "_MENU_ records per page"},
	    "bFilter": false,
	} );
});


function ResetSearch()
{
	$("#frm_search input,select").val('');
	$("#frm_search").submit();
}

	
</script>		