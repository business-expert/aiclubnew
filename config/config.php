<?php

define('SITENAME','aiclub');
define('DOCUMENT_ROOT', $_SERVER['DOCUMENT_ROOT']."/".SITENAME);
define('SITE_PATH', "http://".$_SERVER['HTTP_HOST']."/".SITENAME);

define('SITE_ADMIN','aiclub/admin');
define('DOCUMENT_ROOT_ADMIN', $_SERVER['DOCUMENT_ROOT']."/".SITE_ADMIN);
define('SITE_PATH_ADMIN', "http://".$_SERVER['HTTP_HOST']."/".SITE_ADMIN);

define('ROOT', dirname(__FILE__));
define('CONFIG', DOCUMENT_ROOT.'/config');

define('MODELS_ADMIN', DOCUMENT_ROOT_ADMIN.'/models');
define('CONTROLLERS_ADMIN', DOCUMENT_ROOT_ADMIN.'/controllers');
define('VIEWS_ADMIN', DOCUMENT_ROOT_ADMIN.'/views');
define('LIBS_ADMIN', DOCUMENT_ROOT_ADMIN.'/libraries');
define('AJAX_ADMIN', DOCUMENT_ROOT_ADMIN.'/ajax');

define('MODELS', DOCUMENT_ROOT.'/models');
define('CONTROLLERS', DOCUMENT_ROOT.'/controllers');
define('VIEWS', DOCUMENT_ROOT.'/views');
define('LIBS', DOCUMENT_ROOT.'/libraries');
define('AJAX', DOCUMENT_ROOT.'/ajax');

define('MEDIA_ADMIN', SITE_PATH_ADMIN.'/media');
define('IMAGES_ADMIN', MEDIA_ADMIN.'/img/');
define('CSS_ADMIN', MEDIA_ADMIN.'/css/');
define('JS_ADMIN', MEDIA_ADMIN.'/js/');

define('MEDIA', SITE_PATH.'/media');
define('IMAGES', MEDIA.'/img/');
define('CSS', MEDIA.'/css/');
define('JS', MEDIA.'/js/');

define('LOG_PATH',DOCUMENT_ROOT.'/log/');
define('LOG_FILE_NAME',date("Y_m_d_H").".txt");
define('SQL_ERROR_FILE_NAME',"query_error_".date("Y_m_d_H").".txt");

define('ADMIN_EMAIL','louis.cheng@athenaintellects.com');

define('RECORD_PER_PAGE',10);
define("CURRENCY","HKD");
#-------------- SMTP ------------- #

define('SMTP_HOST','smtp.gmail.com');      					// sets GMAIL as the SMTP server
define('SMTP_PORT',465);                   					// set the SMTP port for the GMAIL server
define('SMTP_USERNAME',"pankaj.index@gmail.com"); 	// GMAIL username
define('SMTP_PASSWORD',"51@546162");
define('EMAIL_FROM',"pankaj.index@gmail.com");
define('EMAIL_FROM_NAME',"AI Club");

#------------------------ PAYPAL ---------------------------#

define('PAYPAL_USERNAME','info_api1.athenaintellects.com');
define('PAYPAL_PASSWORD','Y2LBLJ8GVWZ8ZM5G');
define('PAYPAL_SIGNATURE','AFcWxV21C7fd0v3bYYYRCpSSRl31AaAXgh2bZMTxObPeX6WG2I3J6YYF');

/*
define('PAYPAL_USERNAME','rakesh.r.singh-facilitator_api1.hotmail.com');
define('PAYPAL_PASSWORD','1365084092');
define('PAYPAL_SIGNATURE','ApWtLka4wULT62MRX9srLoCdTAgEAQ8TaH1gX7YKJYYplhlApLOtxPkz');
*/

define('PAYPAL_API_VERSION','93');
define('PAYPAL_CURRENCY_CODE','HKD');
define('PAYPAL_RETURN_URL','http://125.63.74.122/aiclub/index.php?model=member&action=paid');
define('PAYPAL_CANCEL_URL','http://125.63.74.122/aiclub/index.php?model=member&action=cancel');
//define("PAYPAL_TOKEN_URL","https://api-3t.sandbox.paypal.com/nvp");
//define("PAYPAL_URL","https://www.sandbox.paypal.com");
define("PAYPAL_TOKEN_URL","https://api-3t.paypal.com/nvp");
define("PAYPAL_URL","https://www.paypal.com");
		
?>
