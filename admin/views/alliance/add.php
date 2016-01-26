<?php 

include_once(CONTROLLERS_ADMIN."/".$_REQUEST['model'].".php"); 

$msg = $objComm->getSessionMessage('alliance');
?>

<div>
  <ul class="breadcrumb">
    <li><a href="#">Alliances</a> <span class="divider">/</span></li>
    <li><a href="#">Add Alliance</a></li>
  </ul>
</div>
<div class="row-fluid sortable">
  <div class="box span12">
    <div class="box-header well" data-original-title>
      <h2><i class="icon-user"></i> Alliance</h2>
      <div class="box-icon"></div>
    </div>
    <div class="box-content">
      <div class="box-content">
	      <?=$msg?>
        <form class="form-horizontal" method="post" action="index.php">
        <input type="hidden" name="action" id="action" value="SAVE" />
        <input type="hidden" name="model" id="model" value="<?=$_REQUEST['model']?>" />
        <input type="hidden" name="pk_id" id="pk_id" value="<?=$_REQUEST['id']?>" />
          <fieldset>
            
            
            <div class="control-group">
              <label class="control-label" for="name">First Name</label>
              <div class="controls">
                <input type="text" required value="" id="data_fname" name="data_fname" class="input-xsmall focused">
              </div>
            </div>
            
            <div class="control-group">
              <label class="control-label" for="name">Last Name</label>
              <div class="controls">
                <input type="text" required value="" id="data_lname" name="data_lname" class="input-xsmall focused">
              </div>
            </div>

            <div class="control-group">
              <label class="control-label" for="name">Business Registration Name</label>
              <div class="controls">
                <input type="text" required value="" id="data_business_name" name="data_business_name" class="input-xsmall focused">
              </div>
            </div>

            <div class="control-group">
              <label class="control-label" for="name">Location</label>
              <div class="controls">
              	 <table class="table table-striped table-bordered bootstrap-datatable datatable" style="width:90%" id="tab_children">
                	<tr>
                    	<th>Address</th>
                    	<th>Person In Charge</th>
                    	<th>Category</th>
                        <th></th>                                               
                    </tr>
                     <tr id="tr_0">
                    	<td>
                        <div class="control-group" style="margin:2px 0px 8px -77px;">
             			  <label class="control-label" for="name">Address</label>
			              <div class="controls"><input type="text" required value="" id="location_address_0" name="location_address[]" class="input-xsmall focused" style="width:150px;"></div>
            			</div>
                        <div class="control-group" style="margin:2px 0px 8px -77px;">
             			  <label class="control-label" for="name">City</label>
			              <div class="controls"><input type="text" required value="" id="location_city_0" name="location_city[]" class="input-xsmall focused" style="width:90px;"></div>
            			</div>
                        
                        <div class="control-group" style="margin:2px 0px 8px -77px;">
             			  <label class="control-label" for="name">State</label>
			              <div class="controls"><input type="text" required value="" id="location_state_0" name="location_state[]" class="input-xsmall focused" style="width:90px;"></div>
            			</div>
                        
                        <div class="control-group" style="margin:2px 0px 8px -77px;">
             			  <label class="control-label" for="name">Country</label>
			              <div class="controls"><input type="text" required value="" id="location_country_0" name="location_country[]" class="input-xsmall focused" style="width:90px;"></div>
            			</div>
                        <div class="control-group" style="margin:2px 0px 8px -77px;">
             			  <label class="control-label" for="name">Zipcode</label>
			              <div class="controls"><input type="text" required value="" id="location_zipcode_0" name="location_zipcode[]" class="input-xsmall focused" style="width:90px;"></div>
            			</div>
                        </td>
                    	<td><input type="text" value="" required id="location_incharge_0" name="location_incharge[]" class="input-xsmall focused" style="width:150px;"></td>
                    	<td>
                         <div class="control-group">
                        <div class="controls" style="margin:0">
							  <label class="checkbox inline">
								<div class="checker" id="uniform-inlineCheckbox1"><span class=""><input type="checkbox" value="1" id="location_category1_0" name="location_category_0[]" style="opacity: 0;"></span></div> Learning Centre (Offering Free Trial / Voucher / Discount)
							  </label>
                         </div>
                         </div>
                          <div class="control-group">
                               <div class="controls" style="margin:0">
							  <label class="checkbox inline">
								<div class="checker" id="uniform-inlineCheckbox2"><span class=""><input type="checkbox" value="2" id="location_category2_0" name="location_category_0[]" style="opacity: 0;"></span></div> Product offering Voucher / Discount
							  </label>
							</div>
                            </div>
                        </td>
                        <td>&nbsp;&nbsp;</td>
                    </tr>
                    
                    
                    <tr id="tr_999" style="display:none;">
                    	<td>
                        <div class="control-group" style="margin:2px 0px 8px -77px;">
             			  <label class="control-label" for="name">Address</label>
			              <div class="controls"><input type="text" value="" id="location_address_999" name="none_location_address[]" class="input-xsmall focused" style="width:150px;"></div>
            			</div>
                        <div class="control-group" style="margin:2px 0px 8px -77px;">
             			  <label class="control-label" for="name">City</label>
			              <div class="controls"><input type="text" value="" id="location_city_999" name="none_location_city[]" class="input-xsmall focused" style="width:90px;"></div>
            			</div>
                        
                        <div class="control-group" style="margin:2px 0px 8px -77px;">
             			  <label class="control-label" for="name">State</label>
			              <div class="controls"><input type="text" value="" id="location_state_999" name="none_location_state[]" class="input-xsmall focused" style="width:90px;"></div>
            			</div>
                        
                        <div class="control-group" style="margin:2px 0px 8px -77px;">
             			  <label class="control-label" for="name">Country</label>
			              <div class="controls"><input type="text" value="" id="location_country_999" name="none_location_country[]" class="input-xsmall focused" style="width:90px;"></div>
            			</div>
                        <div class="control-group" style="margin:2px 0px 8px -77px;">
             			  <label class="control-label" for="name">Zipcode</label>
			              <div class="controls"><input type="text"  value="" id="location_zipcode_999" name="none_location_zipcode[]" class="input-xsmall focused" style="width:90px;"></div>
            			</div>
                        </td>
                    	<td><input type="text" value="" id="location_incharge_999" name="none_location_incharge[]" class="input-xsmall focused" style="width:150px;"></td>
                    	<td>
                         <div class="control-group">
                        <div class="controls" style="margin:0">
							  <label class="checkbox inline">
								<div class="checker" id="uniform-inlineCheckbox1"><span class=""><input type="checkbox" value="1" id="location_category1_999" name="none_location_category_999[]" style="opacity: 0;"></span></div> Learning Centre (Offering Free Trial / Voucher / Discount)
							  </label>
                         </div>
                         </div>
                          <div class="control-group">
                               <div class="controls" style="margin:0">
							  <label class="checkbox inline">
								<div class="checker" id="uniform-inlineCheckbox2"><span class=""><input type="checkbox" value="2" id="location_category2_999" name="none_location_category_999[]" style="opacity: 0;"></span></div> Product offering Voucher / Discount
							  </label>
							</div>
                            </div>
                        </td>
                        <td><span class="icon32 icon-red icon-close" title=".icon32  .icon-red  .icon-close " onclick="removetabrow('#tr_999')"></span></td>
                    </tr>
                </table>
                <a id="addRow" href="javascript:addTableRow();" class="btn btn-small btn-info"><i class="icon-plus-sign"></i> Add More Location</a>
              </div>
            </div>
            
            
            
            <div class="control-group">
              <label class="control-label" for="name">Category</label>
              <div class="controls">
	              <?=$objHTML->categoryBasicCombo('data_category','');?>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label" for="name">Contact No</label>
              <div class="controls">
                <input type="text" required value="" id="data_contact_no" name="data_contact_no" class="input-xsmall focused">
              </div>
            </div>
            <div class="control-group">
              <label class="control-label" for="name">Email</label>
              <div class="controls">
              <div class="input-prepend">
				 <span class="add-on"><i class="icon-envelope"></i></span>
                  <input required type="email" value="" id="data_email" name="data_email" class="input-xsmall focused"></div>
              </div>
            </div>
            
            <div class="control-group">
              <label class="control-label" for="name">Account Status</label>
              <div class="controls"><?=$objHTML->statusBasicCombo('data_status','')?></div>
            </div>
            <div class="form-actions">
              <button type="submit" class="btn btn-primary">Save changes</button>
              <button type="reset" class="btn">Cancel</button>
            </div>
          </fieldset>
        </form>
      </div>
    </div>
  </div>
  <!--/span--> 
  
</div>

<script>

function removetabrow(elm)
{
	$(elm).remove();	
}

function addTableRow()
{
	nextRow = $('#tab_children tr[id^="tr_"]').length;
	nextRow++;
	
	var RowData = $("#tr_999").html();
	var newRowData = RowData.replace(/_999/g,'_'+nextRow);
	var newRowData = newRowData.replace(/none_/g,'');

	$("#tab_children > tbody").append("<tr id='tr_"+nextRow+"'>"+newRowData+"</tr>");
	
	$("#child_name_"+nextRow).val('');
	$("#child_gender_"+nextRow).val('');
	
	$("input:checkbox, input:radio, input:file").not('[data-no-uniform="true"],#uniform-is-ajax').uniform();
}


</script>