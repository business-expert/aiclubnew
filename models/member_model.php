<?php


class member
{
	function __construct() 
	{
		
	}
	
	function setMembers()
	{
		global $objComm, $DB, $lang;
		
		$membershipAmt = $objComm->membershipAmount();
		$birthday = $objComm->getYearFromCombo($_REQUEST, 'date_');
		$Income   = $_REQUEST['txt_income_from']."-".$_REQUEST['txt_income_to'];

		foreach($_REQUEST['membership'] as $key => $membership)
			$Amount +=  $membershipAmt[$membership];

		$this->arrField = $objComm->setTableField();

		$this->arrField['birth_date'] = $birthday;
		$this->arrField['income'] = $Income;
		$this->arrField['status'] = 'Pending';
		$this->arrField['membership_type'] = implode(",",$_REQUEST['membership']);
		$this->arrField['amount_paid'] = $Amount;		

		$this->setExtraApplicationField();

		if($PkID > 0)
		{
			$this->setMemberChild($PkID);

			$_SESSION['member_success'] = "Member updated Successfully";
			
			$where = "`id` = '".$PkID."'";
			
			return $DB->updateRecord('members', $this->arrField, $where , '');
		}
		else
		{
			$_SESSION['member_success'] = $lang["payment_pending"];		
		
			$memeberid =  $DB->addNewRecord('members', $this->arrField, '');

			$_SESSION['register']['member_id'] = $memeberid;
			
			$this->setMemberChild($memeberid);
			
			$objComm->redirect1("index.php?model=member&action=payment");
		}
	}
	
	function getMembers($id)
	{
		global $DB;
		
		$SQL = "SELECT * FROM members WHERE id='".$id."'";	
		$row = $DB->fetchOne($SQL);
		
		return $row;
	}
	
	function payment()
	{
		global $objComm, $lang;

		$ProductAmount = $objComm->membershipAmount();	
		$ProductName = $objComm->membershipItemName();
		$memberid = $_SESSION['register']['member_id'];

		if($memberid > 0)
		{	
			$row = $this->getMembers($memberid);
		
			$TotalItemPrice = 0;
			$arrProducts 	= explode(",",$row->membership_type);
			
			$_SESSION['product_'.$memberid] = array();
			
			foreach($arrProducts as $index => $Item)
			{
				$ItemName 		= urlencode($ProductName[$Item]);
				$ItemPrice 		= $ProductAmount[$Item];
				$ItemQuantity 	= 1;
				
				$arrPaymentData['PAYMENTREQUEST_'.$index.'_PAYMENTREQUESTID'] 	= $index;
				$arrPaymentData['PAYMENTREQUEST_'.$index.'_CURRENCYCODE'] 	= CURRENCY;
				$arrPaymentData['PAYMENTREQUEST_'.$index.'_AMT']			= $ItemPrice;
				$arrPaymentData['PAYMENTREQUEST_'.$index.'_ITEMAMT']		= $ItemPrice;
				$arrPaymentData['L_PAYMENTREQUEST_'.$index.'_QTY0']			= $ItemQuantity;
				$arrPaymentData['L_PAYMENTREQUEST_'.$index.'_AMT0']			= $ItemPrice;
				$arrPaymentData['L_PAYMENTREQUEST_'.$index.'_NAME0']		= $ItemName;
				$arrPaymentData['L_PAYMENTREQUEST_'.$index.'_NUMBER0']		= $Item;
				$arrPaymentData['PAYMENTREQUEST_'.$index.'_SELLERPAYPALACCOUNTID']	= "AI Club";				

				$TotalItemPrice = $TotalItemPrice + $ItemPrice;
				
				$TokenData['product_'.$memberid][] = array(	'price' => $ItemPrice,
															'name' => $ItemName,
															'qty' => $ItemQuantity,
															'no' => $Item,
															'payment_request_id' =>  $index,
															'seller_id' => "louis.cheng@athenaintellects.com"
															);
			}
			
			$arrPaymentData['METHOD']		 = 'SetExpressCheckout';
			$arrPaymentData['AMT']			 = $TotalItemPrice;
			$arrPaymentData['PAYMENTACTION'] = 'Sale';
			$arrPaymentData['ALLOWNOTE'] 	 = '1';

			//echo "<pre>"; print_r($_REQUEST); print_r($arrPaymentData); die(__FILE__."--".__LINE__);
		
			$objPayment = new payment($row);
			$objPayment->setPaymentData($arrPaymentData);
			$response = $objPayment->sendPaymentRequest();

			if(strtoupper($response['ACK']) == 'SUCCESS' || strtoupper($response['ACK']) == 'SUCCESSWITHWARNING')
			{
				$_SESSION['product_'.$memberid] = $TokenData['product_'.$memberid];
				$objPayment->redirecttopaypal($response['TOKEN']);
			}
			else
			{
				$_SESSION['member_error'] = $response['L_LONGMESSAGE0'];	
				$objComm->redirect1("index.php?model=member&action=payment");		
			}
		}
		else
		{
			$_SESSION['member_error'] = "Please fill up the form then you can do payment";	
			$objComm->redirect1("index.php?model=member&action=register");	
		}
	}
	
	
	function finalPayment()
	{
		global $objComm, $lang;
		
		$memberid = $_SESSION['register']['member_id'];

		if(isset($_GET["token"]) && isset($_GET["PayerID"]))
		{
			$row = $this->getMembers($memberid);

			$objPayment = new payment($row);
			$response   = $objPayment->payment($row,$_GET["token"],$_GET["PayerID"]);

			if(strtoupper($response['ACK']) == 'SUCCESS' || strtoupper($response['ACK']) == 'SUCCESSWITHWARNING')
			{
				$objPayment->makePaymentLog($memberid, 'Final Payment', serialize($response));
				
				$this->createActivationURL($row->email_address,$memberid);	
				$this->sendPaymentMail($row, $response);
				$this->sendAdminMail($row);
					
				$_SESSION['product_'.$memberid]    = '';
				$_SESSION['register']['member_id'] = '';
				
				unset($_SESSION['register']);
				unset($_SESSION['product_'.$memberid]);	
				
				$_SESSION['activation_success'] = $lang['payment_sucess']."<br>".$lang['activation_link'];	
				include_once(VIEWS. "/error/activation.php");
				exit();				
			}
			else
			{
				
			}
		}
	}
	
