<?php		
    //Import Functions/Libraries
	require_once('../../functions/getInfo.php');		
	require_once('../../functions/setVariables.php');
?>
<div style="clear:both">
</div>
<br/>
	<center>
	<h3>
		<strong>
			<big>
				<u>SVN Build Change Report</u>: <?php echo getReportInfo("BUILD_NAME"); ?>
			</big>
		</strong>
		<br>
	</h3>
	<p>
			<table border=1 bordercolor='#0078c9' cellpadding=1 cellspacing=0 width='95%' align=center>
				<tbody>
					<tr bgcolor='#c0c0c0'> 
						<td align='center' colspan=7>
							<b><?php echo preg_replace('/[.,]/', '', getBuildInfo(getReportInfo("BUILD_1"),"PATCH_NAME")); ?></b>
						</td>					
					</tr>
					<tr bgcolor='#c0c0c0'> 
						<td align='left'>
							<b>BASH Ticket:</b>
						</td>
						<td align='left' colspan=6>
							<a href="<?php echo $JIRA_URL."/browse/".getBuildInfo(getReportInfo("BUILD_1"),"BASH_ID"); ?>">
								<?php echo getBuildInfo(getReportInfo("BUILD_1"),"BASH_ID"); ?>
							</a>
						</td>					
					</tr>
					<tr bgcolor='#c0c0c0'> 
						<td align='left'>
							<b>Build URL:</b>
						</td>
						<td align='left' colspan=6>
							<a href="<?php echo getBuildInfo(getReportInfo("BUILD_1"),"BUILD_URL"); ?>">
								<?php echo getBuildInfo(getReportInfo("BUILD_1"),"BUILD_URL"); ?>
							</a>
						</td>				
					</tr>				
					
					<?php 
					//If the build file list is not empty, enumerate all the files
					if ((int)getBuildInfo(getReportInfo("BUILD_1"),"FILE_COUNT") != 0){
					?>
					
						<tr bgcolor='#c0c0c0'> 
							<td align='center' colspan=7>
								<b>List of Files included on this Patch</b>
							</td>
						</tr>		
						<tr bgcolor='#c0c0c0'> 
							<td align='center' width="9%">
								<b>No.</b>
							</td>
							<td align='center' width="9%">
								<b>JIRA ID</b>
							</td>
							<td align='center'>
								<b>Revision No.</b>
							</td>
							<td align='center'>
								<b>Filepath</b>
							</td>
							<td align='center'>
								<b>Status</b>
							</td>
							<td align='center'>
								<b>Log</b>
							</td>
							<td align='center'>
								<b>Blame/Annotate</b>
							</td>
						</tr>
						
					<?php
					    //Enumerate the files on each file list through a loop
						for ($count = 1; $count <= (int)getBuildInfo(getReportInfo("BUILD_1"),"FILE_COUNT"); $count++) {
					?>
							
						<tr bgcolor='#c0c0c0'> 
							<td align='center'>
								<?php echo $count; ?>
							</td>
							<td align='center'>
								<a href="<?php echo $JIRA_URL."/browse/".getFileInfo($count,getReportInfo("BUILD_1"),"JIRA_ID"); ?>">
									<?php echo getFileInfo($count,getReportInfo("BUILD_1"),"JIRA_ID"); ?>
								</a>
							</td>
							<td align='center'>
								<?php echo getFileInfo($count,getReportInfo("BUILD_1"),"REV_NUM"); ?>
							</td>
							<td align='left'>
								<font size="1.5">
									<?php echo getFileInfo($count,getReportInfo("BUILD_1"),"FILE_PATH"); ?>
								</font>
							</td>
							<td align='center'>
								<?php echo getFileInfo($count,getReportInfo("BUILD_1"),"STATUS"); ?>
							</td>
							
							<?php 
								//If file is NON-BINARY, provide links(image) of their respective SVN logs and annotation(blame)
								if (strpos(getFileInfo($count,getReportInfo("BUILD_1"),"TYPE"),"NON-BINARY") !== false) { 
							?>
									<td align='center'>
										<a href="<?php echo $WEBSVN_LOG_URL; ?>?repname=cte&path=/Code/trunk/Outtask/<?php echo getFileInfo($count,getReportInfo("BUILD_1"),"FILE_PATH"); ?>&rev=<?php echo getFileInfo($count,getReportInfo("BUILD_1"),"REV_NUM"); ?>">
											<img src="http://groupdocs.com/email/feb/Comparison_icon.png" alt="Go to WebSVN to view Log Info" border="1" align="center" />
										</a>
									</td>								
									<td align='center'>
										<a href="<?php echo $WEBSVN_BLAME_URL; ?>?repname=cte&path=/Code/trunk/Outtask/<?php echo getFileInfo($count,getReportInfo("BUILD_1"),"FILE_PATH"); ?>&rev=<?php echo getFileInfo($count,getReportInfo("BUILD_1"),"REV_NUM"); ?>">
											<img src="http://groupdocs.com/email/feb/Annotation_icon.png" alt="Go to WebSVN to view Blame/Annotation Info" border="1" align="center" />
										</a>
									</td>	
									
							<?php } else { ?>
							
								<td align='center' colspan=2>
									<i>File marked as binary</i>
								</td>
							<?php } ?>
							
						</tr>
							
						<?php } ?>
					
						<tr bgcolor='#c0c0c0'> 
							<td align='left' colspan=7>
								Total Number of Files: <b><?php echo getBuildInfo(getReportInfo("BUILD_1"),"FILE_COUNT"); ?></b>
							</td>
						</tr>
					<?php } else { ?>
						<tr bgcolor='#c0c0c0'>
							<td align='center' colspan=7>
								<b>Message:</b> No files included in this patch.
							</td>
						</tr>
					<?php } ?>						
				</tbody>
			</table>
		</p>		

		<?php //Repeat same procedure for the second build ?>
		
		<p>
			<table border=1 bordercolor='#0078c9' cellpadding=1 cellspacing=0 width='95%' align=center>
				<tbody>
					<tr bgcolor='#c0c0c0'> 
						<td align='center' colspan=7>
							<b><?php echo preg_replace('/[.,]/', '', getBuildInfo(getReportInfo("BUILD_2"),"PATCH_NAME")); ?></b>
						</td>					
					</tr>
					<tr bgcolor='#c0c0c0'> 
						<td align='left'>
							<b>BASH Ticket:</b>
						</td>
						<td align='left' colspan=6>
							<a href="<?php echo $JIRA_URL."/browse/".getBuildInfo(getReportInfo("BUILD_2"),"BASH_ID"); ?>">
								<?php echo getBuildInfo(getReportInfo("BUILD_2"),"BASH_ID"); ?>
							</a>
						</td>					
					</tr>
					<tr bgcolor='#c0c0c0'> 
						<td align='left'>
							<b>Build URL:</b>
						</td>
						<td align='left' colspan=6>
							<a href="<?php echo getBuildInfo(getReportInfo("BUILD_2"),"BUILD_URL"); ?>">
								<?php echo getBuildInfo(getReportInfo("BUILD_2"),"BUILD_URL"); ?>
							</a>
						</td>				
					</tr>				
					
					<?php 
					//If the build file list is not empty, enumerate all the files
					if ((int)getBuildInfo(getReportInfo("BUILD_2"),"FILE_COUNT") != 0){
					?>
					
						<tr bgcolor='#c0c0c0'> 
							<td align='center' colspan=7>
								<b>List of Files included on this Patch</b>
							</td>
						</tr>		
						<tr bgcolor='#c0c0c0'> 
							<td align='center' width="9%">
								<b>No.</b>
							</td>
							<td align='center' width="9%">
								<b>JIRA ID</b>
							</td>
							<td align='center'>
								<b>Revision No.</b>
							</td>
							<td align='center'>
								<b>Filepath</b>
							</td>
							<td align='center'>
								<b>Status</b>
							</td>
							<td align='center'>
								<b>Log</b>
							</td>
							<td align='center'>
								<b>Blame/Annotate</b>
							</td>
						</tr>
						
					<?php
					    //Enumerate the files on each file list through a loop
						for ($count = 1; $count <= (int)getBuildInfo(getReportInfo("BUILD_2"),"FILE_COUNT"); $count++) {
					?>
							
						<tr bgcolor='#c0c0c0'> 
							<td align='center'>
								<?php echo $count; ?>
							</td>
							<td align='center'>
								<a href="<?php echo $JIRA_URL."/browse/".getFileInfo($count,getReportInfo("BUILD_2"),"JIRA_ID"); ?>">
									<?php echo getFileInfo($count,getReportInfo("BUILD_2"),"JIRA_ID"); ?>
								</a>
							</td>
							<td align='center'>
								<?php echo getFileInfo($count,getReportInfo("BUILD_2"),"REV_NUM"); ?>
							</td>
							<td align='left'>
								<font size="1.5">
									<?php echo getFileInfo($count,getReportInfo("BUILD_2"),"FILE_PATH"); ?>
								</font>
							</td>
							<td align='center'>
								<?php echo getFileInfo($count,getReportInfo("BUILD_2"),"STATUS"); ?>
							</td>
							
							<?php 
								//If file is NON-BINARY, provide links(image) of their respective SVN logs and annotation(blame)
								if (strpos(getFileInfo($count,getReportInfo("BUILD_2"),"TYPE"),"NON-BINARY") !== false) { 
							?>
									<td align='center'>
										<a href="<?php echo $WEBSVN_LOG_URL; ?>?repname=cte&path=/Code/trunk/Outtask/<?php echo getFileInfo($count,getReportInfo("BUILD_2"),"FILE_PATH"); ?>&rev=<?php echo getFileInfo($count,getReportInfo("BUILD_2"),"REV_NUM"); ?>">
											<img src="http://groupdocs.com/email/feb/Comparison_icon.png" alt="Go to WebSVN to view Log Info" border="1" align="center" />
										</a>
									</td>								
									<td align='center'>
										<a href="<?php echo $WEBSVN_BLAME_URL; ?>?repname=cte&path=/Code/trunk/Outtask/<?php echo getFileInfo($count,getReportInfo("BUILD_2"),"FILE_PATH"); ?>&rev=<?php echo getFileInfo($count,getReportInfo("BUILD_2"),"REV_NUM"); ?>">
											<img src="http://groupdocs.com/email/feb/Annotation_icon.png" alt="Go to WebSVN to view Blame/Annotation Info" border="1" align="center" />
										</a>
									</td>	
									
							<?php } else { ?>
							
								<td align='center' colspan=2>
									<i>File marked as binary</i>
								</td>
							<?php } ?>
							
						</tr>
							
						<?php } ?>
					
						<tr bgcolor='#c0c0c0'> 
							<td align='left' colspan=7>
								Total Number of Files: <b><?php echo getBuildInfo(getReportInfo("BUILD_2"),"FILE_COUNT"); ?></b>
							</td>
						</tr>
					<?php } else { ?>
						<tr bgcolor='#c0c0c0'>
							<td align='center' colspan=7>
								<b>Message:</b> No files included in this patch.
							</td>
						</tr>
					<?php } ?>						
				</tbody>
			</table>
		</p>
		
		<?php
		//Check if both build file list have contents so diff can be executed
		if (((int)getBuildInfo(getReportInfo("BUILD_1"),"FILE_COUNT") != 0) && ((int)getBuildInfo(getReportInfo("BUILD_2"),"FILE_COUNT") != 0)){
		?>
		<p>
			<table border=1 bordercolor='#0078c9' cellpadding=1 cellspacing=0 width='95%' align=center>
				<tbody>
					<tr bgcolor='#c0c0c0'> 
						<td align='center' colspan=7>
							<u>Filelist Comparison(side-by-side)</u>: <b> <?php echo str_replace("OuttaskPatch_Release_release_", "",preg_replace('/[.,]/', '', getBuildInfo(getReportInfo("BUILD_1"),"PATCH_NAME"))); ?> </b> against <b> <?php echo str_replace("OuttaskPatch_Release_release_","",preg_replace('/[.,]/', '', getBuildInfo(getReportInfo("BUILD_2"),"PATCH_NAME"))); ?> </b>
						</td>					
					</tr>		
					<tr bgcolor='#c0c0c0'> 
						<td align='center' colspan=7>
							<div id='outerdiv' style="width:1200px; overflow-x:hidden;">
								<font size="4">
									<iframe src="../../functions/<?php echo "Filelist-Compare_".getReportInfo("BUILD_1")."_against_".getReportInfo("BUILD_2").".html"; ?>" width="1200" height="400" frameborder="0" id='inneriframe' scrolling=yes> </iframe>
								</font>
							</div>
						</td>
					</tr>
					<?php 
						//If there are common files on both builds, display total number of files in common.
						if ((int)getDiffCommonInfo(getReportInfo("BUILD_1"),getReportInfo("BUILD_2"),"FILE_COUNT") != 0){
					?>		
						<tr bgcolor='#c0c0c0'> 
							<td align='left' colspan=7>
								Total Number of Files in Common:<b> <?php echo getDiffCommonInfo(getReportInfo("BUILD_1"),getReportInfo("BUILD_2"),"FILE_COUNT"); ?></b>
							</td>
						</tr>
					<?php } else { ?>
						<tr bgcolor='#c0c0c0'>
							<td align='left' colspan=3>
								<b>Message:</b> No files in common for this patch.
							</td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
		</p>
		<?php }?>
	</center>
<br/>	
