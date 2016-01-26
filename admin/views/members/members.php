<?php 

include_once(CONTROLLERS_ADMIN."/".$_REQUEST['model'].".php"); 

$msg = $objComm->getSessionMessage('members');
$msg1 = $objComm->getSessionMessage('email');
$arrStatus = $objComm->getAllStatus();
$arrRegion = $objComm->getAllRegion();
$arrDistrict = $objComm->getAllDistrict();

?>

<div>
    <ul class="breadcrumb">
        <li><a href="#"><?=$lang['Members']?></a> <span class="divider">/</span></li>
        <li><a href="#"><?=$lang['All Members']?></a></li>
   </ul>
</div>
  <?=$msg?><?=$msg1?>
<div class="row-fluid sortable">
  <div class="box span12">
    <div class="box-header well" data-original-title>
      <h2><i class="icon-user"></i> <?=$lang['Members']?></h2>
      <div class="box-icon"></div>
    </div>
    <div class="box-content">
    <div class="page-header" style="padding-bottom:5px;margin:8px 0;"><h3><?=$lang['Advanced Search']?></h3></div>
    <form name="frm_search" id="frm_search" method="post" action="index.php?model=<?=$_REQUEST['model']?>">
    	<input type="hidden" name="action" id="action" value="" />
		<table  style="border:none;" cellpadding="4" cellspacing="2">
            <tr>
                <td align="right"><?=$lang['Name']?> : <input type="search" name="sr_name" id="sr_name" value="<?=$_REQUEST['sr_name']?>"  /></td>
                <td align="right"><?=$lang['Address']?> : <input type="search" name="sr_address" id="sr_address" value="<?=$_REQUEST['sr_address']?>"  /></td>
                <td align="right"><?=$lang['Phone No']?> : <input type="search" name="sr_phone_no" id="sr_phone_no" value="<?=$_REQUEST['sr_phone_no']?>"  /></td>
                <td align="right"></td>
            </tr>
            <tr>
                <td align="right"><?=$lang['Email']?> : <input type="search" name="sr_email" id="sr_email" value="<?=$_REQUEST['sr_email']?>"  /></td>
                <td align="right"><?=$lang['Age']?> : 
                <?=$objHTML->searchAgeCombo('sr_age_compare',$_REQUEST[sr_age_compare]);?>
                <input type="search" style="width:158px;" name="sr_age" id="sr_age" value="<?=$_REQUEST['sr_age']?>"  /></td>
                <td align="right"><?=$lang['Status']?> : <?=$objHTML->statusBasicCombo('sr_status',$_REQUEST['sr_status'])?></td>                
                <td align="right">
                	<button style="margin:-13px 0px 0 0;" class="btn btn-large btn-success"><?=$lang['Search']?></button>
	                <button style="margin:-13px 0px 0 0;" class="btn btn-large btn-info" onclick="ResetSearch();"><?=$lang['Reset']?></button>
                </td>                
            </tr>
        </table>
        </form>
        <div class="page-header" style="padding-bottom:0px;margin:-10px 0;"></div>
	  <!-- <table class="table table-striped table-bordered bootstrap-datatable datatable"> -->
      
      
      <div class="control-group" style="text-align:right;margin:20px 0 0 0;">
        <div class="controls"> 
           <a class="btn btn-success" href="index.php?model=members&action=add"><i class="icon-plus icon-white"></i> <?=$lang['Add New Member']?> </a> 
        </div>
      </div>
      
      <table class="table table-bordered table-striped table-condensed datatable1">
        <thead>
          <tr>
            <th><?=$lang['Member']?> #</th>
            <th><?=$lang['Name']?></th>
            <th><?=$lang['Address']?></th>
            <th><?=$lang['Phone No']?></th>
            <th><?=$lang['Email']?></th>
            <th><?=$lang['Birth Date']?></th>
            <th><?=$lang['Status']?></th>
            <th nowrap><?=$lang['Action']?></th>            
          </tr>
        </thead>
        <tbody>
        
        <?php 
			
			foreach($Records as $row)
			{
				$address = $row->address.", ".$arrRegion[$row->region].", ".$arrDistrict[$row->district];
				
				$view   = "index.php?model=members&action=view&id=".$row->id;
				$edit   = "index.php?model=members&action=edit&id=".$row->id;
				$delete = "index.php?model=members&action=delete&id=".$row->id;
				
				echo '<tr>'
					 .'<td>'.$row->membership_id.'</td>'
					 .'<td class="center">'.$row->fname.' '.$row->lname.'</td>'
					 .'<td class="center">'.$address.'</td>'
					 .'<td class="center">'.$row->contact_no.'</td>'
					 .'<td class="center">'.$row->email_address.'</td>'
					 .'<td class="center">'.$row->birth_date.' </td>'
					 .'<td class="center"><span class="label '.$arrStatus[$row->status].'">'.$lang[$row->status].'</span></td>'
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