	public function createActivationURL($emailID, $PkID)
	{
		global $objComm, $DB;
		
		$RandomString = $objComm->generateRandomString(20);
		
		$arrData['activation'] = $RandomString;
		
		$where = "`id` = '".$PkID."'";
		$DB->updateRecord('members', $arrData, $where , '');

		#------------ EMAIL FOR VERIFICATION ------------#
		$this->sendmail($emailID, $RandomString);
	}
	
	function sendPaymentMail($row, $arrPayResponse)
	{
		global $objComm;
		
		$TotalAmount = 0;
		
		$arrMembsershipImage = $objComm->membershipImage();
	
		$arrMemType = explode(",",$row->membership_type);
	
		foreach($arrMemType as $value){
			$arrMem[] = $arrMembsershipImage[$value];
		}
	
		#------------ EMAIL FOR PAYMENT ------------#
		$to 	 = $row->email_address;
		$subject = 'Membership Payment Success';
		
		$arrMailContent['{NAME}'] = $row->fname." ".$row->lname;
		
		if($arrPayResponse['TRANSACTIONID'] != '')		
		{
			$arrData[0]['TRANSACTIONID']   = $arrPayResponse['TRANSACTIONID'];
			$arrData[0]['PAYMENTSTATUS']   = $arrPayResponse['PAYMENTSTATUS'];
			$arrData[0]['AMT'] 			   = $arrPayResponse['AMT'];
			$arrData[0]['TAXAMT'] 		   = $arrPayResponse['TAXAMT'];	
			$arrData[0]['MEMBERSHIP-TYPE'] = $arrMem[0];
		}
		else
		{
			foreach($_SESSION['product_'.$row->id] as $index => $Item)	
			{
				$arrData[$index]['TRANSACTIONID'] 	= $arrPayResponse['PAYMENTINFO_'.$index.'_TRANSACTIONID'];
				$arrData[$index]['PAYMENTSTATUS'] 	= $arrPayResponse['PAYMENTINFO_'.$index.'_PAYMENTSTATUS'];
				$arrData[$index]['AMT'] 			= $arrPayResponse['PAYMENTINFO_'.$index.'_AMT'];
				$arrData[$index]['TAXAMT'] 			= $arrPayResponse['PAYMENTINFO_'.$index.'_TAXAMT'];	
				$arrData[$index]['MEMBERSHIP-TYPE']	= $arrMem[$index];
			}
		}
		
		foreach($arrData as $key => $Items)
		{
			$arrContent[] =	"<p>Transaction ID : ".$Items['TRANSACTIONID']." </p>".
							"<p>Paypal Payment Status: ".$Items['PAYMENTSTATUS']." </p>".
							"<p>Payment Amount: ".$Items['AMT']." </p>".
							"<p>Tax : ".$Items['TAXAMT']." </p>".
							"<p>MemberShip : ".urldecode($_SESSION['product_'.$row->id][$key]['name'])." </p>".
							"<p>".$Items['MEMBERSHIP-TYPE']."</p>";
							"<p><br><br></p>";
							
			$TotalAmount = $TotalAmount + $Items['AMT'];
		}
		
		
		$arrMailContent['{MEMEBERSHIP_TYPE}'] = implode("<hr>",$arrContent);
		$arrMailContent['{AMOUNT}'] 		  = $TotalAmount;		
		$arrMailContent['{URL}'] 			  = SITE_PATH."/index.php";	
		
		$objEmail  = new email();
		$EmailBody = $objEmail->emailTemplate('member_payment',$arrMailContent);	
		$objEmail->sendmail($to,$subject,$EmailBody);	
	}
	
