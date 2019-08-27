<?php
session_start();
include "inc/header.php"; ?>

    <td valign="top" width="60%">
        <?php
        // CREATE TABLE  `pages` =page_id,page_name,page_content,page_active,page_count,page_comm_active
#=======================================================================================================#

        $gid = intval($_GET['page_id']);

        $action = htmlspecialchars($_SERVER['PHP_SELF']);
        if (isset($_SERVER['QUERY_STRING'])){
            $action .= "?".htmlspecialchars($_SERVER['QUERY_STRING']);
        }
#=======================================================================================================#

        $date = date("d/m/Y - h : i : s");
        $server_remote = $_SERVER['REMOTE_ADDR'];
        //Table `page_comments` = pc_id,pc_name,pc_mail,pc_ip,pc_text,pc_date,pc_country,page_id
        $pc_name = strip_tags($_POST['pc_name']);
        $pc_mail = trim(strip_tags($_POST['pc_mail']));
        $pc_ip = $_POST['pc_ip'];
        $pc_date = $_POST['pc_date'];
        $pc_text = strip_tags($_POST['pc_text']);
        $pc_country = strip_tags($_POST['pc_country']);
        $page_id = $_POST['page_id'];
        $pc_active = $_POST['pc_active'];
#=======================================================================================================#
if (isset($_POST['add']) && $_POST['add'] == 'comment'){

    if ($_SESSION['commentpage'] > time() - 30){
        include "inc/okhead.php";
        echo "<div class='txt'>لا يمكنك إضافة تعليق الآن من فضلك أنتظر 30 ثانيه</div><meta http-equiv='refresh' content='3'; url=".$_SERVER["PHP_SELF"]."?page_id=".$gid."'/>";
        include "inc/okfoot.php";
        exit();
    }

   if ($_POST['commentpage'] == "" || $_POST['commentpage'] != $_SESSION['commentpage']){
       include "inc/okhead.php";
       echo "<div class='txt'>الرمز الآمنى ( Captcha ) غير صحيح أو لم تقم بكتابته</div>";
       include "inc/okfoot.php";
       exit();
   }
   elseif (empty($pc_name)){
       include "inc/okhead.php";
       echo "<div class='txt'>يجب أن يكون هناك أسم للمعلق</div>";
       include "inc/okfoot.php";
       exit();
   }elseif (empty($pc_text)){
       include "inc/okhead.php";
       echo "<div class='txt'>يجب عليك وضع التعليق</div>";
       include "inc/okfoot.php";
       exit();
   }elseif (empty($pc_mail)){
       include "inc/okhead.php";
       echo "<div class='txt'>يجب عليك وضع أميلك</div>";
       include "inc/okfoot.php";
       exit();
   }elseif (empty($pc_country)){
       include "inc/okhead.php";
       echo "<div class='txt'>من فضلك أدخل دولتك</div>";
       include "inc/okfoot.php";
       exit();
   }elseif (strlen($pc_name) > 30){
       include "inc/okhead.php";
       echo "<div class='txt'>يجب أن يكون أسم المعلق أكثر من 3 حروف و أقل من 30 حرف.</div>";
       include "inc/okfoot.php";
       exit();
   }else{
       $_SESSION['commentpage'] = time();
       $addcomments = mysql_query("INSERT INTO `page_comments` (pc_name,pc_mail,pc_ip,pc_date,pc_text,pc_country,page_id,pc_active) VALUES ('$pc_name','$pc_mail','$pc_ip','$pc_date','$pc_text','$pc_country','$page_id','$pc_active')") or die(mysql_error());
       if (isset($_SERVER['QUERY_STRING'])){
           include "inc/okhead.php";
           echo "<div class='txt'>تم إضافة التعليق بنجاح</div><meta http-equiv='refresh' content='2; url=".$_SERVER["PHP_SELF"]."?page_id=".$gid."' />";
           include "inc/okfoot.php";
           exit();;
      }
   }
}
#=======================================================================================================#
        $showpages = mysql_query("SELECT * FROM `pages` WHERE page_id='$gid'") or die(mysql_error());
        if (isset($showpages) && mysql_num_rows($showpages) >= 1){
            $rowshowpages = mysql_fetch_object($showpages) or die(mysql_error());
        }
        if (!$gid){
            echo "<center style='padding: 20px; color: red; background-color: black; margin: 30px;'><h2>الصفحه المطلوبه غير موجودة</h2></center>";
        }elseif (mysql_num_rows($showpages) < 1){
            echo "<center style='padding: 20px; color: red; background-color: black; margin: 30px;'><h2>الصفحه رقم $gid غير موجودة بالقاعدة</h2></center>";
        }
        if (isset($gid)){
            $addvisitor = mysql_query("UPDATE `pages` SET page_count=page_count+1 WHERE page_id='$gid'") or die(mysql_error());
            if ($rowshowpages->page_active == 1){
                echo "
                <div class='head'>$rowshowpages->page_name</div>
                <div class='bodypanel'>$rowshowpages->page_content</div>";

                ///////////////// loop comments ////////////////////////////////
                $showcomments = mysql_query("SELECT pc_id,pc_name,pc_mail,pc_date,pc_text,pc_active,page_id,pc_country FROM `page_comments` WHERE page_id='$gid' AND pc_active='1' ORDER BY pc_id DESC") or die(mysql_error());

                if (mysql_num_rows($showcomments) > 0){
                    echo
                    "<div class='head'>التعليقات</div>
                    <div class='bodypanel'>
                    <table align='center' width='100%' cellpadding='0' cellspacing='0'>
                    ";
                    while ($rowcomments = mysql_fetch_object($showcomments)){
                        echo "
                        <tr>
                            <td class='tbl2'>كتبت بواسطة $rowcomments->pc_name بتاريخ $rowcomments->pc_date من دولة $rowcomments->pc_country</td>
                        </tr>
                        <tr>
                            <td class='tbl1'>$rowcomments->pc_text</td>
                        </tr>

                        ";
                    }
                    echo "</div>";
                }

                ################### Form ##############################
                if ($rowshowpages->page_comm_active == 1){
                    echo "
                <div class='head'>إضافة تعليق</div>
                <div class='bodypanel'>
                     <form action='$action' method='post'>
                          <table align='center' width='100%' cellpadding='0' cellspacing='0'>
                            <tr>
                                <td class='tbl1' width='20%'> *أسم المعلق</td>
                                <td class='tbl1' width='80%'><input type='text' name='pc_name' /></td>
                            </tr>
                            <tr>
                                <td class='tbl2' width='20%'> *البريد الألكترونى</td>
                                <td class='tbl2' width='80%'><input type='email' name='pc_mail' /></td>
                            </tr>
                            <tr>
                                <td class='tbl1' width='20%'>*الدولة </td>
                                <td class='tbl1' width='80%'><input type='text' name='pc_country' /></td>
                            </tr>
                            <tr>
                                <td class='tbl2' width='20%'>التعليق *</td>
                                <td class='tbl2' width='80%'><textarea name='pc_text' rows='8' cols='48'></textarea></td>
                            </tr>
                            <tr>
                                <td class='tbl1' width='20%'>الرمز الآمنى -Captcha</td>
                                <td class='tbl1'><input width='80%' type='text' name='captcha' /> - Insert Code <img src='inc/captcha.php' alt='captcha' title='أدخل الرمز الذى يوجد بالصوره ' /></td>
                            </tr>
                             <tr>
                                <td class='tbl2' align='center' colspan='2' width='80%'>
                                    <input type='submit' class='buttons' value='إضافة التعليق' />
                                </td>
                            </tr>
                        </table>
                        <input type='hidden' name='pc_ip' value='$server_remote' />
                        <input type='hidden' name='pc_active' value='2' />
                        <input type='hidden' name='page_id' value='$gid' />
                        <input type='hidden' name='pc_date' value='$date' />
                        <input type='hidden' name='add' value='comment' />
                    </form>
                </div>";
                    ################### Form ##############################
                }

            }elseif ($rowshowpages->page_active == 2){
                echo "<center style='padding: 20px; color: red; background-color: black; margin: 30px;'><h2>الصفحة المطلوبه مغلقه للزوار , نعتذر سيتم فتحها قريباً</h2></center>";
            }
        }
        ?>
    </td>
<?php include "inc/footer.php"; ?>