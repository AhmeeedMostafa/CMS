<?php
# القائمة اليمنى

$right_block = mysql_query("SELECT * FROM `blocks` WHERE b_dir='1' ORDER BY b_order ASC") or die (mysql_error()) ;
$num_right_block = mysql_num_rows($right_block);

if($num_right_block > 0){
    while ($right_block_row = mysql_fetch_object($right_block)){
        if ($right_block_row->b_active == 1){
            echo
            "<div class='head'>$right_block_row->b_name</div>
       <div class='bodypanel'>stripslashes($right_block_row->b_content)</div>";
        }
    }
}


?>