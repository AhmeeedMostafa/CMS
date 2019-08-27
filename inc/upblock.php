<?php
#القائمة العلويه

$up_block = mysql_query("SELECT * FROM `blocks` WHERE b_dir='2' ORDER BY b_order ASC") or die (mysql_error());
$num_up_block = mysql_num_rows($up_block);

if ($num_up_block > 0){
    while ($up_block_row = mysql_fetch_object($up_block)){
        if ($up_block_row->b_active == 1){
            echo
            "<div class='head'>$up_block_row->b_name</div>
            <div class='bodypanel'>$up_block_row->b_content</div>";
        }
    }
}

?>