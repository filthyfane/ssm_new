<?php


#####------------------------------------
##### kik_new_company
#####------------------------------------


function kik_new_company_FUNC($atts, $content = null) {
	// extract params
	$a = shortcode_atts(array(
	), $atts);
	// do stuff
	?>
				
				<?php $kik_ID = 0; ?>
				
				<form name="kik_company" id="post-<?php echo $kik_ID; ?>" <?php post_class(); ?> action="" method="post">
					
					<input type="hidden" id="ID" name="ID" value="<?php echo $kik_ID; ?>" />
					
					<input type="hidden" id="kik_action" name="kik_action" value="add" />
					
					<div class="kik_company_title">
						<div class="kik_company_title_tag">Firmă nouă</div>
						<a class="kik_save_btn add" href="javascript:;"><i class="fa fa-fw fa-save"></i> Adaugă firma</a>
						<div class="kik_save_btn_response"></div>
					</div>
					
					<?php include(KIK_PLUGIN_ABSPATH . 'frontend/post_body.php'); ?>
					
					<div class="kik_company_fields_footer"></div>
					
					<div class="kik_save_area"><a class="kik_save_btn add" href="javascript:;"><i class="fa fa-fw fa-save"></i> Adaugă firma</a><div class="kik_save_btn_response"></div></div>
					
				</form>
				
	<?php
}










/**/

?>