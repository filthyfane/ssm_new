					
					<div class="kik_company_fields_title">Documente predate (<?php echo count(wp_get_post_terms($post->ID, 'kik_documente_predate')); ?>)</div>
					
					<table class="kik_company_fields table_type_main">
						
						<!-- Documente predate -->
						
						<!-- Labels -->
						<tr>
							<th style="width:25px;" class="align-right">
								&nbsp;
							</th>
							<th style="width:100%;" class="align-left">
								Document
							</th>
						</tr>
						
						<!-- Existing rows -->
						<?php
							foreach(get_terms('kik_documente_predate', array('hide_empty' => 0)) as $doc) {
						?>
						<tr>
							<td colspan="4">
								<table class="table_type_row">
									<tr>
										<td style="width:25px;">
											<div class="box_H_margin">
												<input type="checkbox" id="<?php echo 'kik_company_documente_predate_' . $doc->slug; ?>" name="<?php echo 'kik_company_documente_predate_' . $doc->slug; ?>" value="<?php echo $doc->slug; ?>" <?php if (has_term($doc->slug, 'kik_documente_predate', $post->ID)) echo ' checked="checked"'; ?> />
											</div>
										</td>
										<td style="width:100%">
											<div class="box_H_margin">
												<label for="<?php echo 'kik_company_documente_predate_' . $doc->slug; ?>"><?php echo $doc->name; ?></label>
											</div>
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<?
							}
						?>
						
					</table>
					