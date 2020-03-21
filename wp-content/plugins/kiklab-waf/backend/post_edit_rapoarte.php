

	<div class="row no-margin">
		<div class="col-sm-12">
			<h3 class="tab-title"><i>Rapoarte</i></h3>
		</div>
	</div>							

	<table class="table table-bordered table-hover" id='rapoarte-table' width=100%>
		<thead class='thead-dark'>
			<tr>
				<th>Tip raport</th>
				<th>Data creării</th>
				<th>Creat de</th>
				<th>Download</th>
			</tr>
		</thead>
		<tbody><?php 
			if (count($kik_reports) > 0) {
				foreach($kik_reports as $report) { 
				
					$reportData   = unserialize($report);
					$createDate   = DateTime::createFromFormat('U', $reportData['createDate']);
					$reportAuthor = get_user_by('id', $reportData['userId']);
					$aUploadDir   = wp_upload_dir();
					$pdfSource    = esc_url($aUploadDir['baseurl']."/reports/".$reportData['fileName'].".pdf");?>
					<tr>
						<td><?php echo $reportData['reportType']; ?></td>
						<td><?php echo $createDate->format('d/m/Y'); ?></td>
						<td><?php echo $reportAuthor->first_name.' '.$reportAuthor->last_name; ?></td>
						<td>
							<a class="pdf-anchor" href="<?php echo $pdfSource; ?>" target="_blank">
								<img class="pdf-img" src="<?php echo KIK_PLUGIN_URLPATH.'img/pdf.png' ?>" >
								<span class="pdf-link">Descarcă</span>
							</a>
						</td>
					</tr><?php 
				}
			} ?>
		</tbody>		
	</table>
