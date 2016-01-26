<?php 
include_once(CONTROLLERS_ADMIN."/".$_REQUEST['model'].".php"); 

$msg = $objComm->getSessionMessage('alliance');
$arrStatus = $objComm->getAllStatus();

?>

<div>
    <ul class="breadcrumb">
        <li><a href="#">Alliances</a> <span class="divider">/</span></li>
        <li><a href="#">All Alliances</a></li>
   </ul>
</div>
  <?=$msg?>
<div class="row-fluid sortable">
  <div class="box span12">
    <div class="box-header well" data-original-title>
      <h2><i class="icon-user"></i> Alliances</h2>
      <div class="box-icon"> <!--<a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a> <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a> <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a> --></div>
    </div>
    <div class="box-content">
     <div class="page-header" style="padding-bottom:5px;margin:8px 0;"><h3>Advanced Search</h3></div>
    <form name="frm_search" id="frm_search" method="post" action="index.php?model=<?=$_REQUEST['model']?>">
    	<input type="hidden" name="action" id="action" value="" />
		<table  style="border:none;" cellpadding="4" cellspacing="2">
            <tr>
                <td align="right">Name : <input type="search" name="sr_name" id="sr_name" value="<?=$_REQUEST['sr_name']?>"  /></td>
                <td align="right">Business Name : <input type="search" name="sr_business_name" id="sr_business_name" value="<?=$_REQUEST['sr_business_name']?>"  /></td>
                <td align="right">Adddress: <input type="search" name="sr_address" id="sr_address" value="<?=$_REQUEST['sr_address']?>"  /></td>
                <td align="right"></td>
            </tr>
            <tr>
                <td align="right">Email : <input type="search" name="sr_email" id="sr_email" value="<?=$_REQUEST['sr_email']?>"  /></td>
                <td align="right">Category : <?=$objHTML->categoryBasicCombo('sr_category',$_REQUEST['sr_category'])?></td>
                <td align="right">Status : <?=$objHTML->statusBasicCombo('sr_status',$_REQUEST['sr_status'])?></td>                
                <td align="right">
                	<button style="margin:-13px 0px 0 0;" class="btn btn-large btn-success">Search</button>
	                <button style="margin:-13px 0px 0 0;" class="btn btn-large btn-info" onclick="ResetSearch();">Reset</button>
                </td>                
            </tr>
        </table>
        </form>
        <div class="page-header" style="padding-bottom:0px;margin:-10px 0;"></div>
        
         <div class="control-group" style="text-align:right;margin:20px 0 0 0;">
        <div class="controls"> 
           <a class="btn btn-success" href="index.php?model=alliance&action=add"><i class="icon-plus icon-white"></i> Add New Alliance </a> 
        </div>
      </div>
      
      <table class="table table-striped table-bordered bootstrap-datatable datatable1">
        <thead>
          <tr>
          	<th>Alliance #</th>
            <th>Name</th>
            <th>Business Name</th>
            <!--<th>Office Address</th>-->
            <th>Category</th>
            <th>Contact No</th>
            <th>Email</th>
            <th>Created On</th>
            <th>Status</th>
            <th nowrap>Action</th>
          </tr>
        </thead>
        <tbody>
        
        <?php 
			
			foreach($Records as $row)
			{
				$view = "index.php?model=alliance&action=view&id=".$row->id;
				$edit = "index.php?model=alliance&action=edit&id=".$row->id;
				$delete = "index.php?model=alliance&action=delete&id=".$row->id;
				
				echo '<tr>'
				     .'<td class="center">'.$row->alliance_id.'</td>'
					 .'<td class="center">'.$row->fname.' '.$row->lname.'</td>'
					 .'<td class="center">'.$row->business_name.'</td>'					 
					// .'<td class="center">'.$row->location.'</td>'
					 .'<td class="center">'.$row->category.'</td>'					 
					 .'<td class="center">'.$row->contact_no.'</td>'
					 .'<td class="center">'.$row->email.'</td>'
					 .'<td class="center">'.$row->created_datetime.'</td>'
					 .'<td class="center"><span class="label '.$arrStatus[$row->status].'">'.$row->status.'</span></td>'
					 .'<td class="center" nowrap>
					 	<a class="btn btn-success" href="'.$view.'"> <i class="icon-zoom-in icon-white"></i></a> 
						<a class="btn btn-info" href="'.$edit.'"> <i class="icon-edit icon-white"></i></a> 
						<a class="btn btn-danger" href="'.$delete.'"> <i class="icon-trash icon-white"></i></a></td>'
					/* .'<td class="center" nowrap>
						<div class="btn-group open">
							<button class="btn btn-large">Action</button>
							<button data-toggle="dropdown" class="btn btn-large dropdown-toggle"><span class="caret"></span></button>
							<ul class="dropdown-menu">
								<li><a href="'.$view.'"><i class="icon-zoom-in"></i> View</a></li>
								<li><a href="'.$edit.'"><i class="icon-edit"></i> Edit</a></li>
								<li><a href="'.$delete.'"><i class="icon-trash"></i> Delete</a></li>
							</ul>
						</div>'*/
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