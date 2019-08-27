<?php
require_once "config.php";

$site_info = mysql_query("SELECT * FROM `main_settings`") or die(mysql_error());

$site = mysql_fetch_object($site_info);

$sname = $site->sname;
$surl = $site->surl;
$smail = $site->smail;
$sdesc = $site->sdesc;
$stags = $site->stags;
$sclose = $site->sclose;
$stclose = stripslashes($site->stextclose);
$shturn = $site->sheadturn;
$sht = stripslashes($site->sheadt);
$sfturn = $site->sfooterturn;
$sft = stripslashes($site->sfootert);
$cr = stripslashes($site->crights);

if($sclose == 2){
    die("<meta http-equiv='content-type' content='text/html; charset=UTF-8'/><title>الموقع مغلق :: $sname</title><center>$stclose</center>");
}

?>
