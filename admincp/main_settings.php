<?php

//`main_settings` = sname,surl,smail,sdesc,stags,sclose,stextclose,adminmsg

// `main_settings` = sheadturn,sheadt,sfooterturn,sfootert,crights



$query = mysql_query("SELECT sname,surl,smail,sdesc,stags,sclose,stextclose,sheadturn,sheadt,sfooterturn,sfootert,crights FROM `main_settings` ") or die(mysql_error());
$row = mysql_fetch_object($query);

$sname = strip_tags($_POST['sname']);
$surl = strip_tags($_POST['surl']);
$smail = strip_tags($_POST['smail']);
$sdesc = strip_tags($_POST['sdesc']);
$stags = strip_tags($_POST['stags']);
$sclose = $_POST['sclose'];
$stclose = addslashes($_POST['stextclose']);
$sheadturn = $_POST['sheadturn'];
$sheadt = addslashes($_POST['sheadt']);
$sfooterturn = $_POST['sfooterturn'];
$sfootert = addslashes($_POST['sfootert']);
$crights = addslashes($_POST['crights']);
if(isset($_POST['do']) && $_POST['do'] == "save"){
       $update = mysql_query("UPDATE `main_settings` SET sname='".$sname."',surl='".$surl."',smail='".$smail."',sdesc='".$sdesc."',stags='".$stags."',sclose='".$sclose."',stextclose='".$stclose."',sheadturn='$sheadturn',sheadt='$sheadt',sfooterturn='$sfooterturn',sfootert='$sfootert',crights='$crights'") or die (mysql_error());
    if (isset($update)){
        die ("<center>تم حفظ الإعدادات بنجاح ...</center>.<meta http-equiv='refresh' content='2; url=?cppages=main_settings' />");
    }
}


echo "
<form action='?cppages=main_settings' method='post'>
    <table align='center' width='100%' cellpadding='0' cellspacing='0'>
        <tr>
            <td class='table' colspan='2'>الأعدادات الرئيسية</td>
        </tr>
        <tr>
            <td class='table2'>اسم الموقع</td>
            <td class='table2'><input type='text' name='sname' value='$row->sname' /></td>
        </tr>
        <tr>;
            <td class='table3'>رابط الموقع</td>
            <td class='table3'><input type='text' name='surl' value='$row->surl' /></td>
        </tr>
        <tr>
            <td class='table2'>بريد الموقع</td>
            <td class='table2'><input type='text' name='smail' value='$row->smail' /></td>
        </tr>
        <tr>
            <td class='table3'>وصف الموقع</td>
            <td class='table3'><textarea name='sdesc' rows='5' cols='40'>$row->sdesc</textarea></td>
        </tr>
        <tr>
            <td class='table2'>الكلمات الدليليه</td>
            <td class='table2'><textarea name='stags' rows='5' cols='40'>$row->stags</textarea></td>
        </tr>
        <tr>
            <td class='table3'>حالة الموقع</td>
            <td class='table3'>
                <select name='sclose'>";
if($row->sclose == 1){
    echo
   "<option value='1'>مفتوح للزوار</option>
    <option value='2'>مغلق للزوار</option>";
}else{
    echo
    "<option value='2'>مغلق للزوار</option>
    <option value='1'>مفتوح للزوار</option>";
}

echo "
                </select>
            </td>
        </tr>
        <tr>
            <td class='table2'>رسالة الإغلاق</td>
            <td class='table2'><textarea name='stextclose' rows='5' cols='40'>$row->stextclose</textarea></td>
        </tr><br />
        <tr>
            <td class='table' colspan='2'>إعدادات الرأس و التذييل</td>
        </tr>
        <tr>
            <td class='table2'>شتغيل رأس الصفحه</td>
            <td class='table2'>
                <select name='sheadturn'>";

            if ($row->sheadturn == 1){
               echo "<option value='1'>مفعل</option>
                <option value='2'>غير مفعل</option>";
            }else{
               echo "<option value='2'>غير مفعل</option>
                    <option value='1'>مفعل</option>";
            }

            echo "
                </select>
            </td>
        </tr>
        <tr>
            <td class='table3'>محتوى رأس الصفحه</td>
            <td class='table3'>
                <textarea name='sheadt' rows='5' cols='40'>$row->sheadt</textarea>
            </td>
        </tr>
        <tr>
            <td class='table2'>تشغيل حاشية الموقع</td>
            <td class='table2'>
                <select name='sfooterturn'>";

             if ($row->sfooterturn == 1){
                echo "<option value='1'>مفعل</option>
                    <option value='2'>غير مفعل</option>";
             }else{
                 echo "<option value='2'>غير مفعل</option>
                    <option value='1'>مفعل</option>";
             }

            echo "
                </select>
             </td>
        </tr>
        <tr>
            <td class='table3'>محتوى التذييل</td>
            <td class='table3'>
                 <textarea name='sfootert' rows='5' cols='40'>$row->sfootert</textarea>
            </td>
        </tr>
        <tr>
            <td class='table2'>حقوق الموقع</td>
            <td class='table2'>
                  <textarea name='crights' rows='5' cols='40'>$row->crights</textarea>
            </td>
        </tr>
        <tr>
            <td align='center' colspan='2'>
                <input class='buttons' type='submit' value='حفظ العمل' />
            </td>
        </tr>
    </table>
    <input type='submit' name='do' value='save' />
</form>";
?>