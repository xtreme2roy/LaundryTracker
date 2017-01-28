<?php
//GET the Batch List Name parameter from URL
$list=$_GET["list"];

$laundryEntryFileName = $list.'.list';

//Rename current file setting status for 'claimed' to 'y'
//Sample Filename of Delivered Batch: laundryEntry_2017-01-28_0.00_y_y_00-00-am.list
$batchDetails = explode('_', $list);
$isClaimed = (strtolower($batchDetails[4]) == 'y') ? 'n': 'y';
$updatedFileName = 'laundryEntry_'.$batchDetails[1].'_'.$batchDetails[2].'_y_'.$isClaimed.'_'.$batchDetails[5];
rename('../lists/'.$laundryEntryFileName, '../lists/'.$updatedFileName.'.list');
echo "Laundry Batch List: '".$laundryEntryFileName."' successfully claimed.";

//Return to previous page
header("Location: ../pages/addbatch/index.php?list=".$updatedFileName);

?>