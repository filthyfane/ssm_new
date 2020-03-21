<?php


#####------------------------------------
##### kik_companies
#####------------------------------------

function kik_companies_FUNC($atts, $content = null) 
{ 
	ob_start(); ?>
	
	<form name="kik_all_companies" action="" method="post">
		<div class="row">
			<div class="col-sm-12">
				<h2>Centralizator firme
			</div>
			<div class="col-sm-12">
				<h3>Listă firme</h3>
				<hr>
			</div>
		</div>
		
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-12">
					<table class="table table-bordered table-hover" id="kik_all_companies" style="width: 100%">
						<thead class="thead-dark">
							<tr>
								<th>Firmă</th>
								<th>Instructaj</th>
								<th>Contact</th>
								<th>Inspector / Agent de vânzări</th>
								<th>Status</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</form>
	
	<div class="kik_company_fields_footer"></div><?php

	return ob_get_clean();
}
?>