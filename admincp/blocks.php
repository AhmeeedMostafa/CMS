<?php

$b_dir = strip_tags($_POST['b_dir']);
$b_order = strip_tags($_POST['b_order']);
$b_name = strip_tags($_POST['b_name']);
$b_content = addslashes($_POST['b_content']);
$b_active = $_POST['b_active'];
$pid = $_POST['b_id'];
$getblockid = intval($_GET['b_id']); #جلب الأى دى

if (isset($_POST['add']) && $_POST['add'] == "block"){
    if (empty($b_order)){
        echo "<center>يرجى إدخال ترتيب القائمة</center>";
    }elseif (empty($b_name)){
        echo "<center>يرجى إدخال أسم القائمة من فضلك</center>";
    }elseif (empty($b_content)){
        echo "<center>يرجى إدخال محتوى القائمة</center>";
    }else{
        $addblock = mysql_query("INSERT INTO `blocks` (b_dir,b_order,b_name,b_content,b_active) VALUES ('$b_dir','$b_order','$b_name','$b_content','$b_active')") or die(mysql_error());
        if (isset($addblock)){
            die ("<center>تم حفظ القائمة بنجاح</center><meta http-equiv='refresh' content='2; url=?cppages=blocks' />");
        }
    }
}

#===============================================================#

if (isset($_POST['edit']) && $_POST['edit'] == "blocks"){
    $updateblocks = mysql_query("UPDATE `blocks` SET b_dir='$b_dir',b_order='$b_order',b_name='$b_name',b_content='$b_content',b_active='$b_active' WHERE b_id='$pid'") or die(mysql_error());
    if (isset($updateblocks)){
        die ("<center>تم تعديل القائمة بنجاح...</center><meta http-equiv='refresh' content='2; url=?cppages=blocks' />");
    }
}

if ($_REQUEST['delete'] == "block"){
    $deleteblock = mysql_query("DELETE FROM `blocks` WHERE b_id='$getblockid'") or die(mysql_error());
    if (isset($deleteblock)){
        die ("<center>تم حذف القائمة بنجاح ...</center><meta http-equiv='refresh' content='2; url=?cppages=blocks' />");
    }
}

if ($_REQUEST['active'] == "block"){
    $activeblock = mysql_query("UPDATE `blocks` SET b_active='1' WHERE b_id='$getblockid'") or die(mysql_error());
    if(isset($activeblock)){
        die ("<center>تم تفعيل القائمة بنجاح ...</center><meta http-equiv='refresh' content='2; url=?cppages=blocks' />");
    }
}

if ($_REQUEST['unactive'] == "block"){
    $unactiveblock = mysql_query("UPDATE `blocks` SET b_active='2' WHERE b_id='$getblockid'") or die (mysql_error());
    if (isset($unactiveblock)){
        die("<center>تم إلغاء تفعيل القائمة بنجاح ...</center><meta http-equiv='refresh' content='2; url=?cppages=blocks' />");
    }
}
#===============================================================#

echo "<center><h3><a href='?cppages=blocks&add=newblock'>أضف قائمة جديدة</a></h3></center><br/>";

if ($_REQUEST['add'] == "newblock"){
echo "
<form action='?cppages=blocks' method='post'>
    <table align='center' width='100%' cellpadding='0' cellspacing='0'>
        <tr>
            <td width='100%' align='center' class='table' colspan='2'>إضافة قائمة</td>
        </tr>
        <tr>
            <td width='20%' class='table2'>أسم القائمة</td>
            <td width='80%' class='table2'><input type='text' name='b_name' /></td>
        </tr>
        <tr>
            <td width='20%' class='table3'>ترتيب القائمة</td>
            <td width='80%' class='table3'><input size='4' type='text' name='b_order' /></td>
        </tr>
        <tr>
            <td width='20%' class='table2'>مكان القائمة</td>
            <td width='80%' class='table2'>
                <select name='b_dir'>
                <option value='1'>يمين</option>
                <option value='2'>أعلى المنتصف</option>
                <option value='3'>أسفل المنتصف</option>
                <option value='4'>يسار</option>
                </select>
            </td>
        </tr>
        <tr>
            <td width='20%' class='table3'>محتوى القائمة</td>
            <td width='80%' class='table3'><textarea name='b_content' rows='8' cols='40'></textarea></td>
        </tr>
        <tr>
            <td width='20%' class='table2'>حالة ظهور القائمة</td>
            <td width='80%' class='table2'>
                <select name='b_active'>
                <option value='1'>مفعله</option>
                <option value='2'>غير مفعله</option>
                </select>
            </td>
        </tr>
        <tr>
            <td width='100%' align='center' class='table' colspan='2' class='buttons'>
                <input type='submit' value='حفظ القائمة' />
            </td>
        </tr>
    </table>
    <input type='hidden' name='add' value='block' />
</form>";
}

