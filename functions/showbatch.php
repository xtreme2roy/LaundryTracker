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
				echo "<td valign=\"bottom\"><img src=\"../../images/laundry/".$entry.".JPG\" height=\"180\" width=\"150\" class=\"thumbnail\"></img></td>";
				echo "<td>".strtoupper(str_replace("_", " ", $arrayEntry[0]))."</td>";
				echo "<td>".strtoupper(str_replace("_", " ", $arrayEntry[1]))."</td>";
				echo "<td>".strtoupper(str_replace("_", " ", $arrayEntry[2]))."</td>";
				echo "<td>".strtoupper($arrayEntry[3])."</td>";
				echo "<td><a href=\"../../functions/removeitem.php?item=".trim($entry)."&list=".$list."\"><img src=\"../../images/remove-item.png\" class=\"clickable\"></img></a></td>";
			echo "</tr>";
			$laundryCount++;
		}
	}
	if($laundryCount <= 0){
		echo "<tr align=center><td colspan=\"6\"><b><u>INFO</u>:</b> No item(s) yet for this laundry batch.</td></tr>";
	}
	fclose($laundryEntry);
}
else {
	$dir = new DirectoryIterator(dirname('../../lists/.'));
	foreach ($dir as $fileinfo) {
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
						if (substr_count(strtolower(trim($entry)), 'sock') > 0) {
							$laundryCount+=2;
						}else {
							$laundryCount++;	
						}										
					}
				}
				fclose($laundryEntry);
				
				echo "<tr class=\"rowhighlight\" align=center onclick=\"location.href='../../pages/addbatch/index.php?list=".$fileNameNoExtension."'\">";
					echo "<td>".$batchDetails[1]."</td>";
					echo "<td>".$laundryCount."</td>";
					echo "<td>P0.00</td>";
					echo "<td>Yes</td>";
					echo "<td>No</td>";
				echo "</tr>";
			}
		}
	}
	echo "<br />";
	echo "<tr id=\"addnewbatchbutton\" align=center><td colspan=\"6\"><a href=\"../../pages/addbatch/index.php?list=laundryEntry_current\"><b>Add New Laundry Batch</b></a></tr>";
}
?>