<?php
//GET the Batch List Name parameter from URL
$list=$_GET["list"];

$laundryEntryFileName = $list.'.list';

//Rename current file setting status for 'claimed' to 'y'
//Sample Filename of Delivered Batch: laundryEntry_2017-01-28_0.00_y_y_00-00-am_0.0.list
$batchDetails = explode('_', $list);
$isDelivered = (strtolower($batchDetails[3]) == 'y') ? 'n': 'y';
$updatedFileName = 'laundryEntry_'.$batchDetails[1].'_'.$batchDetails[2].'_'.$isDelivered.'_n_'.$batchDetails[5].'_'.$batchDetails[6];
rename('../lists/'.$laundryEntryFileName, '../lists/'.$updatedFileName.'.list');
echo "Laundry Batch List: '".$updatedFileName."' successfully delivered.";

//Return to previous page
header("Location: ../pages/addbatch/index.php?list=".$updatedFileName);

?>