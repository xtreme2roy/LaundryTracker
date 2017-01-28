<?php require_once('../../design/header.php')?>

	<div id="container2">
	
		<div id="content">
		
			<body>
					
				<table id="laundryBatchTable" class="nogap laundryBatchTable" align="center" style="width:90%;">
				<thead>
					<th>Batch Date</th>
					<th>Time Delivered</th>
					<th>No. of Pieces</th>
					<th>Amount</th>							
					<th>Delivered[Yes/No]</th>
					<th>Claimed[Yes/No]</th>
				</thead> 
				<?php $list = "all";?>
				<?php require_once('../../functions/showbatch.php');?>
				</table>
				<br>

			</body>
			
		</div>

	</div>
	
<?php require_once('../../design/footer.php')?>