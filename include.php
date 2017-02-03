<?php

/* 
 * This file holds the include files like any javascript, CSS etc 
 */

// Start the session
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Hindol Dasgupta</title>
<link rel="icon" type="image/png" href="http://example.com/myicon.png" />

<link type="text/css" href="jquery-ui-1.11.3/jquery-ui.css" rel="stylesheet"/>
<!-- MENU -->
<link rel="stylesheet" href="bootstrap-submenu-1.2.11-dist/css/bootstrap.min.css"/>
<link rel="stylesheet" href="bootstrap-submenu-1.2.11-dist/css/bootstrap-theme.min.css"/>
<link rel="stylesheet" href="bootstrap-submenu-1.2.11-dist/css/bootstrap-submenu.min.css"/>
<!-- END -->
<link type="text/css" rel="stylesheet" href="css/global.css" />

<script src="jquery-ui-1.11.3/external/jquery/jquery.js"></script>
<script src="jquery-ui-1.11.3/jquery-ui.js"></script>
<script src="jquery-validation-1.13.1/dist/jquery.validate.js"></script>
<script src="js/prescription.js"></script>

<script src="bootstrap-submenu-1.2.11-dist/js/bootstrap.min.js" defer></script>
<script src="bootstrap-submenu-1.2.11-dist/js/bootstrap-submenu.min.js" defer></script>

<script type="text/ecmascript">
    
function func_print()
{ 
  var disp_setting="toolbar=no,location=no,directories=yes,menubar=no,"; 
      disp_setting+="scrollbars=yes, width=900, height=600, resize=yes"; 
  var content_vlue = document.getElementById("a4").innerHTML; 
  
  var docprint=window.open("","",disp_setting); 
   docprint.document.open(); 
   docprint.document.write('<html><head><title>:: Dr. Hindol Dasgupta :: Prescription Management</title>'); 
   docprint.document.write('<link href="css/global.css" rel="stylesheet" type="text/css">');
   docprint.document.write('</head><body onLoad="self.print()">');          
   docprint.document.write(content_vlue);          
   docprint.document.write('</body></html>'); 
   docprint.document.close(); 
   docprint.focus(); 
}

</script>
<body>
<div id="a4">
<?php
include_once './datacon.php';
?>