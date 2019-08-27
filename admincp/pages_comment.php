<?php

$gid = intval($_GET['pc_id']);

if ($_REQUEST['delete'] == "pc"){
    $deletepc = mysql_query("DELETE FROM `page_comments` WHERE pc_id='$gid'") or die(mysql_error());
    if (isset($deletepc)){
        die ("<center>تم حذف التعليق بنجاح...</center><meta http-equiv='refresh' content='2; url=?cppages=pages_comment' />");
    }
}

$pc_name = $_POST['pc_name'];
$pc_mail = $_POST['pc_mail'];
$pc_date = $_POST['pc_date'];
$pc_text = $_POST['pc_text'];
$pc_active = $_POST['pc_active'];
$pc_country = $_POST['pc_country'];
$page_id = $_POST['page_id'];
$pc_id = $_POST['pc_id'];
$pc_ip = $_POST['pc_ip'];
$update = $_POST['update'];

if (isset($update) && $update == "pc"){
    $pcupdate = mysql_query("UPDATE `page_comments` SET pc_name='$pc_name',pc_mail='$pc_mail',pc_date='$pc_date',pc_text='$pc_text',pc_active='$pc_active',pc_country='$pc_country',page_id='$page_id',pc_ip='$pc_ip' WHERE pc_id='$pc_id'") or die(mysql_error());
    if (isset($pcupdate)){
        die ("<center>تم تعديل التعليق بنجاح...</center><meta http-equiv='refresh' content='2; url=?cppages=pages_comment' />");
    }
}

/////////////////////////////////////////////////////////////////////////////////////
$show2edit = mysql_query("SELECT * FROM `page_comments` WHERE pc_id='$gid'") or die (mysql_error());
$row2edit = mysql_fetch_object($show2edit);
if ($_REQUEST['edit'] == "pc"){
    echo "
<form action='?cppages=pages_comment' method='post'>
    <table align='center' width='100%' cellpadding='0' cellspacing='0'>
     <tr>
         <td colspan='2' class='table' align='center'>تعديل التعليق</td>
     </tr>
     <tr>
         <td width='20%' class='table2'>أسم المعلق</td>
         <td width='80%' class='table2'><input type='text' name='pc_name' value='$row2edit->pc_name' /></td>
     </tr>
     <tr>
         <td width='20%' class='table3'>البريد الألكترونى</td>
         <td width='80%' class='table3'><input type='email' name='pc_mail' value='$row2edit->pc_mail' /></td>
     </tr>
     <tr>
         <td width='20%' class='table2'>التعليق</td>
         <td width='80%' class='table2'><textarea name='pc_text' rows='8' cols='54'>$row2edit->pc_text</textarea></td>
     </tr>
      <tr>
         <td width='20%' class='table3'>الدولة</td>
         <td width='80%' class='table3'><input type='text' name='pc_country' value='$row2edit->pc_country' /></td>
     </tr>
     <tr>
         <td width='20%' class='table2'>حالة التعليق</td>
         <td width='80%' class='table2'>
            <select name='pc_active'>";
    if ($row2edit->pc_active == 1){
        echo "<option value='1'>مفعله</option>
                <option value='2'>غير مفعله</option>";
    }else{
        echo "<option value='2'>غير مفعله</option>
                <option value='1'>مفعله</option>";
    }
    echo "</select>
         </td>
     </tr>
     <tr>
        <td colspan='2' align='center' class='tabl3'><input type='submit' class='buttons' value= 'حفظ التعليق'/></td>
     </tr>
    </table>
    <input type='hidden' name='pc_id' value='$gid' />
    <input type='hidden' name='pc_ip' value='$row2edit->pc_ip' />
    <input type='hidden' name='page_id' value='$row2edit->page_id' />
    <input type='hidden' name='pc_date' value='$row2edit->pc_date' />
    <input type='hidden' name='update' value='pc' />
</form>
";
}
/////////////////////////////////////////////////////////////////////////////////////

$showpagescomments = mysql_query("SELECT * FROM `page_comments` INNER JOIN `pages` ON page_comments.page_id=pages.page_id ORDER BY page_comments.pc_id DESC") or die(mysql_error());
echo "
<table align='center' width='100%' cellpadding='0' cellspacing='0'>
    <tr>
        <td align='center' class='table' colspan='4'>التعليقات المتوفره</td>
    </tr>
    <tr>
        <td width='20%' class='table3'>المعلق</td>
        <td width='40%' class='table3'>جزء من التعليق</td>
        <td width='20%' class='table3'>علق على الصفحه</td>
        <td width='20%' class='table3'>الخيارات</td>
    </tr>
";
while ($rowpc = mysql_fetch_object($showpagescomments)){
    echo "
    <tr>
        <td width='20%' class='table2'>$rowpc->pc_name</td>
        <td width='40%' class='table2'>".mb_substr($rowpc->pc_text, 0, 30, 'UTF-8')."</td>
        <td width='20%' class='table2'><a href='../page.php?page_id=$rowpc->page_id' target='_blank'>$rowpc->page_name</a></td>
        <td width='20%' class='table2'>
        <a href='?cppages=pages_comment&delete=pc&pc_id=$rowpc->pc_id'>حذف</a>   -
        <a href='?cppages=pages_comment&edit=pc&pc_id=$rowpc->pc_id'>تعديل</a>
        </td>
    </tr>
    ";
}
echo "</table>";
?>