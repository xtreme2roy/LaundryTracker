<?php
//GET the Batch List Name parameter from URL
$list=$_GET["list"];

$laundryEntryFileName = $list.'.list';

//Rename current file to new (delivered) file based on current date/time
//Sample Filename of Delivered Batch: laundryEntry_2017-01-28_0.00_y_n_00-00-am_0.0.list
date_default_timezone_set('Asia/Manila');
//Set default values Delivered: 'n' and Claimed: 'n'
$deliveredFileName = 'laundryEntry_'.date('Y-m-d').'_0.00_n_n_'.date('h-i-a').'_0.0';
rename('../lists/'.$laundryEntryFileName, '../lists/'.$deliveredFileName.'.list');

file_put_contents('../lists/'.$laundryEntryFileName, '');
echo "Laundry Batch List: '".$deliveredFileName."' successfully saved.";

//Return to previous page
header("Location: ../pages/addbatch/index.php?list=".$deliveredFileName);

?>