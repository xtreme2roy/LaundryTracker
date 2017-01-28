			<div style="clear:both">
			</div> 
			<div id="footer">
				<p>
					<b>Toutie Laundry Tracker</b> </br>
					&copy; 2017 All Rights Reserved.
				</p>
				<p>The time is&nbsp
					<?php
					date_default_timezone_set('Asia/Manila');				
					echo "<b>";
					echo date('h:i A');
					echo " PHT</b>";
					?>
					&nbsp;and the date is&nbsp;
					<?php
					echo "<b>";				
					echo date('F j, Y');
					echo "</b>";
					?>
				</p>
			</div>
		<div id="container2"></div>
	</div>
</body>
</html>
