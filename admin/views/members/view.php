<?php 

include_once(CONTROLLERS_ADMIN."/".$_REQUEST['model'].".php"); 

$arrGender = $objComm->GenderList();
$arrStatus = $objComm->getAllStatus();
$arrMarrage = $objComm->getMarrageStatus();
$arrEducation = $objComm->getEducationLevel();
$arrRegion = $objComm->getAllRegion();
$arrDistrict = $objComm->getAllDistrict();

$arrIncome = explode("-",$row->income);

?>

<div>
  <ul class="breadcrumb">
    <li><a href="#"><?=$lang['Members']?></a> <span class="divider">/</span></li>
    <li><a href="#"><?=$lang['View Members']?></a></li>
  </ul>
</div>
<div class="row-fluid sortable">
  <div class="box span12">
    <div class="box-header well" data-original-title>
      <h2><i class="icon-user"></i> <?=$lang['Members']?></h2>
      <div class="box-icon"></div>
    </div>
    <div class="box-content">
      <div class="box-content">
        <form class="form-horizontal">
          <fieldset>
            <div class="control-group">
              <label class="control-label" for="typeahead"><?=$lang['Membership Number']?></label>
              <div class="controls"> <span class="input-xlarge uneditable-input">
                <?=$row->membership_id?>
                </span> </div>
            </div>
             
            <div class="control-group">
              <label class="control-label" for="name"><?=$lang['Name']?></label>
              <div class="controls"> <span class="input-xlarge uneditable-input">
                <?=$row->fname.' '.$row->lname?>
                </span> </div>
            </div>
            <div class="control-group">
              <label class="control-label" for="name"><?=$lang['Gender']?></label>
              <div class="controls"><span class="input-xlarge uneditable-input">
                <?=$arrGender[$row->gender];?>
                </span> </div>
            </div>
            <div class="control-group">
              <label class="control-label" for="name"><?=$lang['Birth Date']?></label>
              <div class="controls"><span class="input-xlarge uneditable-input">
                <?=date("Y-M-d",strtotime($row->birth_day))?>
                </span></div>
            </div>
             <div class="control-group">
              <label class="control-label" for="name"><?=$lang['Contact No']?></label>
              <div class="controls"><span class="input-xlarge uneditable-input">
                <?=$row->contact_no?>
                </span></div>
            </div>
            <div class="control-group">
              <label class="control-label" for="name"><?=$lang['Email']?></label>
              <div class="controls"><span class="input-xlarge uneditable-input">
                <?=$row->email_address?>
                </span></div>
            </div>
            
            
            <div class="control-group">
              <label class="control-label" for="name"><?=$lang['Address']?></label>
              <div class="controls"><span class="input-xlarge uneditable-input">
                <?=$row->address?>
                </span></div>
            </div>
            <div class="control-group">
              <label class="control-label" for="name"><?=$lang['Region']?></label>
              <div class="controls"><span class="input-xlarge uneditable-input">
                <?=$arrRegion[$row->region]?>
                </span></div>
            </div>
            <div class="control-group">
              <label class="control-label" for="name"><?=$lang['District']?></label>
              <div class="controls"><span class="input-xlarge uneditable-input">
                <?=$arrDistrict[$row->district]?>
                </span></div>
            </div>
             <div class="control-group">
              <label class="control-label" for="data_occupation"><?=$lang['occupation']?></label>
              <div class="controls"><span class="input-xlarge uneditable-input"><?=$row->occupation?></span></div>
            </div>


             <div class="control-group">
              <label class="control-label" for="data_education_level"><?=$lang['education_level']?></label>
              <div class="controls"><span class="input-xlarge uneditable-input"><?=$arrEducation[$row->education_level]?></span></div>
            </div>
            
            <div class="control-group">
              <label class="control-label" for="data_income"><?=$lang['income']?></label>
              <div class="input-prepend input-append" style="margin-left:21px;">
              <span class="input-xlarge uneditable-input" style="width:120px;"> <strong><?=CURRENCY?></strong><?=$arrIncome[0]?></span>
                &nbsp;to&nbsp;
                 <span class="input-xlarge uneditable-input" style="width:120px;"><strong><?=CURRENCY?></strong><?=$arrIncome[1]?></span>
              </div>
            </div>
            
  			<div class="control-group">
              <label class="control-label" for="data_marriage_status"><?=$lang['marriage_status']?></label>
              <div class="controls"><span class="input-xlarge uneditable-input"><?=$arrMarrage[$row->marriage_status]?></span></div>
            </div>
            
            
           
            
             <div class="control-group">
              <label class="control-label" for="name"><?=$lang['Children Details']?></label>
              <div class="controls">
                 <span class="input-xlarge uneditable-input" style="width:100px;"><?=$lang['Name']?></span>
                 <span class="input-xlarge uneditable-input" style="width:100px;"><?=$lang['Gender']?></span>
                 <span class="input-xlarge uneditable-input" style="width:150px;"><?=$lang['Birth Date']?></span>
                 </div>
              	<?php
				
				foreach($rowChilds as $rowchild)
				{
              		echo '<div class="controls">'
						 .'<span class="input-xlarge uneditable-input" style="width:100px;">'.$rowchild->name.'</span>&nbsp;'
						 .'<span class="input-xlarge uneditable-input" style="width:100px;">'.$arrGender[$rowchild->gender].'</span>&nbsp;'
						 .'<span class="input-xlarge uneditable-input" style="width:150px;">'.date("Y-M-d H:i:s",strtotime($rowchild->birth_date)).'</span>'
						 .'</div>';
				}
				?>
                
            </div>
            
            <div class="control-group">
              <label class="control-label" for="name"><?=$lang['Account Status']?></label>
              <div class="controls"><span class="label <?=$arrStatus[$row->status]?>"><?=$lang[$row->status]?></span></div>
            </div>
            <div class="form-actions"> <a href="index.php?model=members">
              <button type="button" class="btn btn-primary"><?=$lang['Back']?></button>
              </a> <a href="index.php?model=members&action=edit&id=<?=$_REQUEST['id']?>">
              <button type="button" class="btn btn-success"><?=$lang['Edit']?></button>
              </a> <a href="index.php?model=members"><button type="button" class="btn"><?=$lang['Cancel']?></button>
              </a> </div>
          </fieldset>
        </form>
      </div>
    </div>
  </div>
  <!--/span--> 
  
</div>
