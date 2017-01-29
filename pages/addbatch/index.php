<?php require_once('../../design/header.php')?>

	<div id="container2">
	
		<div id="content">
			
			<?php
			//GET the Batch List Name parameter from URL
			$list = isset($_GET['list']) ? $_GET['list'] : 'laundryEntry_current';
			require_once('../../functions/livesearch_input.php');
			?>
			
				<body>
					<table align="center" style="width:90%;">
					<tr>
						<td colspan=6 align=center>
							<?php 
								//Count Laundry Pieces on currently selected Laundry List
								$laundryEntry = fopen('../../lists/'.$list.'.list', 'c+') or die("'Can't read file: ".$list.".list");
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
															
								$batchDetails = explode('_', $list);															
															
								if($batchDetails[1] != "current"){																	
								
									$isDelivered = (strtolower($batchDetails[3]) == 'y') ? '<font color="#00FF00">Yes</font>': '<font color="red">No</font>';
									$isClaimed = (strtolower($batchDetails[4]) == 'y') ? '<font color="#00FF00">Yes</font>': '<font color="red">No</font>';
									$deliveryTime = explode('-', $batchDetails[5]);
									
									echo "<b>Date:</b> ".$batchDetails[1]." | <b>Time:</b> ".$deliveryTime[0].":".$deliveryTime[1]." ".strtoupper($deliveryTime[2])." | Count: <b>".$laundryCount."</b> | Weight: <b>".$batchDetails[6]." kg </b> | Delivered: ".$isDelivered." | Claimed: ".$isClaimed;
									
								}
								else{
									$defaultStatus = '<font color="red">No</font>';
									date_default_timezone_set('Asia/Manila');
									$deliveredFileName = 'laundryEntry_'.date('Y-m-d').'_0.00_y_n_'.date('h-i-a');
									echo "<b>Date:</b> ".date('Y-m-d')." | <b>Time:</b> ".date('h:i A')." | Count: <b>".$laundryCount."</b> | Weight: <b>0.0 kg</b> | Delivered: ".$defaultStatus." | Claimed: ".$defaultStatus;
								}
							?>
						</td>
					</tr>
					<tr>
						<td colspan=6 align="left">
							<form>
								<span id="addItemLabel"><b><u>Add Item</u></b>:</span> <input id="searchkey" type="text" size="50" onkeyup="showResult(this.value)">
								<div id="livesearch"></div>
							</form>				
						</td>
					</tr>					
					</table>
					
					<table id="laundryDetailsTable" class="nogap" align="center" style="width:90%;">
					<thead>
						<th>Image</th>
						<th>Type</th>
						<th>Color</th>
						<th>Description/Brand</th>
						<th>Owner</th>
						<th>Remove?</th>
					</thead> 
					<?php require_once('../../functions/showbatch.php');?>
					</table>
					<br>
				</body>

		</div>

	</div>
	
<?php require_once('../../design/footer.php')?>