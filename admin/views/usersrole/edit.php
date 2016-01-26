<?php 
include_once(CONTROLLERS_ADMIN."/".$_REQUEST['model'].".php"); 

$msg = $objComm->getSessionMessage('usersrole');

?>

<div>
  <ul class="breadcrumb">
        <li><a href="#"><?=$lang['Settings']?></a> <span class="divider">/</span></li>
        <li><a href="index.php?model=usersrole"><?=$lang['User Role']?></a><span class="divider">/</span></li>        
        <li><a href="#"><?=$lang['Edit User Role']?></a></li>
   </ul>
</div>
<div class="row-fluid sortable">
  <div class="box span12">
    <div class="box-header well" data-original-title>
      <h2><i class="icon-user"></i> <?=$lang['User Role']?></h2>
      <div class="box-icon"></div>
    </div>
    <div class="box-content">
      <div class="box-content">
        <?=$msg?>
        <form class="form-horizontal" method="post" action="index.php">
        <input type="hidden" name="action" id="action" value="UPDATE" />
        <input type="hidden" name="model" id="model" value="<?=$_REQUEST['model']?>" />
        <input type="hidden" name="pk_id" id="pk_id" value="<?=$_REQUEST['id']?>" />
          <fieldset>
            <div class="control-group">
              <label class="control-label" for="typeahead"><?=$lang['User Role']?></label>
			  <div class="controls">
                <input type="text" required value="<?=ucfirst(strtolower($row->user_type))?>" id="data_user_type" name="data_user_type" class="input-xsmall focused">
              </div>
            </div>
          
            
             <div class="control-group">
              <label class="control-label" for="name"><?=$lang['Permission']?></label>
              <div class="controls">
                 <span class="input-xlarge uneditable-input" style="width:100px;"><?=$lang['Module Name']?></span>
                 <span class="input-xlarge uneditable-input" style="width:500px;"><?=$lang['Permissions']?></span>
                 </div>
              	<?php
				
				foreach($rowModule as $arrRow)
				{
					$arrAccess = explode(",",strtoupper($arrRow->module_access));
					$arrCheck  = array();
					
					$arrModuleProp = explode(",",strtoupper($arrRow->mod_permission));
					
					foreach($arrModuleProp as $key => $checkbox)
					{
						$checked = (in_array($checkbox, $arrAccess)) ? "checked='checked'" : "";
						
						$arrCheck[] = '<label class="checkbox inline" style="padding-left:0px;">'
										.'<div class="checker" id="uniform-inlineCheckbox3"><span><input type="checkbox" value="'.$checkbox.'" id="'.strtolower($arrRow->module_name).$key.'" name="perm_'.strtolower($arrRow->module_name).'[]" style="opacity: 0;" '.$checked.' parent="'.strtolower($arrRow->module_name).'">'
										.'</span></div>'.strtoupper($checkbox).'</label>';
					}
								
					$strCheckBox = '<div class="controls" style="margin:-6px 0 0 0;">'.implode(" ",$arrCheck).'</div>';
					
					$ModuleCheckBox = '<div class="controls" style="margin:-6px 0 0 0;">
										<label class="checkbox inline" style="padding-left:0px;">'
										.'<div class="checker" id="uniform-inlineCheckbox3"><span><input type="checkbox" value="'.strtolower($arrRow->module_name).'" id="'.strtolower($arrRow->module_name).'" name="module_permission[]" style="opacity: 0;" '.$ModuleChecked.'>'
										.'</span></div>'.ucfirst($arrRow->module_name).'</label></div>';
										
              		echo '<div class="controls">'
						 .'<span class="input-xlarge uneditable-input" style="width:100px;"> '.$ModuleCheckBox.' </span>&nbsp;'
						 .'<span class="input-xlarge uneditable-input" style="width:500px;">'.$strCheckBox.'</span>&nbsp;'
						 .'</div>';
				}
				?>
                
            </div>
            
            <div class="form-actions">
              <button type="submit" class="btn btn-primary"><?=$lang['Save Changes']?></button>
              <button type="reset" class="btn"><?=$lang['Cancel']?></button>
            </div>
          </fieldset>
        </form>
      </div>
    </div>
  </div>
  <!--/span--> 
  
</div>


<script>

$(document).ready(function() {

	$('input:checkbox[name="module_permission[]"]').each(function( ) {
		var checkboxname = ($(this).attr('value'));

		var totallength = $('input:checkbox[name="perm_'+checkboxname+'[]"]').size();
		var selectedlength = $('input:checkbox[name="perm_'+checkboxname+'[]"]:checked').size();

		if(selectedlength > 0)
		{
			$(this).prop('checked', true);
			$(this).parent().addClass('checked');
		}
		else
		{
			$(this).prop('checked', false);
			$(this).parent().removeClass('checked');
		}
	});
	
	$('input:checkbox[name^="perm_"]').click(function () {

		var parent = $(this).attr('parent');
		var totallength = $('input:checkbox[name="perm_'+parent+'[]"]:checked').size();
	
		if(totallength > 0)
		{
			$('#'+parent).prop('checked', true);
			$('#'+parent).parent().addClass('checked');
		}
		else
		{
			$('#'+parent).prop('checked', false);
			$('#'+parent).parent().removeClass('checked');
		}
	});	
	
	$('input:checkbox[name="module_permission[]"]').click(function( ) {
		
		var IsChecked =  $(this).prop('checked');
		var checkboxid = $(this).attr('id');
    
    	console.log(checkboxid+"--"+IsChecked);
    
		if(IsChecked == false)
		{
		   $('input:checkbox[name="perm_'+checkboxid+'[]"]').prop('checked', false);
		   $('input:checkbox[name="perm_'+checkboxid+'[]"]').parent().removeClass('checked');
	    }
		else
		{
		   $('input:checkbox[name="perm_'+checkboxid+'[]"]').prop('checked', true);
		   $('input:checkbox[name="perm_'+checkboxid+'[]"]').parent().addClass('checked');
		}
	});

});


</script>
