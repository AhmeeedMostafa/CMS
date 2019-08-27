<?php
// CREATE TABLE  `pages` =page_id,page_name,page_content,page_active,page_count,page_comm_active
$page_name = strip_tags($_POST['page_name']);
$page_content = addslashes($_POST['page_content']);
$page_active = $_POST['page_active'];
$page_count = $_POST['page_count'];
$page_comm_active = $_POST['page_comm_active'];
$page_id = $_POST['page_id'];
$gpageid = intval($_GET['page_id']);
###############################إضافة صفحة جديده#######################
if (isset($_POST['add']) && $_POST['add'] == "newpage"){
    $addnewpage = mysql_query("INSERT INTO `pages` (page_name,page_content,page_active,page_count,page_comm_active) VALUES('$page_name','$page_content','$page_active','$page_count','$page_comm_active')") or die(mysql_error());
    if (isset($addnewpage)){
        die ("<center>تم إضافة الصفحة بنجاح ...</center><meta http-equiv='refresh' content='2; url=?cppages=custom_pages' />");
    }
}
##################### للتعديل ########################
if (isset($_POST['edit']) && $_POST['edit'] == "page"){
    $updatepages = mysql_query("UPDATE `pages` SET page_name='$page_name',page_content='$page_content',page_active='$page_active',page_count='$page_count',page_comm_active='$page_comm_active' WHERE page_id='$page_id'") or die(mysql_error());
    if (isset($updatepages)){
        die ("<center>تم تعديل الصفحة بنجاح ...</center><meta http-equiv='refresh' content='2; url=?cppages=custom_pages' />");
    }
}
########################حذف الصفحه###################
if ($_REQUEST['delete'] == "pages"){
    $deletepages = mysql_query("DELETE FROM `pages` WHERE page_id='$gpageid'") or die(mysql_error());
    if (isset($deletepages)){
        die ("<center>تم حذف الصفحة بنجاح...</center><meta http-equiv='refresh' content='2; url=?cppages=custom_pages' />");
    }
}
###################تفعيل الصفحة######################
if ($_REQUEST['active'] == "pages"){
    $activepages = mysql_query("UPDATE `pages` SET page_active='1' WHERE page_id='$gpageid'") or die(mysql_error());
    if (isset($activepages)){
        die ("<center>تم تفعيل الصفحة بنجاح...</center><meta http-equiv='refresh' content='2; url=?cppages=custom_pages' />");
    }
}
######################إلغاء تفعيل الصفحة#############
if ($_REQUEST['unactive'] == "pages"){
    $unactivepages = mysql_query("UPDATE `pages` SET page_active='2' WHERE page_id='$gpageid'") or die(mysql_error());
    if (isset($unactivepages)){
        die ("<center>تم إلغاء تفعيل الصفحة بنجاح...</center><meta http-equiv='refresh' content='2; url=?cppages=custom_pages' />");
    }
}
#####################تفعيل التعليقات#################
if ($_REQUEST['active'] == "comments"){
    $activecomments = mysql_query("UPDATE `pages` SET page_comm_active='1' WHERE page_id='$gpageid'") or die(mysql_error());
    if (isset($activecomments)){
        die ("<center>تم تفعيل التعليقات بنجاح...</center><meta http-equiv='refresh' content='2; url=?cppages=custom_pages' />");
    }
}
#####################إلغاء تفعيل التعليقات###########
if ($_REQUEST['unactive'] == "comments"){
    $unactivecomments = mysql_query("UPDATE `pages` SET page_comm_active='2' WHERE page_id='$gpageid'") or die(mysql_error());
    if (isset($unactivecomments)){
        die ("<center>تم إلغاء تفعيل التعليقات بنجاح...</center><meta http-equiv='refresh' content='2; url=?cppages=custom_pages' />");
    }
}
#############################فورم الإضافه########################
echo "<a href='?cppages=custom_pages&add=pages'><h3><center>إضافة صفحة جديدة<br /></center></h3></a>";
if ($_REQUEST['add'] == "pages"){
    echo "<form action='?cppages=custom_pages' method='post'>
    <table width='100%' align='center' cellpadding='0' cellspacing='0'>
        <tr>
            <td colspan='2' class='table'>إضافة صفحة جديده</td>
        </tr>
        <tr>
            <td class='table2' width='20%'>أسم الصفحه</td>
            <td class='table2' width='80%'><input type='text' required='required' name='page_name' /></td>
        </tr>
        <tr>
            <td class='table3' width='20%'>محتوى الصفحه</td>
            <td class='table3' width='80%'><textarea required='required' name='page_content' rows='8' cols='40'></textarea></td>
        </tr>
        <tr>
            <td class='table2' width='20%'>حالة ظهور الصفحه</td>
            <td class='table2' width='80%'>
                <select name='page_active'>
                    <option value='1'>مفعله للزوار</option>
                    <option value='2'>غير مفعله للزوار</option>
                </select>
            </td>
        </tr>
        <tr>
            <td class='table3' width='20%'>التعليقات على الصفحه</td>
            <td class='table3' width='80%'>
                <select name='page_comm_active'>
                    <option value='1'>مفعله</option>
                    <option value='2'>غير مفعله</option>
                </select>
            </td>
        </tr>
        <tr>
            <td colspan='2' align='center'><input class='buttons' type='submit' value='إضافة الصفحه' /></td>
        </tr>
    </table>
    <input type='hidden' name='page_count' value='0' />
    <input type='hidden' name='add' value='newpage' />
</form>";
}

