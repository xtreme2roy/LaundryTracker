<?php

if($list != "all"){
	$laundryEntryFileName = $list.'.list';
	$laundryEntry = fopen('../../lists/'.$laundryEntryFileName, 'r') or die("Can't read file $laundryEntryFileName");
	$laundryCount = 0;
	while(!feof($laundryEntry)){
		$entry = fgets($laundryEntry);
		if(trim($entry) != ''){
			$arrayEntry = explode('-', $entry);
			echo "<tr align=center class=\"rowhighlight\">";
				echo "<td valign=\"bottom\"><img src=\"../../images/laundryImageDatabase/".$entry.".JPG\" height=\"180\" width=\"150\" class=\"laundryImage roundCornerLaundryImage\"></img></td>";
				echo "<td>".strtoupper(str_replace("_", " ", $arrayEntry[0]))."</td>";
				echo "<td>".strtoupper(str_replace("_", " ", $arrayEntry[1]))."</td>";
				echo "<td>".strtoupper(str_replace("_", " ", $arrayEntry[2]))."</td>";
				echo "<td>".strtoupper($arrayEntry[3])."</td>";
				echo "<td><a href=\"../../functions/removeitem.php?item=".trim($entry)."&list=".$list."\"><img src=\"../../images/remove-item.png\" width=25 height=25 class=\"removeButton\"></img></a></td>";
			echo "</tr>";
			$laundryCount++;
		}
	}
	if($laundryCount <= 0){
		echo "<tr align=center><td colspan=\"6\"><b><u>INFO</u>:</b> No item(s) yet for this laundry batch.</td></tr>";
	}
	fclose($laundryEntry);
	
	echo "<br />";
	echo "<tr align=center><td colspan=\"6\"> &nbsp; </tr>";
	echo "<tr align=center><td colspan=\"6\">";
	echo "<a class=\"appButton\" href=\"../../pages/home/\"><b>Back</b></a>";
	echo "&nbsp;";
	echo "<a class=\"appButton\" href=\"../../functions/clearbatch.php?list=".$list."\"><b>Clear List</b></a>";
		
	if (strpos($list,'current') !== false) {				
		echo "&nbsp;";
		echo "<a class=\"appButton\" href=\"../../functions/savebatch.php?list=".$list."\"><b>Save Batch</b></a>";				
	}
	else{
	
		$batchDetails = explode('_', $list);
		$isDelivered = (strtolower($batchDetails[3]) == 'y') ? 'Undelivered': 'Delivered';
		$isClaimed = (strtolower($batchDetails[4]) == 'y') ? 'Unclaimed': 'Claimed';
		echo "&nbsp;";
		echo "<a class=\"appButton\" href=\"../../functions/deliverbatch.php?list=".$list."\"><b>Set as '".$isDelivered."'</b></a>";
		echo "&nbsp;";
		echo "<a class=\"appButton\" href=\"../../functions/claimbatch.php?list=".$list."\"><b>Set as '".$isClaimed."'</b></a>";	
		echo "&nbsp;";
		echo "<a class=\"appButton\" href=\"../../functions/deletebatch.php?list=".$list."\"><b>Delete Batch</b></a>";		
	}
	
	
	
	echo "</tr>";
	echo "<tr align=center><td colspan=\"6\"> &nbsp; </tr>";
}
else {
	$sorted_keys = array();
	$dir_iterator  = new DirectoryIterator(dirname('../../lists/.'));
	
	foreach ( $dir_iterator as $fileinfo )
	{
		$sorted_keys[$fileinfo->getMTime()] = $fileinfo->key();
	}
	
	rsort($sorted_keys);
	
	foreach ( $sorted_keys as $key ) {
	
	$dir_iterator->seek($key);
    $fileinfo = $dir_iterator->current();
	
		if (!$fileinfo->isDot()) {
			$fileNameNoExtension = preg_replace("/\.[^.]+$/", "", $fileinfo->getFilename());
			$batchDetails = explode('_', $fileNameNoExtension);
			if($batchDetails[1] != "current"){
				
				//Count Laundry Pieces on selected Laundry List
				$laundryEntry = fopen('../../lists/'.$fileinfo->getFilename(), 'c+') or die("Can't read file: ".$fileinfo->getFilename());
				$laundryCount = 0;
				while(!feof($laundryEntry)){
					$entry = fgets($laundryEntry);
					if(trim($entry) != ''){
						if ((substr_count(strtolower(trim($entry)), 'sock') > 0) || (substr_count(strtolower(trim($entry)), 'glove') > 0) || (substr_count(strtolower(trim($entry)), 'armsleeves') > 0)) {
							$laundryCount+=2;
						}else {
							$laundryCount++;	
						}										
					}
				}
				fclose($laundryEntry);
				
				$isDelivered = (strtolower($batchDetails[3]) == 'y') ? '<font color="#00FF00">Yes</font>': '<font color="red">No</font>';
				$isClaimed = (strtolower($batchDetails[4]) == 'y') ? '<font color="#00FF00">Yes</font>': '<font color="red">No</font>';
				$deliveryTime = explode('-', $batchDetails[5]);
				
				echo "<tr class=\"rowhighlight\" align=center onclick=\"location.href='../../pages/addbatch/index.php?list=".$fileNameNoExtension."'\">";
					echo "<td>".$batchDetails[1]."</td>";
					echo "<td>".$deliveryTime[0].":".$deliveryTime[1]." ".strtoupper($deliveryTime[2])."</td>";
					echo "<td>".$laundryCount."</td>";
					echo "<td>".$batchDetails[6]." kg</td>";
					echo "<td>P ".$batchDetails[2]."</td>";
					echo "<td>".$isDelivered."</td>";
					echo "<td>".$isClaimed."</td>";
				echo "</tr>";
			}
		}
	}
	echo "<br />";
	echo "<tr align=center><td colspan=\"7\"> &nbsp; </tr>";
	echo "<tr align=center><td colspan=\"7\"><a class=\"appButton\"href=\"../../pages/addbatch/index.php?list=laundryEntry_current\"><b>Add New Laundry Batch</b></a></tr>";
	echo "<tr align=center><td colspan=\"7\"> &nbsp; </tr>";
}
?>