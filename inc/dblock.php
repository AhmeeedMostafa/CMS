<?php
#القائمة السفلى

$down_block = mysql_query("SELECT * FROM `blocks` WHERE b_dir='3' ORDER BY b_order ASC") or die(mysql_error());
$num_down_block = mysql_num_rows($down_block);

if($num_down_block > 0){
    while ($down_block_row = mysql_fetch_object($down_block)){
        if ($down_block_row->b_active == 1){
            echo
            "<div class='head'>$down_block_row->b_name</div>
            <div class='bodypanel'>stripslashes($down_block_row->b_content)</div>";
        }
    }
}

?>