$showpagestoedit = mysql_query("SELECT * FROM `pages` WHERE page_id='$gpageid'") or die (mysql_error());
$rowpageedit = mysql_fetch_object($showpagestoedit);

#فورم التعديل###############################################
echo "<a href='?cppages=custom_pages&edit=pages'></a>";
if ($_REQUEST['edit'] == "pages"){
    echo "<form action='?cppages=custom_pages' method='post'>
    <table width='100%' align='center' cellpadding='0' cellspacing='0'>
        <tr>
            <td colspan='2' class='table'>تعديل الصفحة</td>
        </tr>
        <tr>
            <td class='table2' width='20%'>أسم الصفحه</td>
            <td class='table2' width='80%'><input type='text' name='page_name' value='$rowpageedit->page_name' /></td>
        </tr>
        <tr>
            <td class='table3' width='20%'>محتوى الصفحه</td>
            <td class='table3' width='80%'><textarea name='page_content' rows='8' cols='40'>$rowpageedit->page_content</textarea></td>
        </tr>
        <tr>
            <td class='table2' width='20%'>حالة ظهور الصفحه</td>
            <td class='table2' width='80%'>
                <select name='page_active'>";
    if ($rowpageedit->page_active == 1){
        echo
        "<option value='1'>مفعله للزوار</option>
         <option value='2'>غير مفعله للزوار</option>";
    }else{
        echo
        "<option value='2'>غير مفعله للزوار</option>
         <option value='1'>مفعله للزوار</option>";
    }
                echo "</select>
            </td>
        </tr>
        <tr>
            <td class='table3' width='20%'>التعليقات على الصفحه</td>
            <td class='table3' width='80%'>
                <select name='page_comm_active'>";
    if ($rowpageedit->page_comm_active == 1){
        echo
        "<option value='1'>مفعله</option>
        <option value='2'>غير مفعله</option>";
    }else{
        echo
        "<option value='2'>غير مفعله</option>
        <option value='1'>مفعله</option>";
    }
               echo" </select>
            </td>
        </tr>
        <tr>
            <td colspan='2' align='center'><input class='buttons' type='submit' value='تعديل الصفحه'/></td>
        </tr>
    </table>
    <input type='hidden' name='page_count' value='$rowpageedit->page_count' />
    <input type='hidden' name='edit' value='page' />
    <input type='hidden' name='page_id' value='$rowpageedit->page_id' />
</form>";
}

#========================================عرض البيانات ============================#

$showpages = mysql_query("SELECT * FROM `pages` ORDER BY page_id ASC") or die(mysql_error());

echo "
    <table width='100%' align='center' cellpadding='0' cellspacing='0'>
        <tr>
            <td colspan='4' align='center' class='table'>الصفحات الموجودة</td>
        </tr>
        <tr>
            <td class='table2' width='35%'>أسم الصفحة</td>
            <td class='table2' width='5%'>الزيارات</td>
            <td class='table2' width='30%'>رابط الصفحة</td>
            <td class='table2' width='30%'>خيارات</td>
        </tr>";

        while ($rowpages = mysql_fetch_object($showpages)){
            echo "        <tr>
            <td class='table2' width='35%'>$rowpages->page_name</td>
            <td class='table2' width='5%'>$rowpages->page_count</td>
            <td class='table2' width='30%'><a href='../page.php?page_id=$rowpages->page_id' target='_blank'>مشاهدة الصفحة</a></td>
            <td class='table2' width='30%'>
                <a href='?cppages=custom_pages&edit=pages&page_id=$rowpages->page_id'>تعديل</a> -
                <a href='?cppages=custom_pages&delete=pages&page_id=$rowpages->page_id'>حذف</a> -";
            if ($rowpages->page_active == 1){
                echo "<a href='?cppages=custom_pages&unactive=pages&page_id=$rowpages->page_id'>إلغاء تفعيل الصفحة</a> -";
            }else{
                echo "<a href='?cppages=custom_pages&active=pages&page_id=$rowpages->page_id'>تفعيل الصفحة</a> -";
            }
            if ($rowpages->page_comm_active == 1){
                echo "<a href='?cppages=custom_pages&unactive=comments&page_id=$rowpages->page_id'>إلغاء تفعيل التعليقات</a>";
            }else{
                echo "<a href='?cppages=custom_pages&active=comments&page_id=$rowpages->page_id'>تفعيل التعليقات</a>";
            }
            echo "</td>
        </tr>";
        }
    echo "</table>";
?>