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
						<td colspan=6 align=center><?php echo $list; ?></td>
					</tr>
					<tr>
						<td colspan=6 align="left">
							<form>
								<span id="addItemLabel">Add Item:</span> <input id="searchkey" type="text" size="50" onkeyup="showResult(this.value)">
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