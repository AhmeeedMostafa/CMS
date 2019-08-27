<?php
#القائمة اليسرى

$left_block = mysql_query("SELECT * FROM `blocks` WHERE b_dir='4' ORDER BY b_order ASC") or die(mysql_error());
$num_left_block = mysql_num_rows($left_block);

if ($num_left_block > 0){
    while ($left_block_row = mysql_fetch_object($left_block)){
        if($left_block_row->b_active == 1){
            echo
            "<div class='head'>$left_block_row->b_name</div>
            <div class='bodypanel'>stripslasehs($left_block_row->b_content)</div>";
        }
    }
}

?>