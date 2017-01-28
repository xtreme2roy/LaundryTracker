<?php
//GET the Batch List Name parameter from URL
$list=$_GET["list"];
//GET the item name parameter from URL
$item=$_GET["item"];

$laundryEntryFileName = $list.'.list';
$laundryEntry = file('../lists/'.$laundryEntryFileName);
$entries = array();
foreach($laundryEntry as $entry) {
	if(strtolower(trim($entry)) != strtolower($item)){
		$entries[] = $entry;
	}
}
$laundryEntry = fopen('../lists/'.$laundryEntryFileName, "w+");
flock($laundryEntry, LOCK_EX);
foreach($entries as $entry) {
     fwrite($laundryEntry, $entry);
}
flock($laundryEntry, LOCK_UN);
fclose($laundryEntry);  
echo "Item Successfully Removed from LaundryEntry[".$laundryEntryFileName."]: ".$item;

//Return to previous page
header("Location: ../pages/addbatch/index.php?list=".$list);

?>