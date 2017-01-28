<?php
//GET the Batch List Name parameter from URL
$list=$_GET["list"];

$laundryEntryFileName = $list.'.list';
file_put_contents('../lists/'.$laundryEntryFileName, '');
echo "List: '".$laundryEntryFileName."' successfully cleared.";

//Return to previous page
header("Location: ../pages/addbatch/index.php?list=".$list);

?>