#=============================================================================================#
$showblocktoedit = mysql_query("SELECT * FROM `blocks` WHERE b_id='$getblockid'") or die(mysql_error());
$rowblockedit = mysql_fetch_object($showblocktoedit);

#ريكويست التعديل
if ($_REQUEST['edit'] == "block"){
    echo "
<form action='?cppages=blocks' method='post'>
    <table align='center' width='100%' cellpadding='0' cellspacing='0'>
        <tr>
            <td width='100%' align='center' class='table' colspan='2'>تعديل القائمة</td>
        </tr>
        <tr>
            <td width='20%' class='table2'>أسم القائمة</td>
            <td width='80%' class='table2'><input type='text' name='b_name' value='$rowblockedit->b_name' /></td>
        </tr>
        <tr>
            <td width='20%' class='table3'>ترتيب القائمة</td>
            <td width='80%' class='table3'><input size='4' type='text' name='b_order' value='$rowblockedit->b_order' /></td>
        </tr>
        <tr>
            <td width='20%' class='table2'>مكان القائمة</td>
            <td width='80%' class='table2'>
                <select name='b_dir'>";
        if ($rowblockedit->b_dir == '1'){
            echo "
                <option value='1'>يمين</option>
                <option value='2'>أعلى المنتصف</option>
                <option value='3'>أسفل المنتصف</option>
                <option value='4'>يسار</option>";
        }elseif ($rowblockedit->b_dir == '2'){
            echo "
                <option value='2'>أعلى المنتصف</option>
                <option value='1'>يمين</option>
                <option value='3'>أسفل المنتصف</option>
                <option value='4'>يسار</option>";
        }elseif ($rowblockedit->b_dir == '3'){
            echo "
                <option value='3'>أسفل المنتصف</option>
                <option value='1'>يمين</option>
                <option value='2'>أعلى المنتصف</option>
                <option value='4'>يسار</option>";
        }else{
            echo "
                <option value='4'>يسار</option>
                <option value='1'>يمين</option>
                <option value='2'>أعلى المنتصف</option>
                <option value='3'>أسفل المنتصف</option>";
        }

                echo "</select>
            </td>
        </tr>
        <tr>
            <td width='20%' class='table3'>محتوى القائمة</td>
            <td width='80%' class='table3'><textarea name='b_content' rows='8' cols='40'>stripslashes($rowblockedit->b_content)</textarea></td>
        </tr>
        <tr>
            <td width='20%' class='table2'>حالة ظهور القائمة</td>
            <td width='80%' class='table2'>
                <select name='b_active'>";
        if ($rowblockedit->b_active == '1'){
            echo "
                <option value='1'>مفعله</option>
                <option value='2'>غير مفعله</option>";
        }else{
            echo "
                <option value='2'>غير مفعله</option>
                <option value='1'>مفعله</option>";
        }

                echo "</select>
            </td>
        </tr>
        <tr>
            <td width='100%' align='center' class='table' colspan='2' class='buttons'>
                <input type='submit' value='حفظ القائمة' />
            </td>
        </tr>
    </table>
    <input type='hidden' name='edit' value='blocks' />
    <input type='hidden' name='b_id' value='$rowblockedit->b_id' />
</form>";
}

#عرض محتويات القائمة اليمنى
$right_block = mysql_query("SELECT b_id,b_dir,b_order,b_name,b_active FROM `blocks` WHERE b_dir='1' ORDER BY b_order ASC") or die (mysql_error());
$right_block_num = mysql_num_rows($right_block);

echo "<br />";

echo "
    <table align='center' width='100%' cellpadding='0' cellspacing='0'>
        <tr>
            <td class='table' align='center' width='100%' colspan='3'>القوائم المتوفرة</td>
        </tr>
        <tr>
            <td class='table2'>ترتيب القائمة</td>
            <td class='table3'>أسم القائمة</td>
            <td class='table3'>الخيارت</td>
        </tr>";
