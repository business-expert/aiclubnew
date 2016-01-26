<?php

class payment
{
	public $arrPaymentData;
	public $member_details;
	
	function __construct($row) 
	{
		global $DB, $objComm;
				
		$arrPaymentData['USER'] 		 =  PAYPAL_USERNAME;
		$arrPaymentData['PWD'] 			 =  PAYPAL_PASSWORD;
		$arrPaymentData['SIGNATURE'] 	 =  PAYPAL_SIGNATURE;
		$arrPaymentData['VERSION'] 		 =  PAYPAL_API_VERSION;
		$arrPaymentData['PAYMENTACTION'] =  'Sale';
		$arrPaymentData['IPADDRESS'] 	 =  $_SERVER['REMOTE_ADDR'];
		$arrPaymentData['CURRENCYCODE']  =  PAYPAL_CURRENCY_CODE;
		$arrPaymentData['RETURNURL']  	 =  PAYPAL_RETURN_URL;
		$arrPaymentData['CANCELURL']  	 =  PAYPAL_CANCEL_URL;
		$arrPaymentData['SOLUTIONTYPE']  =  'Sole';
		$arrPaymentData['LANDINGPAGE']   =  'Billing';
		
		$this->member_details = $row;
		$this->id			  = $row->id;
		$this->arrPaymentData = $arrPaymentData;
		
		$this->makePaymentLog($this->id, 'Payment Initialize', serialize($arrPaymentData));
	}	
	
	
	function setPaymentData($arrPaymentData)
	{
		global $DB, $objComm;
		
		$this->arrPaymentData = array_merge($this->arrPaymentData,	$arrPaymentData);	
		
		$paypalParam = '';
		
		foreach($this->arrPaymentData as $var=>$val)
		{
			$paypalParam .= '&'.$var.'='.urlencode($val);	
		}
		
		$this->param = $paypalParam;
		//echo "<pre>"; print_r($this);
		$this->makePaymentLog($this->id, 'Ready To payment', $paypalParam);
	}
	
	function makePaymentLog($id, $log, $logDetails)
	{
		global $DB;
		
		$arrData['member_id'] = $id;
		$arrData['log'] = $log;
		$arrData['log_details'] = $logDetails;
		
		$DB->addNewRecord('payment_log',$arrData);
	}
	
	function sendPaymentRequest()
	{
		global $DB, $objComm;
		
		$curl = curl_init();
		
		curl_setopt($curl, CURLOPT_VERBOSE, 1);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
		curl_setopt($curl, CURLOPT_TIMEOUT, 30);
		curl_setopt($curl, CURLOPT_URL, PAYPAL_TOKEN_URL);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $this->param);
		
		$result = curl_exec($curl);
		curl_close($curl);

		$this->makePaymentLog($this->id, 'Payment sent', $this->param);

		$this->response = $result;
		
		if(!$result) 		
			$this->makePaymentLog($this->id, 'Payment Failed', curl_error($curl) ." -- ".curl_errno($curl) );
		
		$this->makePaymentLog($this->id, 'Payment Response', $result);
				
		return $this->NVPToArray();
	}
	
	
	function redirecttopaypal($token)
	{
		$paypalurl = PAYPAL_URL.'/cgi-bin/webscr?cmd=_express-checkout&token='.$token;
		
		$this->makePaymentLog($this->id, 'Paypal Redirect', $paypalurl);
		
		header('Location: '.$paypalurl);
		die();	
	}
	
	function payment($row, $token, $payerid)
	{
		$ItemTotalPrice = 0;
		$paypalParam 	= '';
		//echo "<pre>"; print_r($_SESSION);
		foreach($_SESSION['product_'.$row->id] as $index => $Item)
		{
			$ItemTotalPrice  = $ItemTotalPrice +  $Item['price'];
			
			$arrPaymentData['PAYMENTREQUEST_'.$index.'_AMT']=$Item['price'];
			$arrPaymentData['PAYMENTREQUEST_'.$index.'_CURRENCYCODE']=PAYPAL_CURRENCY_CODE;
			$arrPaymentData['PAYMENTREQUEST_'.$index.'_SELLERPAYPALACCOUNTID']=$Item['seller_id'];
			$arrPaymentData['PAYMENTREQUEST_'.$index.'_PAYMENTREQUESTID']=$Item['payment_request_id'];
		}
		
		$arrPaymentData['METHOD'] = 'DoExpressCheckoutPayment';
		$arrPaymentData['TOKEN'] = urlencode($token);
		$arrPaymentData['PAYERID'] = urlencode($payerid);
		$arrPaymentData['PAYMENTACTION'] = urlencode("SALE");
		$arrPaymentData['AMT'] = urlencode($ItemTotalPrice);
		$arrPaymentData['CURRENCYCODE'] = urlencode(PAYPAL_CURRENCY_CODE);
		
		$this->arrPaymentData = array_merge($this->arrPaymentData,	$arrPaymentData);	
		
		foreach($this->arrPaymentData as $var=>$val)
			$paypalParam .= '&'.$var.'='.urlencode($val);	
		//echo "<pre>"; print_r($paypalParam);		
		$this->param = $paypalParam;
		
		$this->makePaymentLog($this->id, 'Final Payment', $paypalParam);
		
		$this->sendPaymentRequest();
		return $this->NVPToArray();
	}
	
	// Function to convert NTP string to an array
	function NVPToArray()
	{
		$proArray = array();
		
		$NVPString = $this->response;
		
		while(strlen($NVPString))
		{
			// name
			$keypos = strpos($NVPString,'=');
			$keyval = substr($NVPString, 0, $keypos);
		
			// value
			$valuepos = strpos($NVPString,'&') ? strpos($NVPString,'&'): strlen($NVPString);
			$valval   = substr($NVPString, $keypos + 1, $valuepos - $keypos - 1);
		
			// decoding the respose
			$proArray[$keyval] = urldecode($valval);
			$NVPString = substr($NVPString, $valuepos + 1, strlen($NVPString));
		}
		
		return $proArray;
	}
}


?>