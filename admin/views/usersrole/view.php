<?php 
include_once(CONTROLLERS_ADMIN."/".$_REQUEST['model'].".php"); 

$arrStatus = $objComm->getAllStatus();
?>

<div>
  <ul class="breadcrumb">
        <li><a href="#"><?=$lang['Settings']?></a> <span class="divider">/</span></li>
        <li><a href="index.php?model=usersrole"><?=$lang['User Role']?></a><span class="divider">/</span></li>        
        <li><a href="#"><?=$lang['View User Role']?></a></li>
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
        <form class="form-horizontal">
          <fieldset>
            <div class="control-group">
              <label class="control-label" for="typeahead"><?=$lang['User Type']?></label>
              <div class="controls"><span class="input-xlarge uneditable-input"><?=$row->user_type?></span></div>
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
										.'<div class="checker" id="uniform-inlineCheckbox3"><span><input type="checkbox" value="'.$checkbox.'" id="'.strtolower($arrRow->module_name).$key.'" name="perm_'.strtolower($arrRow->module_name).'[]" style="opacity: 0;" '.$checked.' parent="'.strtolower($arrRow->module_name).'" disabled="">'
										.'</span></div>'.strtoupper($checkbox).'</label>';
					}
								
					$strCheckBox = '<div class="controls" style="margin:-6px 0 0 0;">'.implode(" ",$arrCheck).'</div>';
					
					$ModuleCheckBox = '<div class="controls" style="margin:-6px 0 0 0;">
										<label class="checkbox inline" style="padding-left:0px;">'
										.'<div class="checker" id="uniform-inlineCheckbox3"><span><input type="checkbox" value="'.strtolower($arrRow->module_name).'" id="'.strtolower($arrRow->module_name).'" name="module_permission[]" style="opacity: 0;" '.$ModuleChecked.' disabled="">'
										.'</span></div>'.ucfirst($arrRow->module_name).'</label></div>';
										
              		echo '<div class="controls">'
						 .'<span class="input-xlarge uneditable-input" style="width:100px;"> '.$ModuleCheckBox.' </span>&nbsp;'
						 .'<span class="input-xlarge uneditable-input" style="width:500px;">'.$strCheckBox.'</span>&nbsp;'
						 .'</div>';
				}				
				
				?>
                
            </div>
            
            <div class="form-actions"> <a href="index.php?model=members">
              <button type="button" class="btn btn-primary"><?=$lang['Back']?></button>
              </a> <a href="index.php?model=usersrole&action=edit&id=<?=$_REQUEST['id']?>">
              <button type="button" class="btn btn-success"><?=$lang['Edit']?></button>
              </a> <a href="index.php?model=usersrole">
              <button type="button" class="btn"><?=$lang['Cancel']?></button>
              </a> </div>
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
		
		$(this).prop('disabled', true);
	});
});
	
</script>