if ($right_block_num > 0){
    echo "
            <tr>
                <td width='100%' colspan='3' class='table2'>محتويات القائمة اليمنى</td>
            </tr>";
    while ($row_right_block = mysql_fetch_object($right_block)){
        echo "
            <tr>
                <td class='table3'>$row_right_block->b_order</td>
                <td class='table3'>$row_right_block->b_name</td>
                <td class='table3'><a href='?cppages=blocks&edit=block&b_id=$row_right_block->b_id'>تعديل</a> - <a href='?cppages=blocks&delete=block&b_id=$row_right_block->b_id'>حذف</a> -";
                if ($row_right_block->b_active == '2'){
                    echo "<a href='?cppages=blocks&active=block&b_id=$row_right_block->b_id'>تفعيل </a>";
                }else{
                    echo "<a href='?cppages=blocks&unactive=block&b_id=$row_right_block->b_id'>إلغاء التفعيل</a>";

                }
        echo "</td>
            </tr>
        ";
    }

#عرض محتويات القائمة اليسرى
    $left_block = mysql_query("SELECT b_id,b_dir,b_order,b_name,b_active FROM `blocks` WHERE b_dir='4' ORDER BY b_order ASC") or die (mysql_error());
    $left_block_num = mysql_num_rows($left_block);

    echo "<br />";

    if ($left_block_num > 0){
        echo "
            <tr>
                <td width='100%' colspan='3' class='table2'>محتويات القائمة اليسرى</td>
            </tr>";
        while ($row_left_block = mysql_fetch_object($left_block)){
            echo "
            <tr>
                <td class='table3'>$row_left_block->b_order</td>
                <td class='table3'>$row_left_block->b_name</td>
                <td class='table3'><a href='?cppages=blocks&edit=block&b_id=$row_left_block->b_id'>تعديل</a> - <a href='?cppages=blocks&delete=block&b_id=$row_left_block->b_id'>حذف</a> -";
             if ($row_left_block->b_active == '2'){
                 echo "<a href='?cppages=blocks&active=block&b_id=$row_left_block->b_id'>تفعيل </a>";
             }else{
                 echo "<a href='?cppages=blocks&unactive=block&b_id=$row_left_block->b_id'>إلغاء التفعيل</a>";
             }
            echo "</td>
            </tr>
        ";
        }
    }

#عرض محتويات القائمة العلويه
    $up_block = mysql_query("SELECT b_id,b_dir,b_order,b_name,b_active FROM `blocks` WHERE b_dir='2' ORDER BY b_order ASC") or die (mysql_error());
    $up_block_num = mysql_num_rows($up_block);

    echo "<br />";

    if ($up_block_num > 0){
        echo "
            <tr>
                <td width='100%' colspan='3' class='table2'>محتويات القائمة العلويه</td>
            </tr>";
        while ($row_up_block = mysql_fetch_object($up_block)){
            echo "
            <tr>
                <td class='table3'>$row_up_block->b_order</td>
                <td class='table3'>$row_up_block->b_name</td>
                <td class='table3'><a href='?cppages=blocks&edit=block&b_id=$row_up_block->b_id'>تعديل</a> - <a href='?cppages=blocks&delete=block&b_id=$row_up_block->b_id'>حذف</a> - ";
            if ($row_up_block->b_active == '2'){
                echo "<a href='?cppages=blocks&active=block&b_id=$row_up_block->b_id'>تفعيل </a>";
            }else{
                echo "<a href='?cppages=blocks&unactive=block&b_id=$row_up_block->b_id'>إلغاء التفعيل</a>";
            }
               echo "</td>
            </tr>
        ";
        }
    }

#عرض محتويات القائمة السفليه
    $down_block = mysql_query("SELECT b_id,b_dir,b_order,b_name,b_active FROM `blocks` WHERE b_dir='3' ORDER BY b_order ASC") or die (mysql_error());
    $down_block_num = mysql_num_rows($down_block);

    echo "<br />";

    if ($down_block_num > 0){
        echo "
            <tr>
                <td width='100%' colspan='3' class='table2'>محتويات القائمة السفليه</td>
            </tr>";
        while ($row_down_block = mysql_fetch_object($down_block)){
            echo "
            <tr>
                <td class='table3'>$row_down_block->b_order</td>
                <td class='table3'>$row_down_block->b_name</td>
                <td class='table3'><a href='?cppages=blocks&edit=block&b_id=$row_down_block->b_id'>تعديل</a> - <a href='?cppages=blocks&delete=block&b_id=$row_down_block->b_id'>حذف</a> - ";
            if ($row_down_block->b_active == '2'){
                echo "<a href='?cppages=blocks&active=block&b_id=$row_down_block->b_id'>تفعيل </a>";
            }else{
                echo "<a href='?cppages=blocks&unactive=block&b_id=$row_down_block->b_id'>إلغاء التفعيل</a>";
            }
                echo "</td>
            </tr>
        ";
        }
    }
    echo"
    </table>
";
}
?>
