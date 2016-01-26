<?php 

include_once(CONTROLLERS_ADMIN."/".$_REQUEST['model'].".php"); 

$msg = $objComm->getSessionMessage('IQTest');

$arrDateName = array('data_birth_year','data_birth_month','data_birth_day');
$arrTimeName = array('data_birth_hour','data_birth_min');

$BirthDate = $row->birth_year."-".$row->birth_month."-".$row->birth_date;
$BirthTime = $row->birth_hour.":".$row->birth_min;

?>

<div>
    <ul class="breadcrumb">
        <li><a href="#"><?=$lang['Members']?></a> <span class="divider">/</span></li>
        <li><a href="#"><?=$lang['All Redeem']?></a><span class="divider">/</span></li>
        <li><a href="#"><?=$lang['View Redeem']?></a></li>
   </ul>
</div>
<div class="row-fluid sortable">
  <div class="box span12">
    <div class="box-header well" data-original-title>
      <h2><i class="icon-user"></i> <?=$lang['Redeem']?></h2>
      <div class="box-icon"></div>
    </div>
    <div class="box-content">
      <div class="box-content">
	    <?=$msg?>
        <form class="form-horizontal" method="post" action="index.php">
          <fieldset>
            <div class="control-group">
              <label class="control-label" for="typeahead"><?=$lang['First Name']?></label>
              <div class="controls"> 
               <span class="input-xlarge uneditable-input">
                <?=$row->first_name?>
                </span>
               </div>
            </div>
             
            <div class="control-group">
              <label class="control-label" for="data_fname"><?=$lang['Last Name']?></label>
              <div class="controls">
              <span class="input-xlarge uneditable-input">
                <?=$row->last_name?>
                </span>
               
              </div>
            </div>

            <div class="control-group">
              <label class="control-label" for="name"><?=$lang['Birth Date']?></label>
              <div class="controls"><?=$objHTML->basicDateCombo($arrTimeName, $arrDateName, $BirthDate,'disabled').' Time: '.$objHTML->basicTimeCombo($arrTimeName, $arrTimeName, $BirthTime, 'disabled');?></div>
            </div>
          
            <div class="control-group">
              <label class="control-label" for="name"><?=$lang['Gender']?></label>
              <div class="controls">
	            <?=$objHTML->radioBox('gender', 'gender_M', 'M', 'Male', $row->gender,'disabled')?>
	            <?=$objHTML->radioBox('gender', 'gender_F', 'F', 'Female', $row->gender,'disabled')?>                
              </div>
            </div>
           
            <div class="control-group">
              <label class="control-label" for="name"><?=$lang['Member']?></label>
              <div class="controls">
	             <?=$objHTML->allMembersComboBox('data_member_id', $row->member_id, 'disabled')?>
              </div>
            </div>
            <div class="control-group"> 
             <div class="controls"><a href="index.php?model=redeem">
              <button type="button" class="btn btn-primary"><?=$lang['Back']?></button>
              </a> <a href="index.php?model=redeem&action=edit&id=<?=$_REQUEST['id']?>">
              <button type="button" class="btn btn-success"><?=$lang['Edit']?></button>
              </a> <a href="index.php?model=redeem"><button type="button" class="btn"><?=$lang['Cancel']?></button>
              </a> </div></div>
          </fieldset>
        </form>
      </div>
    </div>
  </div>
</div>