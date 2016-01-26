<?php 

include_once(CONTROLLERS_ADMIN."/".$_REQUEST['model'].".php"); 

$msg = $objComm->getSessionMessage('IQTest');

$arrDateName = array('data_examinee_birthy','data_examinee_birthm','data_examinee_birthd');
$arrDateID   = array('data_examinee_birthy','data_examinee_birthm','data_examinee_birthd');

$BirthDate = $row->examinee_birthy."-".$row->examinee_birthm."-".$row->examinee_birthd;

?>

<div>
    <ul class="breadcrumb">
        <li><a href="#"><?=$lang['Members']?></a> <span class="divider">/</span></li>
        <li><a href="#"><?=$lang['All IQ Test']?></a><span class="divider">/</span></li>
        <li><a href="#"><?=$lang['View IQ Test']?></a></li>
   </ul>
</div>
<div class="row-fluid sortable">
  <div class="box span12">
    <div class="box-header well" data-original-title>
      <h2><i class="icon-user"></i> <?=$lang['IQ Test']?></h2>
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
                <?=$row->examinee_firstn?>
                </span>
               </div>
            </div>
             
            <div class="control-group">
              <label class="control-label" for="data_fname"><?=$lang['Last Name']?></label>
              <div class="controls">
              <span class="input-xlarge uneditable-input">
                <?=$row->examinee_lastn?>
                </span>
               
              </div>
            </div>

            <div class="control-group">
              <label class="control-label" for="name"><?=$lang['Birth Date']?></label>
              <div class="controls"><?=$objHTML->basicDateCombo($arrDateName, $arrDateID, $BirthDate,'disabled');?></div>
            </div>
          
            <div class="control-group">
              <label class="control-label" for="name"><?=$lang['Gender']?></label>
              <div class="controls">
	            <?=$objHTML->radioBox('examinee_gender', 'examinee_gender_M', 'M', 'Male', $row->examinee_gender,'disabled')?>
	            <?=$objHTML->radioBox('examinee_gender', 'examinee_gender_F', 'F', 'Female', $row->examinee_gender,'disabled')?>                
              </div>
            </div>
            
             <div class="control-group">
              <label class="control-label" for="name"><?=$lang['Preferred Hand']?></label>
              <div class="controls">
	            <?=$objHTML->radioBox('examinee_handedness', 'examinee_handedness_R', 'R', 'Right', $row->examinee_handedness,'disabled')?>
	            <?=$objHTML->radioBox('examinee_handedness', 'examinee_handedness_L', 'L', 'Left', $row->examinee_handedness,'disabled')?>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label" for="name"><?=$lang['Member']?></label>
              <div class="controls">
	             <?=$objHTML->allMembersComboBox('data_member_id', $row->member_id, 'disabled')?>
              </div>
            </div>
            <div class="control-group"> 
             <div class="controls"><a href="index.php?model=iq_test">
              <button type="button" class="btn btn-primary"><?=$lang['Back']?></button>
              </a> <a href="index.php?model=iq_test&action=edit&id=<?=$_REQUEST['id']?>">
              <button type="button" class="btn btn-success"><?=$lang['Edit']?></button>
              </a> <a href="index.php?model=iq_test"><button type="button" class="btn"><?=$lang['Cancel']?></button>
              </a> </div></div>
          </fieldset>
        </form>
      </div>
    </div>
  </div>
</div>