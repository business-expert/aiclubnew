<?php 

include_once(CONTROLLERS_ADMIN."/".$_REQUEST['model'].".php"); 

$msg = $objComm->getSessionMessage('users');
$arrStatus = $objComm->getAllStatus();

?>

<div>
    <ul class="breadcrumb">
        <li><a href="#"><?=$lang['Settings']?></a> <span class="divider">/</span></li>
        <li><a href="index.php?model=users"><?=$lang['User Type']?></a><span class="divider">/</span></li>        
        <li><a href="#"><?=$lang['All Users']?></a></li>
   </ul>
</div>
  <?=$msg?>
<div class="row-fluid sortable">
  <div class="box span12">
    <div class="box-header well" data-original-title>
      <h2><i class="icon-user"></i> <?=$lang['Users']?></h2>
      <div class="box-icon"></div>
    </div>
    <div class="box-content">
    <div class="page-header" style="padding-bottom:5px;margin:8px 0;"><h3><?=$lang['Search']?></h3></div>
    <form name="frm_search" id="frm_search" method="post" action="index.php?model=<?=$_REQUEST['model']?>">
    	<input type="hidden" name="action" id="action" value="" />
		<table  style="border:none;" cellpadding="4" cellspacing="2">
            <tr>
                <td align="right"><?=$lang['UserID']?> : <input type="search" name="sr_userid" id="sr_userid" value="<?=$_REQUEST['sr_userid']?>"  /></td>
                <td align="right"><?=$lang['Role']?> : <?=$objHTML->getUserRoleCombo('sr_role',$_REQUEST['sr_role'])?></td>
                <td align="right"><?=$lang['Status']?> : <?=$objHTML->statusBasicCombo('sr_status',$_REQUEST['sr_status'])?></td>                
				<td align="right">
                	<button style="margin:-13px 0px 0 0;" class="btn btn-large btn-success"><?=$lang['Search']?></button>
	                <button style="margin:-13px 0px 0 0;" class="btn btn-large btn-info" onclick="ResetSearch();"><?=$lang['Reset']?></button>
                </td>                
            </tr>
        </table>
        </form>
      <div class="page-header" style="padding-bottom:0px;margin:-10px 0;"></div>
      
      <div class="control-group" style="text-align:right;margin:20px 0 0 0;">
        <div class="controls"> 
           <a class="btn btn-success" href="index.php?model=users&action=add"><i class="icon-plus icon-white"></i> <?=$lang['Add New User']?> </a> 
        </div>
      </div>
      
      <table class="table table-bordered table-striped table-condensed datatable1">
        <thead>
          <tr>
            <th><?=$lang['UserID']?></th>
            <th><?=$lang['Role']?></th>
            <th><?=$lang['Created Datetime']?></th>
            <th><?=$lang['Status']?></th>            
            <th nowrap><?=$lang['Action']?></th>            
          </tr>
        </thead>
        <tbody>
        
        <?php 
			
			foreach($Records as $row)
			{
				$view   = "index.php?model=users&action=view&id=".$row->id;
				$edit   = "index.php?model=users&action=edit&id=".$row->id;
				$delete = "index.php?model=users&action=delete&id=".$row->id;

				$arrUserRole = $objComm->getUserRole($row->role);
				
				echo '<tr>'
					 .'<td>'.$row->userid.'</td>'
					 .'<td class="center">'.ucfirst($arrUserRole->user_type).'</td>'
					 .'<td class="center">'.$row->created_datetime.'</td>'
					 .'<td class="center"><span class="label '.$arrStatus[ucfirst($row->status)].'">'.ucfirst($row->status).'</span></td>'
					 .'<td class="center" nowrap>
					 	<a class="btn btn-success" href="'.$view.'"> <i class="icon-zoom-in icon-white"></i> '.$lang['View'].'</a> 
						<a class="btn btn-info" href="'.$edit.'"> <i class="icon-edit icon-white"></i> '.$lang['Edit'].'</a> 
						<a class="btn btn-danger" href="'.$delete.'"> <i class="icon-trash icon-white"></i> '.$lang['Delete'].'</a></td>'
					 .'</tr>';
			}
         ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<script>

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