<?php 
include_once(CONTROLLERS."/profile.php"); 

$arrGender 	  = $objComm->GenderList();
$arrStatus 	  = $objComm->getAllStatus();
$arrMarrage   =	$objComm->getMarrageStatus();
$arrEducation = $objComm->getEducationLevel();
$arrRegion 	  = $objComm->getAllRegion();
$arrDistrict  = $objComm->getAllDistrict();

$arrDateName = array('date_year','date_month','date_date');
$arrDateID   = array('date_year','date_month','date_date');

$arrIncome = explode("-",$row->income);

$msg = $objComm->getSessionMessage('profile');

?>
<?=$msg?>

<form class="form-horizontal">
 <fieldset>
  <table border="0" cellpadding="3" cellspacing="3" style="width:100%">
    <tr>
      <td><?=$lang['Name']?>:</td>
      <td><?=$row->fname.' '.$row->lname?></td>
    </tr>
    <tr>
      <td><?=$lang['Birth Date']?>:</td>
      <td><?=$objHTML->basicDateCombo($arrDateName, $arrDateID, $row->birth_date,"disabled='disabled'");?></td>
    </tr>
    <tr>
      <td><?=$lang['Address']?>:</td>
      <td><?=$row->address?></td>
    </tr>
    <tr>
      <td><?=$lang['Region']?>:</td>
      <td><?=$arrRegion[$row->region]?></td>
    </tr>
    <tr>
      <td><?=$lang['District']?>:</td>
      <td><?=$arrDistrict[$row->district]?></td>
    </tr>  
    <tr>
      <td><?=$lang['Gender']?>:</td>
      <td><?=$objHTML->genderBasicCombo('data_gender',$row->gender,'disabled')?></td>
    </tr>
    <tr>
      <td><?=$lang['Contact No']?>:</td>
      <td><?=$row->contact_no?></td>
    </tr>
    <tr>
      <td><?=$lang['Email']?>:</td>
      <td><?=$row->email_address?></td>
    </tr>
    <tr>
      <td></td>
      <td><a href="index.php?model=dashboard&action=edit"><button type="button" class="button" style="width:17%;padding:4px;"><?=$lang['Edit']?></button></a></td>
    </tr>
  </table>
 </fieldset>
</form>


