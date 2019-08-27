<?php require_once "../inc/config.php"; ?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
    <link type="text/css" rel="stylesheet" href="styles/admincp.css" />
    <title>لوحة التحكم</title>
</head>
<body>

<table algin="center" width="100%" cellpadding="0" cellspacing="0">
    <tr>
        <td>
            <div id="header">مرحباً بك فى لوحة التحكم</div>
        </td>
    </tr>
</table>

<table align="center" width="100%" cellpadding="5" cellspacing="5">
    <tr>
        <td class="rpanel" width="15%" valign="top">
            <div class="head">الأعدادات العامة</div>
            <div class="bodypanel">
            <a href="index.php">الرئيسية</a><br />
            <a href="../index.php" target="_blank">معاينة الموقع</a><br />
            <a href="?cppages=main_settings">الأعدادت الرئيسية</a><br />
            </div>
            <div class="head">التحكم بالقوائم</div>
            <div class="bodypanel">
                <a href="?cppages=blocks">القوائم الجانبية</a><br />
            </div>
            <div class="head">نظام الصفحات الخاصه</div>
            <div class="bodypanel">
                <a href="?cppages=custom_pages">إعدادات الصفحات</a><br />
                <a href="?cppages=pages_comment">التعليقات على الصفحات</a><br />
            </div>
        </td>
        <td class="cpanel" width="85%" valign="top">
            <?php
            #إعدادات الملاحظات
            $amsg = strip_tags($_POST['adminmsg']);
            if (isset($_POST['doo']) && $_POST['doo'] == "save"){
                $save = mysql_query("UPDATE `main_settings` SET adminmsg='$amsg'") or die(mysql_error());
                if(isset($save)){
                    die("<center>تم حفظ الملاحظات بنجاح</center><meta http-equiv='refresh' content='2; url=index.php' />");
                }
            }
            $query = mysql_query("SELECT adminmsg FROM `main_settings`") or die(mysql_error()) ;
            $row = mysql_fetch_object($query);

            #الصفحه المطلوبه
             $page = $_GET['cppages'];
            if(isset($page)){
                $url = $page.".php";
                if(file_exists($url)){
                    include $url;
                }else{
                    echo "لا توجد هذه الصفحه !!!";
                }
            }else{
                echo
                "
               <div class='imp'>مرحباً بك فى لوحة التحكم يا </div>
                <br />
              <form action='index.php' method='post'>
                <table align='center' width='100%' cellpadding='2' cellspacing='2'>
                    <tr>
                        <td class='table'>ملاحظات المدير العامة</td>
                    </tr>
                    <tr>
                        <td align='center' class='table3'><textarea name='adminmsg' rows='6' cols='80'>$row->adminmsg</textarea></td>
                    </tr>
                    <tr>
                        <td align='center' class='table2'><input class='buttons' type='submit' value='حفظ الملاحظات' /></td>
                    </tr>
                </table>
                <input type='hidden' name='doo' value='save' />
               </form>
                <br />
                <table align='center' width='100%' cellpadding='0' cellspacing='0'>
                    <tr>
                        <td class='table' colspan='2'>معلومات البرنامج</td>
                    </tr>
                    <tr>
                        <td width='50%' class='table2'>أسم البرنامج  : إدارة المحتوى</td>
                        <td width='50%' class='table3'>المبرمج : أحمد مصطفى</td>
                    </tr>
                    <tr>
                        <td width='50%' class='table3'>الأصدار : 1</td>
                        <td width='50%' class='table2'>الأصدار البى أتش بى : 5</td>
                    </tr>
                </table>

                ";
            }
            ?>
        </td>
    </tr>
</table>


<table align="center" width="100%" cellpadding="0" cellspacing="0">
    <tr>
        <td>
            <div id="footer">جميع الحقوق محفوظه لـ...</div>
        </td>
    </tr>
</table>

</body>
</html>