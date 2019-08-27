<?php
session_start();
$txt = rand(1000,9999);
$_SESSION['code'] = $txt;
$img = imagecreate(50,16);
$bg = imagecolorallocate($img,255,255,255);
$fc = imagecolorallocate($img,0,0,0);
imagestring($img,10,2,2,$txt,$fc);
imagejpeg($img);

?>