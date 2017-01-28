<?php
//GET the Batch List Name parameter from URL
$list=$_GET["list"];
//GET the item name parameter from URL
$item=$_GET["item"];

$laundryEntryFileName = $list.'.list';
$laundryEntry = fopen('../lists/'.$laundryEntryFileName, 'a') or die("Can't append to file");
fwrite($laundryEntry, $item."\n");
fclose($laundryEntry);
echo "Item Successfully Added to LaundryEntry[".$laundryEntryFileName."]: ".$item;

//Return to previous page
header("Location: ../pages/addbatch/index.php?list=".$list);
?>