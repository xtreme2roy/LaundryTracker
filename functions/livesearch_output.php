<?php
//GET the Batch List Name parameter from URL
$list=$_GET["list"];
//GET the key parameter from URL
$key=$_GET["key"];
//If key input is not empty, search key on the Laundry Image Database
if (strlen($key)>0) {
	$hint="";
	$dir = new DirectoryIterator(dirname('../images/laundry/.'));
	foreach ($dir as $fileinfo) {
		if (!$fileinfo->isDot()) {
			$fileNameNoExtension = preg_replace("/\.[^.]+$/", "", $fileinfo->getFilename());
			if (substr_count(strtolower($fileNameNoExtension), strtolower($key)) > 0) {
				$hint .= "<div>";
					$hint .= "<a href=\"../../functions/additem.php?item=".$fileNameNoExtension."&list=".$list."\">";
						$hint .= "<img src=\"../../images/laundry/".$fileinfo->getFilename()."\" height=\"100\" width=\"70\" border=\"1\" class=\"left laundryImageSearch\">&nbsp;</img>";														
						$hint .= "<br /><br /><p style=\"float:left;\"> ".$fileNameNoExtension."</p><br /><br /><br /><br /><br />";
					$hint .= "</a>";				
				$hint .= "</div>";
			}
		}
	}
}
//Create response based on search key, otherwise, return default response
if ($hint=="") {
  $response="Item not found in laundry database";
} else {
  $response=$hint;
}
//Return response
echo $response;
?>