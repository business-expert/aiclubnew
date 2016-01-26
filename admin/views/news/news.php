<?php 

include_once(CONTROLLERS_ADMIN."/".$_REQUEST['model'].".php"); 

$msg = $objComm->getSessionMessage('news');
$arrStatus = $objComm->getAllStatus();
$arrNewsAdminStatus = $objComm->getNewsAdminStatus();

?>

<div>
    <ul class="breadcrumb">
        <li><a href="#"><?=$lang['Settings']?></a> <span class="divider">/</span></li>
        <li><a href="index.php?model=users"><?=$lang['News']?></a><span class="divider">/</span></li>        
        <li><a href="#"><?=$lang['All News']?></a></li>
   </ul>
</div>
  <?=$msg?>
<div class="row-fluid sortable">
  <div class="box span12">
    <div class="box-header well" data-original-title>
      <h2><i class="icon-user"></i> <?=$lang['News']?></h2>
      <div class="box-icon"></div>
    </div>
    <div class="box-content">
    <div class="page-header" style="padding-bottom:5px;margin:8px 0;"><h3><?=$lang['Search']?></h3></div>
    <form name="frm_search" id="frm_search" method="post" action="index.php?model=<?=$_REQUEST['model']?>">
    	<input type="hidden" name="action" id="action" value="" />
		<table  style="border:none;" cellpadding="4" cellspacing="2">
            <tr>
                <td align="right"><?=$lang['News Title']?> : <input type="search" name="sr_news_title" id="sr_news_title" value="<?=$_REQUEST['sr_news_title']?>"  /></td>
                <td align="right"></td>
                <td align="right"></td>                
				<td align="right">
                	<button style="margin:-13px 0px 0 0;" class="btn btn-small btn-success"><?=$lang['Search']?></button>
	                <button style="margin:-13px 0px 0 0;" class="btn btn-small btn-info" onclick="ResetSearch();"><?=$lang['Reset']?></button>         </td>                
            </tr>
        </table>
        </form>
      <div class="page-header" style="padding-bottom:0px;margin:-10px 0;"></div>
      
      <div class="control-group" style="text-align:right;margin:20px 0 0 0;">
        <div class="controls"> 
           <a class="btn btn-success" href="index.php?model=news&action=add"><i class="icon-plus icon-white"></i> <?=$lang['Add News']?> </a> 
        </div>
      </div>
      
      <table class="table table-bordered table-striped table-condensed datatable1">
        <thead>
          <tr>
            <th><?=$lang['News Title']?></th>
            <th><?=$lang['News Description']?></th>
            <th nowrap><?=$lang['Created By']?></th>
            <th nowrap><?=$lang['Created DateTime']?></th>
            <th nowrap><?=$lang['Admin Status']?></th>
            <th nowrap><?=$lang['Status']?></th>            
            <th nowrap><?=$lang['Action']?></th>            
          </tr>
        </thead>
        <tbody>
        
        <?php 
			
			foreach($Records as $row)
			{
				$view   = "index.php?model=news&action=view&id=".$row->id;
				$edit   = "index.php?model=news&action=edit&id=".$row->id;
				$delete = "index.php?model=news&action=delete&id=".$row->id;

				$desc	   = strip_tags($row->news_desc);
				$NewsDesc  = (strlen($desc) > 130) ? substr($desc, 0, 130).' . . .' : $desc;
				$CreatedBy = $objComm->getMemberBasedOnID($row->created_by,'fname');
				
				echo '<tr>'
					 .'<td>'.$row->news_title.'</td>'
					 .'<td class="center">'.$NewsDesc.'</td>'
					 .'<td class="center">'.$CreatedBy.'</td>'					 
					 .'<td class="center">'.$row->created_datetime.'</td>'
					 .'<td class="center"><span class="label '.$arrNewsAdminStatus[ucfirst($row->admin_status)].'">'.ucfirst($row->admin_status).'</span></td>'				 
					 .'<td class="center"><span class="label '.$arrStatus[ucfirst($row->status)].'">'.ucfirst($row->status).'</span></td>'
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