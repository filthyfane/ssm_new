<div class="row no-margin">
		<div class="col-sm-12">
			<h3 class="tab-title"><i>Documente predate (<?php echo count(wp_get_post_terms($post->ID, 'kik_documente_predate')); ?>)</i></h3>
		</div>
	</div>		

	<div class="row no-margin"><?php 
		foreach(get_terms('kik_documente_predate', array('hide_empty' => 0)) as $doc) { ?>
			<div class="col-sm-12 col-md-4">
				<div class="checkbox">
						<label class='checkbox-label' for="<?php echo 'kik_company_documente_predate_' . $doc->slug; ?>">
							<input 	type="checkbox" 
										id="<?php echo 'kik_company_documente_predate_' . $doc->slug; ?>" 
										name="<?php echo 'kik_company_documente_predate_' . $doc->slug; ?>" 
										value="<?php echo $doc->slug; ?>" 
										<?php if (has_term($doc->slug, 'kik_documente_predate', $post->ID)) echo ' checked="checked" disabled'; ?> />
							<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
							<?php echo $doc->name; ?>
						</label>
				</div>
			</div><?php 
		} ?>
	</div>