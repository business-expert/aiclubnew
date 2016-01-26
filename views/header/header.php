<!DOCTYPE html>
<html lang="en">
<head>
	<title>AI Club - Register</title>

	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<link rel="shortcut icon" href="favicon.ico">
	<link rel="icon" type="image/gif" href="animated_favicon1.gif">
	
    <link href="<?=CSS?>default.css" rel="stylesheet">    
    <link href="<?=CSS?>main.css" rel="stylesheet">        
    <link href="<?=CSS?>popup.css" rel="stylesheet">            
	<script src="<?=JS?>jquery-1.7.2.min.js"></script>
	<script src="<?=JS?>jquery.validate.js"></script>
    <script src="<?=JS?>default.js"></script>
		
</head>
<script>

function setleftmenuposition(cmd)
{
	if(isMobile.any()!=null)
	{
		if(cmd==2) return;
	
		$("#leftmenu").hide();
		$("#formobile").html($("#leftmenu").html());
	
		return;
	}
	else
	{
		$('#formobile').hide();			
	
		var p = $("#container");
		var position = p.position();
		var w=position.left + 1000;
	
		$("#leftmenu").css({'left':w});
	}
}


var isMobile = {
	Android: function() {
		return navigator.userAgent.match(/Android/i);
	},

	BlackBerry: function() {
		return navigator.userAgent.match(/BlackBerry/i);
	},

	iOS: function() {
		return navigator.userAgent.match(/iPhone|iPad|iPod/i);
	},

	Opera: function() {
		return navigator.userAgent.match(/Opera Mini/i);
	},

	Windows: function() {
		return navigator.userAgent.match(/IEMobile/i);
	},

	any: function() {
		return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
	}
};

</script>
<body onload="setleftmenuposition(1)" onresize="setleftmenuposition(2)">
<div id="leftmenu" style="position: fixed; left: 1173px; top: 150px; width: 120px; height: 201px;">
  <div style="background:url(<?=IMAGES?>/leftmenu.png);width:120px;height:201px">
    <div style="border:0px solid;cursor:pointer;height:50px;margin-top:7px" onclick="pageto('index.php')"></div>
    <div style="border:0px solid;cursor:pointer;height:50px;margin-top:15px" onclick="pageto('aboutus.php')"></div>
    <div style="border:0px solid;cursor:pointer;height:50px;margin-top:15px" onclick="pageto('contactus.php')"></div>
  </div>
</div>
<center>
  <table id="container" style="background:#F2FEFE;width:74%;" border="0" cellpadding="0" cellspacing="0">
    <tbody>
      <tr>
        <td><img src="<?=IMAGES?>/header.png"></td>
        <td id="formobile" style="position: relative; top: 150px; display: none;"><img src="<?=IMAGES?>/tmpleftmenu.png"></td>
      </tr>
