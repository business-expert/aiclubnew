<?php 

include_once(CONTROLLERS_ADMIN."/".$_REQUEST['model'].".php"); 

$arrStatus = $objComm->getAllStatus();

?>

<div>
  <ul class="breadcrumb">
    <li><a href="#">Alliances</a> <span class="divider">/</span></li>
    <li><a href="#">View Alliances</a></li>
  </ul>
</div>
<div class="row-fluid sortable">
  <div class="box span12">
    <div class="box-header well" data-original-title>
      <h2><i class="icon-user"></i> Alliances</h2>
      <div class="box-icon"></div>
    </div>
    <div class="box-content">
      <div class="box-content">
        <form class="form-horizontal">
          <fieldset>
            <div class="control-group">
              <label class="control-label" for="name">Name</label>
              <div class="controls"> <span class="input-xlarge uneditable-input">
                <?=$row->name?>
                </span> </div>
            </div>
            <div class="control-group">
              <label class="control-label" for="name">Business Registration Name</label>
              <div class="controls"><span class="input-xlarge uneditable-input">
                <?=$row->business_name;?>
                </span> </div>
            </div>
            <div class="control-group">
              <label class="control-label" for="name">Main Office Address</label>
              <div class="controls"><span class="input-xlarge uneditable-input">
                <?=$row->location?>
                </span></div>
            </div>
            <div class="control-group">
              <label class="control-label" for="name">Cateogty</label>
              <div class="controls"><span class="input-xlarge uneditable-input">
                <?=$row->category?>
                </span></div>
            </div>
            <div class="control-group">
              <label class="control-label" for="name">Contact No</label>
              <div class="controls"><span class="input-xlarge uneditable-input">
                <?=$row->contact_no?>
                </span></div>
            </div>
            <div class="control-group">
              <label class="control-label" for="name">Email</label>
              <div class="controls"><span class="input-xlarge uneditable-input">
                <?=$row->email?>
                </span></div>
            </div>
            
            <div class="control-group">
              <label class="control-label" for="name">Account Status</label>
              <div class="controls"><span class="label <?=$arrStatus[$row->status]?>"><?=$row->status?></span></div>
            </div>
            <div class="form-actions"> <a href="index.php?model=alliance">
              <button type="button" class="btn btn-primary">Back</button>
              </a> <a href="index.php?model=alliance&action=edit&id=<?=$_REQUEST['id']?>">
              <button type="button" class="btn btn-success">Edit</button>
              </a> <a href="index.php?model=alliance">
              <button type="button" class="btn">Cancel</button>
              </a> </div>
          </fieldset>
        </form>
      </div>
    </div>
  </div>
  <!--/span--> 
  
</div>
