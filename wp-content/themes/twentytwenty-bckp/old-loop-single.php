<?php
/**
 * The loop that displays a single post
 *
 * The loop displays the posts and the post content. See
 * http://codex.wordpress.org/The_Loop to understand it and
 * http://codex.wordpress.org/Template_Tags to understand
 * the tags used in it.
 *
 * This can be overridden in child themes with loop-single.php.
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.2
 */
?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
			
			<?php if (get_post_type(get_the_ID())) { ?>
					
				<?php $kik_ID = get_the_ID(); ?>
				
				<form class="form-horizontal" name="kik_company" id="post-<?php echo $kik_ID; ?>" <?php post_class(); ?> action="" method="post">
					
					<input type="hidden" id="ID" name="ID" value="<?php echo $kik_ID; ?>" />
					
					<input type="hidden" id="kik_action" name="kik_action" value="edit" />
					
					<?php include(KIK_PLUGIN_ABSPATH . 'frontend/post_get_data.php'); ?>
					
					<div class="row no-margin">
						<div class="col-sm-12">
							<h2>Gestionare firmă: <?php the_title(); ?></h2>
							<div>
								<a class="btn btn-primary edit" href="javascript:;"><i class="fa fa-fw fa-save"></i> Salvează firma</a>
							</div>
							<hr>
						</div>
						
					</div>
					
					<div class="kik_company_title">
						<div class="kik_company_title_tag">Gestionare firmă: <?php the_title(); ?></div>
						<a class="kik_save_btn edit" href="javascript:;"><i class="fa fa-fw fa-save"></i> Salvează firma</a>
						<div class="kik_save_btn_response"></div>
					</div>
					
					<?php include(KIK_PLUGIN_ABSPATH . 'frontend/post_body.php'); ?>
					
					<div class="kik_company_fields_footer"></div>
					
					<div class="kik_save_area">
						<a class="kik_save_btn edit" href="javascript:;"><i class="fa fa-fw fa-save"></i> Salvează firma</a>
						<div class="kik_save_btn_response"></div>
						<a class="kik_delete_btn" href="javascript:;"><i class="fa fa-fw fa-close"></i> Șterge firma</a>
					</div>
					
				</form>
					
			<?php } ?>

<?php endwhile; // end of the loop. ?>