	function sendAdminMail($row)
	{
		global $objComm;
		
		$arrMembsershipImage = $objComm->membershipImage();
	
		$arrMemType = explode(",",$row->membership_type);
	
		foreach($arrMemType as $value){
			$arrMem[] = $arrMembsershipImage[$value];
		}
	
		#------------ EMAIL FOR PAYMENT ------------#
		$to 	 = ADMIN_EMAIL;//'rakesh@arxmind.com';
		$subject = 'AI Club - Member Registered';
		
		$arrData['{NAME}'] = $row->fname." ".$row->lname;
		$arrData['{username}'] = $row->username;
		$arrData['{NAME}'] = $row->fname;
		$arrData['{GENDER}'] = $row->gender;
		$arrData['{BIRTH_DATE}'] = $row->birth_date;						
		$arrData['{OCCUPATION}'] = $row->occupation;
		$arrData['{EDUCATION_LEVEL}'] = $row->education_level;
		$arrData['{INCOME}'] = $row->income;
		$arrData['{MARRIAGE_STATUS}'] = $row->marriage_status;
		$arrData['{ADDRESS}'] = $row->address;
		$arrData['{REGION}'] = $row->region;
		$arrData['{DISTRICT}'] = $row->district;
		$arrData['{CONTACT_NO}'] = $row->contact_no;
		$arrData['{EMAIL_ADDRESS}'] = $row->email_address;
		$arrData['{AMOUNT}'] = $row->amount_paid;
		$arrData['{MEMBERSHIP-TYPE-1}'] = $arrMem[0];
		$arrData['{MEMBERSHIP-TYPE-2}'] = $arrMem[1];
		$arrData['{MEMBERSHIP-TYPE-3}'] = $arrMem[2];
		
		$objEmail = new email();
		
		$EmailBody = $objEmail->emailTemplate('admin_register',$arrData);	
		
		$objEmail->sendmail($to,$subject,$EmailBody);	
	}


	public function sendmail($to , $RandomString)
	{
		$subject = 'AI Club - verify your account';
		
		$arrData['{FIRST_NAME}'] = $this->arrField['fname'];
		$arrData['{URL}'] 		 = SITE_PATH."/verification.php?code=".$RandomString;		
		
		$objEmail = new email();
		
		$EmailBody = $objEmail->emailTemplate('member_register',$arrData);	
		
		$objEmail->sendmail($to,$subject,$EmailBody);		
	}
			

	function updateMembershipID($PkID)
	{
		global $DB;
		
		$arrUpdateField['membership_id'] = $PkID.rand(1000,9999);
		$where = "`id` = '".$PkID."'";
		$DB->updateRecord('members', $arrUpdateField, $where , '');
	}
	
	
	function setMemberChild($PkID)
	{
		global $objComm,$DB;
		
		//echo "<pre>"; print_r($_REQUEST);
		foreach($_REQUEST as $key => $value)
		{
			if(is_array($value))
			{
				if(substr($key,0,6) == 'child_')
				{
					$arrPost[substr($key,6)] = $value;
				}
			}
		}
		
		$this->delMembersChildren($PkID);
		
		foreach($arrPost['lname'] as $key => $value)
		{

			$name   = $arrPost['lname'][$key];
			$gender = $arrPost['gender'][$key];
			$date   = $arrPost['date_year'][$key]."-".$arrPost['date_month'][$key]."-".$arrPost['date_date'][$key];
			
			if($name != '')
			{
				$arrInsert['member_id'] = $PkID;
				$arrInsert['name'] = $name;
				$arrInsert['gender'] = $gender;
				$arrInsert['birth_date'] = date("Y-m-d",strtotime($date));
			}
			
			if(count($arrInsert) > 0)
			{
				$DB->addNewRecord('members_children', $arrInsert, '');
				
				$arrInsert = array();
			}
		}
	}
	
	
	function delMembersChildren($memeberid)
	{
		global $DB;
		
		$SQL = "DELETE FROM members_children WHERE member_id='".$memeberid."'";
		$DB->query($SQL);	
	}
	
	
	public function setExtraApplicationField($action = '')
	{
		$action = ($action == "") ? $_REQUEST['action'] : $action;
		
		if(strtoupper($action) == 'SAVE')
		{
			$this->arrField['created_by']		= $_SESSION['admin']['ai_user'];
			$this->arrField['created_datetime']	= date("Y-m-d 00:00:00");
		}
	
		if(strtoupper($action) == 'UPDATE')
		{
			$this->arrField['updated_by']		= $_SESSION['admin']['ai_user'];
			$this->arrField['updated_datetime']	= date("Y-m-d 00:00:00");
		}	
	}
	
	
	function delMembers($id)
	{
		global $DB;
		
		$_SESSION['members_success'] = "Members Deleted Successfully";
		
		$SQL = "DELETE FROM members WHERE id='".$id."' LIMIT 1";
		$DB->query($SQL);	
		
		$this->delMembersChildren($id);
	}
	

	function getMemberChildDetails($id)
	{
		global $DB;
		
		$SQL = "SELECT * FROM members_children WHERE member_id='".$id."'";	
		$row = $DB->fetchAll($SQL);
		
		return $row;
		
	}
	
}

?>