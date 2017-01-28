<?php
//GET the Batch List Name parameter from URL
$list=$_GET["list"];

$laundryEntryFileName = $list.'.list';
unlink('../lists/'.$laundryEntryFileName);
echo "List: '".$laundryEntryFileName."' successfully deleted.";

//Return to previous page
header("Location: ../pages/home/");

?>