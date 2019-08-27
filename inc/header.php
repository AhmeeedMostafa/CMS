<?php include "inc/function.php"; ?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
    <link type="text/css" rel="stylesheet" href="styles/styles.css" />
    <link type="text/css" rel="stylesheet" href="styles/panels.css" />
    <title><?php echo $sname; ?></title>
    <meta name="description" content="<?php echo $sdesc; ?>" />
    <meta name="keywords" content="<?php echo $stags; ?>" />
</head>
<body>

<div id="home">
    <table align="center" cellpadding="0" cellspacing="0" width="100%">
        <tr>
            <td>
                <div id="header">أحمد مصطفى</div>
                <div id="navbar">
                    <ul>
                        <li><a href="#" title="الرئيسية">الرئيسية</a></li>
                        <li><a href="#" title="الرئيسية">الرئيسية</a></li>
                        <li><a href="#" title="الرئيسية">الرئيسية</a></li>
                        <li><a href="#" title="الرئيسية">الرئيسية</a></li>
                        <li><a href="#" title="الرئيسية">الرئيسية</a></li>
                        <li><a href="#" title="الرئيسية">الرئيسية</a></li>
                    </ul>
                </div>
            </td>
        </tr>
    </table>
<?php if($shturn == 1){ ?>
    <table align="center" cellpadding="0" cellspacing="0" width="100%">
        <tr>
            <td>
                <?php echo $sht; ?>
            </td>
        </tr>
    </table>
<?php } ?>

    <!-- body panels -->
        <table align="center" cellpadding="3" cellspacing="2" width="100%">
            <tr>
                <td valign="top" width="20%">
                    <?php include "rblock.php"; ?>
                </td>